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

        // Récupération des rendez-vous passés et futurs
        // $pastsAppointmentsModel = $user->appointments()
        //     ->where(function ($query) use ($now) {
        //         // dd($query);
        //         // Cas avec timeSlotDay
        //         $query->whereHas('timeSlotDay', function ($query) use ($now) {
        //             $query->where('day', '<', $now);
        //         })
        //             // Cas sans timeSlotDay (demande par email)
        //             ->orWhere(function ($subQuery) use ($now) {
        //                 $subQuery->whereNull('time_slot_id')
        //                     ->where(function ($q) use ($now) {
        //                         $q->whereNull('request_reply')
        //                             ->whereDate('created_at', '<', $now)
        //                             ->orWhereNotNull('request_reply')
        //                             ->whereDate('updated_at', '<', $now);
        //                     });
        //             });
        //     })
        //     ->with(['timeSlotDay', 'timeSlot'])
        //     ->get();

        // $futursAppointmentsModel = $user->appointments()
        //     ->where('invoice_id', '!=', null)
        //     ->where(function ($query) use ($now) {
        //         // Cas avec timeSlotDay
        //         $query->whereHas('timeSlotDay', function ($query) use ($now) {
        //             $query->where('day', '>=', $now);
        //         })
        //             // Cas sans timeSlotDay (demande par email)
        //             ->orWhere(function ($subQuery) use ($now) {
        //                 $subQuery->whereNull('time_slot_id')
        //                     ->where(function ($q) use ($now) {
        //                         $q->whereNull('request_reply')
        //                             ->whereDate('created_at', '>=', $now)
        //                             ->orWhereNotNull('request_reply')
        //                             ->whereDate('updated_at', '>=', $now);
        //                     });
        //             });
        //     })
        //     ->with(['timeSlotDay', 'timeSlot'])
        //     ->get();

        // dump('$pastsAppointmentsModel : ', $pastsAppointmentsModel);
        // dump('$futursAppointmentsModel : ', $futursAppointmentsModel);

        $pastsAppointments = $user->appointments()
            ->where('invoice_id', '!=', null)
            ->where('status', 'PASSED')->get();
        $futursAppointments = $user->appointments()
            ->where('invoice_id', '!=', null)
            ->where('status', '!=', 'PASSED')->get();

        $pastsAppointments = $pastsAppointments->map(function ($appointment) use ($user) {
            if ($appointment->timeSlotDay) {
                // Classic appointment with a timeSlotDay
                return [
                    'id' => $appointment->id,
                    'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
                    'date' => $this->transformDate($appointment->timeSlotDay->day),
                    'time' => $this->transformTime($appointment->timeSlot->start_time),
                    'type' => $appointment->appointment_type,
                ];
            } else {
                // Email-based appointment (no timeSlotDay)
                $date = $appointment->request_reply ? $this->transformDate($appointment->updated_at) : $this->transformDate($appointment->created_at);

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
                    'date' => $this->transformDate($appointment->timeSlotDay->day),
                    'time' => $this->transformTime($appointment->timeSlot->start_time),
                    'type' => $appointment->appointment_type,
                ];
            } else {
                // Email-based appointment (no timeSlotDay)
                $date = $appointment->request_reply ? $this->transformDate($appointment->updated_at) : $this->transformDate($appointment->created_at);

                return [
                    'id' => $appointment->id,
                    'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
                    'date' => $date,
                    'time' => 'N/A', // No specific time for email requests
                    'type' => $appointment->appointment_type,
                ];
            }
        });

            // dd($pastsAppointments, $futursAppointments);

        // foreach ($pastsAppointmentsModel as $a) {
        //     $pastsAppointments[] = $a->toArray();
        // }
        // foreach ($futursAppointmentsModel as $a) {
        //     $futursAppointments[] = $a->toArray();
        // }

        // dump('$pastsAppointments before : ', $pastsAppointments);
        // dump('$futursAppointments before : ', $futursAppointments);

        // foreach ($pastsAppointments as $i => $appointment) {
        //     if (isset($appointment['time_slot_day'])) {
        //         // Cas où le rendez-vous a un timeSlotDay (rendez-vous classique)
        //         $pastsAppointments[$i] = [
        //             'id' => $appointment['id'],
        //             'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
        //             'date' => $this->transformDate($appointment['time_slot_day']['day']),
        //             'time' => $this->transformTime($appointment['time_slot']['start_time']),
        //             'type' => $appointment['appointment_type'],
        //         ];
        //     } else {
        //         // Cas où le rendez-vous est une question par email (pas de timeSlotDay)
        //         $date = isset($appointment['request_reply']) ? $this->transformDate($appointment['updated_at']) : $this->transformDate($appointment['created_at']);
        
        //         $pastsAppointments[$i] = [
        //             'id' => $appointment['id'],
        //             'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
        //             'date' => $date,
        //             'time' => 'N/A', // Pas d'heure spécifique pour les demandes par email
        //             'type' => $appointment['appointment_type'],
        //         ];
        //     }
        // }

        // foreach ($futursAppointments as $i => $appointment) {
        //     if (isset($appointment['time_slot_day'])) {
        //         // Cas où le rendez-vous a un timeSlotDay (rendez-vous classique)
        //         $futursAppointments[$i] = [
        //             'id' => $appointment['id'],
        //             'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
        //             'date' => $this->transformDate($appointment['time_slot_day']['day']),
        //             'time' => $this->transformTime($appointment['time_slot']['start_time']),
        //             'type' => $appointment['appointment_type'],
        //         ];
        //     } else {
        //         // Cas où le rendez-vous est une question par email (pas de timeSlotDay)
        //         $date = isset($appointment['request_reply']) ? $this->transformDate($appointment['updated_at']) : $this->transformDate($appointment['created_at']);
        
        //         $futursAppointments[$i] = [
        //             'id' => $appointment['id'],
        //             'authUserName' => Str::slug($user->first_name . '-' . $user->last_name),
        //             'date' => $date,
        //             'time' => 'N/A', // Pas d'heure spécifique pour les demandes par email
        //             'type' => $appointment['appointment_type'],
        //         ];
        //     }
        // }
        



        // dump('$pastsAppointments after : ', $pastsAppointments);
        // dump('$futursAppointments after : ', $futursAppointments);


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
            'futursAppointments' => $futursAppointments
        ]);
    }

    private function transformDate($dateString) {
        return Carbon::parse($dateString)->format('d/m/Y');
    }

    private function transformTime($timeString) {
        return Carbon::createFromFormat('H:i:s', $timeString)->format('H\hi');
    }
}
