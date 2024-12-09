<?php

namespace App\Http\Controllers\Universe;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\TimeSlot;
use Illuminate\View\View;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use function PHPSTORM_META\map;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Concern\Invoice as InvoiceController;
use App\Concern\StatusAppointmentNotifications as ConcernNotifications;

class AppointmentsController extends Controller
{
    public $IC;

    public function index(): View {
        return view('universe.appointments.index');
    }

    public function show(Request $request): View {
        $appointment = Appointment::where('id', $request->id)->firstOrFail();
        $appointment_informations = json_decode($appointment->invoice()->firstOrFail()->invoice_informations);
        $user = User::where('id', $appointment->user_id)->firstOrFail();
        $appointmentPassed = $appointment->status == 'PASSED' ? true : false;

        $this->IC = new InvoiceController($appointment->user_id);

        return view('universe.appointments.show', [
            'ic' => $this->IC,
            'user' => $user,
            'appointment' => $appointment,
            'appointment_informations' => $appointment_informations,
            'appointmentPassed' => $appointmentPassed,
        ]);
    }

    public function create() {

        // Get all services
        $services = Product::where('type', 'SERVICE_PRODUCT')
        ->where('available', true)
        ->get()
        ->map(function ($service) {
            $service->amount = $service->price / 100 . '.00 €';
            return $service;
        });

        $users = User::whereHas('roles', function($query) {
            $query->where('slug', 'consultant');
        })
        ->orderBy('first_name', 'asc')
        ->get();

        return view('universe.appointments.create', [
            'services' => $services,
            'users' => $users,
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'time_slot_day' => 'nullable|integer',
            'time_slot' => 'nullable|integer',
            'time_slot_for_human' => 'nullable|string',
            'time_slot_day_for_human' => 'nullable|string',
            'type' => 'required|string',
            'invoice_status' => 'required',
            'user_id' => 'required|integer',
        ]);

        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->firstOrFail();
        //1 - Créer un token unique Invoice
        $create_invoice = $this->IC = new InvoiceController($request->user_id);
        $invoice_token = $create_invoice->get_token();

        //2 - Créer une invoice en bdd avec les valeurs : 
        //== total_price payment_invoice_token appointment_id ref user_id
            $appointmentInformations = [
                "type" => $request->type,
                "time_slot_day" => $request->time_slot_day,
                "time_slot" => $request->time_slot,
                "time_slot_day_for_human" => $request->time_slot_day_for_human,
                "time_slot_for_human" => $request->time_slot_for_human,
                "writing_consultation"  => [
                    'question' => ''
                ],
            ];

        $total_price = function() use ($request) {

            if(Str::lower($request->invoice_status) == 'free') {
                return 0;
            }

            $service = Product::where('slug', $request->type)->firstOrFail();
            return $service->price;
        };

        $invoice = Invoice::create([
            'total_price' => $total_price(),
            'payment_invoice_token' => $invoice_token,
            'status' => $request->invoice_status,
            'invoice_informations' => json_encode($appointmentInformations),
            'user_id' => $user_id,
            'ref' => $create_invoice->get_ref(),
        ]);

        $invoice->products()->attach(Product::where('slug', $request->type)->first()->id);

        $appointment = Appointment::create([
            'user_id' => $user_id,
            'time_slot_day_id' => $request->time_slot_day, 
            'time_slot_id' => $request->time_slot,
            'invoice_id' => $invoice->id,
            "status" => $request->type == 'writing' ? 'PENDING' : 'APPROVED',
            'appointment_message' => null,
            'appointment_type' => $request->type,
        ]);

        // Mettre à jour l'invoice avec l'appointment_id
        $invoice->appointment_id = $appointment->id;
        $invoice->save();

        $timeSlot = TimeSlot::where('id', $request->time_slot)->firstOrFail();
        
        $timeSlot->time_slot_days()->updateExistingPivot($request->time_slot_day, ['available' => false]);

        toast()->success('La demande de consultation a été enregistrée avec succès.')->pushOnNextPage();

        ConcernNotifications::sendNotificationFromAdmin($invoice, 'CREATED', $user);

        return response()->json(['redirect' => route('admin.appointments.show', ['id' => $appointment->id])]);

    }

    public function delete(Request $request) {
        // Invoice
        $invoice_token = $request->payment_invoice_token;
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->with('appointment')->firstOrFail();
        $appointment = $invoice->appointment;
        $user = User::where('id', $invoice->user_id)->firstOrFail();
    
        // Vérification et création du remboursement
        if ($invoice->payment_intent) {
            try {
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

                \Stripe\Refund::create([
                    'payment_intent' => $invoice->payment_intent,
                ]);
                
                ConcernNotifications::sendNotificationFromAdmin($invoice, 'REFUNDED', $user);
                // Ajout d'un message de confirmation pour le remboursement
                toast()->success('Le remboursement de la consultation a été effectué avec succès.')->pushOnNextPage();
            } catch (\Exception $e) {
                // Gestion d'erreur en cas de problème avec Stripe
                report($e);
                toast()->warning('Une erreur est survenue lors du remboursement. Veuillez réessayer plus tard.')->pushOnNextPage();
                return response()->json(['status' => 'error', 'message' => 'Refund failed.'], 500);
            }
        }
    
        // Mise à jour des créneaux de rendez-vous si ce n'est pas un rendez-vous "writing"
        if ($appointment && $appointment->appointment_type != 'writing') {
            $timeSlot = TimeSlot::where('id', $appointment->time_slot_id)->first();
            if ($timeSlot) {
                $timeSlot->time_slot_days()->updateExistingPivot($appointment->time_slot_day_id, ['available' => true]);
            }
        }
    
        // Mise à jour de l'état du rendez-vous
        $appointment->invoice_id = null;
        $appointment->status = 'CANCELLED';
        $appointment->time_slot_day_id = null;
        $appointment->time_slot_id = null;
        $appointment->save();
    
        // Mise à jour de l'état de la facture
        if ($invoice->payment_intent) {
            $invoice->status = 'REFUNDED';
        } else {
            $invoice->status = 'CANCELLED';
        }
        $invoice->save();

        ConcernNotifications::sendNotificationFromAdmin($invoice, 'CANCELLED', $user);

        toast()->success('La demande de consultation a été annulée avec succés.')->pushOnNextPage();
    
        $redirectRoute = route('admin.index');
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }

    public function approved(Request $request) {
        $appointment = Appointment::where('id', $request->id)->firstOrFail();
        $user = User::where('id', $appointment->user_id)->firstOrFail();
        
        $appointment->status = 'APPROVED';
        $appointment->save();

        ConcernNotifications::sendNotificationFromAdmin($appointment->invoice, 'APPROVED', $user);

        toast()->success('La demande de consultation a été approuvée avec succés.')->pushOnNextPage();

        $redirectRoute = route('admin.index');
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }
}
