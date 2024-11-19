<?php

namespace App\Http\Controllers\Universe;

use App\Models\User;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function index(): View {
        $users = User::whereDoesntHave('roles', function($query) {
            $query->where('name', 'Admin');
        })->take(5)->orderBy('created_at', 'desc')->get();

        // if($users) {
        //     $users->load('appointments.timeSlotDay', 'appointments.timeSlot');
        // }

        $pastsAppointmentsModel = Appointment::where('invoice_id', '!=', null)
            ->where('status', 'PASSED')->get();
        $futursAppointmentsModel = Appointment::where('invoice_id', '!=', null)
            ->where('status', '!=', 'PASSED')->get();

        // $futursAppointmentsModel->load('timeSlotDay', 'timeSlot');

        $pastsAppointments = collect();
        foreach ($pastsAppointmentsModel as $appointment) {
            $customer = User::find($appointment->user_id)->firstOrFail();

            // dd($appointment->timeSlotDay);

            $pastsAppointments->push([
                'id' => $appointment->id,
                'dateTime' => $appointment->formatted_date_time,
                'day' => $appointment->formatted_day,
                'time' => $appointment->formatted_time,
                'type' => $appointment->appointment_type,
                'user_id' => $customer->id,
                'user_name' => $customer->fullName(),
                'request_response_date' => $appointment->request_response_date ? $appointment->request_response_date->translatedFormat('l j F Y') : null,
            ]);
        }
        $pastsAppointments = $pastsAppointments->sortBy('dateTime');

        $futursAppointments = collect();
        foreach ($futursAppointmentsModel as $appointment) {
            $customer = User::find($appointment->user_id)->firstOrFail();
            // dd($appointment->timeSlotDay);

            $futursAppointments->push([
                'id' => $appointment->id,
                'dateTime' => $appointment->formatted_date_time,
                'day' => $appointment->formatted_day,
                'time' => $appointment->formatted_time,
                'type' => $appointment->appointment_type,
                'user_id' => $customer->id,
                'user_name' => $customer->fullName(),
            ]);
        }
        $futursAppointments = $futursAppointments->sortBy('dateTime');

        return view('universe.index', [
            'users' => $users,
            'futursAppointments' => $futursAppointments,
            'pastsAppointments' => $pastsAppointments
        ]);
    }
    
}
