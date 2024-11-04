<?php

namespace App\Concern;

use Carbon\Carbon;
use App\Models\Appointment as AppointmentModel;

class Appointment
{
    public function updatedAppointmentsToPassed() {
        // Récupérer les rendez-vous
        $appointments = AppointmentModel::where('status', '!=', 'CANCELLED')->get();


        // $now = Carbon::now()->endOfDay();
        // // Vérifier si le statut n'est pas "CANCELLED"
        // if ($appointment->status !== 'CANCELLED') {
        //     // Vérifier si la relation timeSlotDay existe et si elle est dans le passé
        //     if ($appointment->timeSlotDay && Carbon::parse($appointment->timeSlotDay->day)->lessThan($now)) {
        //         // Mettre à jour le statut à "PASSED"
        //         $appointment->status = 'PASSED';
        //         $appointment->save();
        //     }
        // }
    }
}