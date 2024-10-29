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

class AppointmentsController extends Controller
{
    public $IC;

    public function index() {
        return view("galaxy.appointments.index");
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

        $now = Carbon::now()->endOfDay();
        // Vérifier si le statut n'est pas "CANCELLED"
        if ($appointment->status !== 'CANCELLED') {
            // Vérifier si la relation timeSlotDay existe et si elle est dans le passé
            if ($appointment->timeSlotDay && Carbon::parse($appointment->timeSlotDay->day)->lessThan($now)) {
                // Mettre à jour le statut à "PASSED"
                $appointment->status = 'PASSED';
                $appointment->save();
            }
        }
        
        // A FAIRE
        // Lorsqu'on annule un RDV ou INVOICE, détacher le timeslot de l'appointment et le remettre en dispo + mettre l'appointment en status 'CANCELLED'

        dump([
            'URL appointment_id' => $appointmentId,
            'URL user_name' => $userName,
            'user' => $user, 
            'userId' => $userId, 
            'authUserName' => $authUserName, 
            'invoice' => $appointment->invoice()->firstOrFail(),
            'appointment' => $appointment,
            'appointment_informations' => $appointment_informations,
        ]);

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
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->firstOrFail();

        $appointment = Appointment::where('invoice_id', $invoice->id)->firstOrFail();

        if($appointment->appointment_type != 'writing' && $appointment) {
            $timeSlot = TimeSlot::where('id', $appointment->time_slot_id)->firstOrFail();

            $timeSlot->time_slot_days()->updateExistingPivot($appointment->time_slot_day_id, ['available' => true]);
        }

        $appointment->invoice_id = null;
        $appointment->status = 'CANCELLED';
        $appointment->time_slot_day_id = null;
        $appointment->time_slot_id = null;
        $appointment->save();

        $invoice->status = 'CANCELLED';
        $invoice->save();

        toast()
            ->success('Votre demande de consultation a été annulée avec succés.')
            ->pushOnNextPage();

        $redirectRoute = route('my_space.index');
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }
}
