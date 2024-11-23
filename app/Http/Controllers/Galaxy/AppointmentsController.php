<?php

namespace App\Http\Controllers\Galaxy;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\TimeSlot;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Concern\Invoice as InvoiceController;
use App\Concern\StatusAppointmentNotifications as ConcernNotifications;

class AppointmentsController extends Controller
{
    public $IC;

    public function index(Request $request) {
        $order = strtoupper($request->order);
        $user = Auth::user();
        $appointments = $user->appointments()
            ->where('status', '!=', 'CANCELLED')
            ->with('timeSlotDay', 'timeSlot')
            ->orderBy('created_at', $order)
            ->get();

        $appointments = $appointments->map(function($appointment) {
            $user = Auth::user();
            $appointment->authUserName = Str::slug($user->first_name . '-' . $user->last_name);
            if($appointment->appointment_type != 'writing' && !empty($appointment->time_slot_day_id)) {
                $appointment->date = $this->transformDate($appointment->timeSlotDay->day);
                $appointment->time = $this->transformTime($appointment->timeSlot->start_time);
            }else {
                $appointment->reply_date = $this->transformDate($appointment->updated_at, 3);
            }
            return $appointment;
        });

        // dd($appointments);

        return view("galaxy.appointments.index", [
            'appointments' => $appointments,
        ]);
    }

    private function transformDate($dateString, $addDays = null) {
        if($addDays) {
            return Carbon::parse($dateString)->addDays($addDays)->translatedFormat('j F Y');
        }
        return Carbon::parse($dateString)->translatedFormat('j F Y');
    }

    private function transformTime($timeString) {
        return Carbon::createFromFormat('H:i:s', $timeString)->format('H\hi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $userName, string $appointmentId)
    {
        $userName = Str::slug(request()->user_name);
        $appointmentId = request()->appointment_id;

        $user = Auth::user();
        $user->load('profile');
        $userId = $user->id;
        $authUserName = Str::slug($user->first_name . '-' . $user->last_name);

        $this->IC = new InvoiceController($userId);

        if($userName != $authUserName) {
            abort(403);
        }

        $appointment = Appointment::where('id', $appointmentId)->with('invoice', 'timeSlotDay', 'timeSlot')->firstOrFail();
        $appointment_informations = json_decode($appointment->invoice()->firstOrFail()->invoice_informations);

        if($appointment->user_id != $userId) {
            abort(403);
        }
        
        // A FAIRE
        // Lorsqu'on annule un RDV ou INVOICE, détacher le timeslot de l'appointment et le remettre en dispo + mettre l'appointment en status 'CANCELLED'

        // dump([
        //     'URL appointment_id' => $appointmentId,
        //     'URL user_name' => $userName,
        //     'user' => $user, 
        //     'userId' => $userId, 
        //     'authUserName' => $authUserName, 
        //     'invoice' => $appointment->invoice()->firstOrFail(),
        //     'appointment' => $appointment,
        //     'appointment_informations' => $appointment_informations,
        // ]);

        return view("galaxy.appointments.show", [
            'appointment' => $appointment,
            'appointment_informations' => $appointment_informations,
            'user' => $user,
            'ic' => $this->IC,
        ]);
    }

    public function delete(Request $request) {
        // Invoice
        $invoice_token = $request->payment_invoice_token;
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->with('appointment')->firstOrFail();
        $appointment = $invoice->appointment;
    
        // Vérification et création du remboursement
        if ($invoice->payment_intent) {
            try {
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

                \Stripe\Refund::create([
                    'payment_intent' => $invoice->payment_intent,
                ]);
                ConcernNotifications::sendNotification($invoice, 'REFUNDED');
                ConcernNotifications::sendNotificationToAdmin($invoice, 'CANCELLED');
                // Ajout d'un message de confirmation pour le remboursement
                toast()->success('Le remboursement de votre consultation a été effectué avec succès.')->pushOnNextPage();
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

        ConcernNotifications::sendNotification($invoice, 'CANCELLED');
        ConcernNotifications::sendNotificationToAdmin($invoice, 'CANCELLED');

        toast()->success('Votre demande de consultation a été annulée avec succés.')->pushOnNextPage();
    
        $redirectRoute = route('my_space.index');
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }

}
