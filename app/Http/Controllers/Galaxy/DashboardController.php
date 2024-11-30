<?php

namespace App\Http\Controllers\Galaxy;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $now = Carbon::now()->endOfDay();
        $user = $request->user();
        if ($user) {
            $user->load('profile');
            $user->load('appointments.timeSlotDay', 'appointments.timeSlot');
        }

        $pastsAppointments = $user->appointments()
            ->where('invoice_id', '!=', null)
            ->where('appointment_type', '!=', 'writing')
            ->where('status', 'PASSED')->take(5)->get();
            
        $futursAppointments = $user->appointments()
            ->where('invoice_id', '!=', null)
            ->where('status', '!=', 'PASSED')
            ->where('status', '!=', 'REPLY')->take(5)->get();

        $writtingAppointmentsReply = $user->appointments()
            ->where('invoice_id', '!=', null)
            ->where('status', 'REPLY')->take(3)->get();

        $writtingAppointmentsPast = $user->appointments()
            ->where('invoice_id', '!=', null)
            ->where('appointment_type', 'writing')
            ->where('status', 'PASSED')
            ->whereHas('invoice', function ($query) {
                $query->where('status', '!=', 'REFUNDED');
            })->take(2)->get();

        $pastsAppointments = $pastsAppointments->map(function ($appointment) use ($user) {
            if ($appointment->timeSlotDay) {
                // Classic appointment with a timeSlotDay
                return [
                    'id' => $appointment->id,
                    'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
                    'date' => $appointment->formatted_day,
                    'time' => $appointment->formatted_time,
                    'type' => $appointment->appointment_type,
                ];
            } else {
                // Email-based appointment (no timeSlotDay)
                $date = $this->transformDate($appointment->updated_at);

                return [
                    'id' => $appointment->id,
                    'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
                    'date' => $date,
                    'time' => 'N/A', // No specific time for email requests
                    'type' => $appointment->appointment_type,
                ];
            }
        });

        $futursAppointments = $futursAppointments->map(function ($appointment) use ($user) {
            if ($appointment->timeSlotDay) {
                // Classic appointment with a timeSlotDay
                return [
                    'id' => $appointment->id,
                    'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
                    'date' => $appointment->formatted_day,
                    'time' => $appointment->formatted_time,
                    'type' => $appointment->appointment_type,
                    'status' => $appointment->status,
                ];
            } else {
                // Email-based appointment (no timeSlotDay)
                $dateForHuman = $this->transformDate($appointment->updated_at);

                return [
                    'id' => $appointment->id,
                    'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
                    'dateForHuman' => $dateForHuman,
                    'date' => $appointment->updated_at,
                    'time' => 'N/A', // No specific time for email requests
                    'type' => $appointment->appointment_type,
                    'status' => $appointment->status,
                ];
            }
        });

        $writtingAppointmentsReply = $writtingAppointmentsReply->map(function ($appointment) use ($user) {
            // Email-based appointment (no timeSlotDay)
            $date = $this->transformDate($appointment->request_response_date);

            return [
                'id' => $appointment->id,
                'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
                'date' => $date,
                'time' => 'N/A', // No specific time for email requests
                'type' => $appointment->appointment_type,
            ];
        });

        $writtingAppointmentsPast = $writtingAppointmentsPast->map(function ($appointment) use ($user) {
            // Email-based appointment (no timeSlotDay)
            $date = $this->transformDate($appointment->updated_at);

            return [
                'id' => $appointment->id,
                'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
                'date' => $date
            ];
        });


        $invoices = $user->invoices()->latest()->limit(5)->get();

        $numerology = json_decode($user->profile->numerology);

        $draws = $user->draws()->latest()->limit(5)->get();
        $drawsCount = count($user->draws()->get());

        return view('galaxy.dashboard', [
            'user' => $user,
            'invoices' => $invoices,
            'numerology' => $numerology,
            'draws' => $draws,
            'drawsCount' => $drawsCount,
            'pastsAppointments' => $pastsAppointments,
            'futursAppointments' => $futursAppointments,
            'writtingAppointmentsReply' => $writtingAppointmentsReply,
            'writtingAppointmentsPast' => $writtingAppointmentsPast,
        ]);
    }

    private function transformDate($dateString) {
        return Carbon::parse($dateString)->translatedFormat('l j F Y');
    }

    private function transformTime($timeString) {
        return Carbon::createFromFormat('H:i:s', $timeString)->format('H\hi');
    }
}
