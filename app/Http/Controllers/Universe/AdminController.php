<?php

namespace App\Http\Controllers\Universe;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\View\View;
use App\Models\Appointment;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(): View {

        // GET USERS
        $users = User::whereDoesntHave('roles', function($query) {
            $query->where('name', 'Admin');
        })->take(5)->orderBy('created_at', 'desc')->get();

        // if($users) {
        //     $users->load('appointments.timeSlotDay', 'appointments.timeSlot');
        // }

        // GET APPOINTMENTS
        $pastsAppointments = Appointment::where('invoice_id', '!=', null)
            ->where('appointment_type', '!=', 'writing')
            ->where('status', 'PASSED')->take(5)->get();
        $pastsAppointmentsModel = Appointment::where('invoice_id', '!=', null)
            ->where('status', 'PASSED')->take(5)->get();
        $pastsAppointments = collect();
        foreach ($pastsAppointmentsModel as $appointment) {
            $customer = User::where('id', $appointment->user_id)->firstOrFail();

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

        $futursAppointmentsModel = Appointment::where('invoice_id', '!=', null)
        ->where('status', '!=', 'PASSED')
        ->where('status', '!=', 'REPLY')->take(5)->get();
        $futursAppointments = collect();
        foreach ($futursAppointmentsModel as $appointment) {
            // dd($appointment->user_id);
            $customer = User::where('id', $appointment->user_id)->firstOrFail();
            // dd($appointment->timeSlotDay);

            // dd($customer);

            $futursAppointments->push([
                'id' => $appointment->id,
                'dateTime' => $appointment->formatted_date_time,
                'dateForHuman' => $appointment->formatted_day,
                'day' => $appointment->updated_at,
                'time' => $appointment->formatted_time,
                'type' => $appointment->appointment_type,
                'user_id' => $customer->id,
                'status' => $appointment->status,
                'user_name' => $customer->fullName(),
            ]);
        }
        $futursAppointments = $futursAppointments->sortBy('dateTime');

        $writtingAppointmentsReplyModel = Appointment::where('invoice_id', '!=', null)
            ->where('status', 'REPLY')->take(3)->get();
        $writtingAppointmentsReply = collect();
        foreach ($writtingAppointmentsReplyModel as $appointment) {
            $customer = User::where('id', $appointment->user_id)->firstOrFail();

            $date = Carbon::create($appointment->request_response_date)->translatedFormat('l j F Y');

            $writtingAppointmentsReply->push([
                'id' => $appointment->id,
                'dateTime' => $appointment->formatted_date_time,
                'user_id' => $customer->id,
                'user_name' => $customer->fullName(),
                'date' => $appointment->request_response_date ? $date : null,
            ]);
        }

        $writtingAppointmentsPastModel = Appointment::where('invoice_id', '!=', null)
        ->where('appointment_type', 'writing')
        ->where('status', 'PASSED')
        ->whereHas('invoice', function ($query) {
            $query->where('status', '!=', 'REFUNDED');
        })->take(2)->get();
    
        $writtingAppointmentsPast = collect();
        foreach ($writtingAppointmentsPastModel as $appointment) {
            $customer = User::where('id', $appointment->user_id)->firstOrFail();

            $date = Carbon::create($appointment->updated_at)->translatedFormat('l j F Y');

            $writtingAppointmentsPast->push([
                'id' => $appointment->id,
                'dateTime' => $appointment->formatted_date_time,
                'user_id' => $customer->id,
                'user_name' => $customer->fullName(),
                'date' => $appointment->updated_at ? $date : null,
            ]);
        }

        // GET INVOICES
        $invoices = Invoice::take(5)->orderBy('created_at', 'desc')->get();

        return view('universe.index', [
            'users' => $users,
            'futursAppointments' => $futursAppointments,
            'pastsAppointments' => $pastsAppointments,
            'writtingAppointmentsReply' => $writtingAppointmentsReply,
            'writtingAppointmentsPast' => $writtingAppointmentsPast,
            'invoices' => $invoices,
        ]);
    }
    
}
