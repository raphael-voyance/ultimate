<?php

namespace App\Http\Controllers\Galaxy;

use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
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
        $userId = $user->id;
        $authUserName = Str::slug($user->first_name . '-' . $user->last_name);

        if($userName != $authUserName) {
            abort(403);
        }

        $appointment = Appointment::where('id', $appointmentId)->firstOrFail();

        if($appointment->user_id != $userId) {
            abort(403);
        }
        
        // A FAIRE
        // Lorsqu'on annule un RDV ou INVOICE, détacher le timeslot de l'appointment et le remettre en dispo + mettre l'appointment en status 'CANCELLED'

        dump([
            'URL appointment_id' => $appointmentId,
            'URL user_name' => $userName,
            'user' => $user, 
            'userId' => $userId, 
            'authUserName' => $authUserName, 
            'appointment' => $appointment
        ]);

        return view("galaxy.appointments.show", compact('appointment'));
    }
}
