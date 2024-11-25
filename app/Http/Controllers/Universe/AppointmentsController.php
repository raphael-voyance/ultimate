<?php

namespace App\Http\Controllers\Universe;

use App\Models\User;
use App\Models\Invoice;
use App\Models\TimeSlot;
use Illuminate\View\View;
use App\Models\Appointment;
use Illuminate\Http\Request;
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

        $this->IC = new InvoiceController($appointment->user_id);

        return view('universe.appointments.show', [
            'ic' => $this->IC,
            'user' => $user,
            'appointment' => $appointment,
            'appointment_informations' => $appointment_informations,
        ]);
    }

    public function create(): View {
        dd('create');
        return view('universe.appointments.show');
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
                ConcernNotifications::sendNotification($invoice, 'REFUNDED', $user);
                // Ajout d'un message de confirmation pour le remboursement
                toast()->success('Le remboursement de la consultation a été effectué avec succès.')->pushOnNextPage();
            } catch (\Exception $e) {
                // Gestion d'erreur en cas de problème avec Stripe
                report($e);
                dd($e);
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
    
        $redirectRoute = route('my_space.index');
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
