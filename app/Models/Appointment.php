<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Concern\StatusAppointmentNotifications as ConcernNotifications;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'time_slot_day_id', 'time_slot_id', 'invoice_id', 'appointment_message', 'appointment_type',
        'status', 'request_reason', 'request_message', 'request_approved', 'request_reply', 'request_response_date'
    ];

    public function getFormattedDayAttribute()
    {
        if($this->timeSlotDay) {
            return Carbon::parse($this->timeSlotDay->day)->translatedFormat('l j F Y');
        } else {
            return Carbon::parse($this->updated_at)->translatedFormat('l j F Y');
        }
    }

    public function getFormattedDateTimeAttribute()
    {
        if($this->timeSlotDay) {
            return Carbon::create($this->timeSlotDay->day);
        } else {
            return Carbon::create($this->updated_at);
        }
    }

    public function getFormattedTimeAttribute()
    {
        if($this->timeSlot) {
            return Carbon::parse($this->timeSlot->start_time)->format('H\hi');
        } else {
            return null;
        }
    }

    // public function user() {
    //     return $this->belongsTo(User::class);
    // }
    public function user() {
        return $this->hasOne(User::class);
    }

    public function timeSlotDay() {
        return $this->belongsTo(TimeSlotDay::class);
    }

    public function timeSlot() {
        return $this->belongsTo(TimeSlot::class);
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    // Modifier le status de l'appointment à PASSED si besoin
    public static function updatePassedAppointments()
    {
        // Get current date and time
        $now = Carbon::now();

        // Retrieve appointments with statuses other than CANCELLED or PASSED
        $appointments = self::whereNotIn('status', ['CANCELLED', 'PASSED', 'REPLY'])
            ->with(['timeSlotDay', 'timeSlot', 'invoice'])
            ->get();

        foreach ($appointments as $appointment) {
            $invoice = $appointment->invoice;
            // dd($invoice);
            // Check if the appointment type is 'writing'
            if ($appointment->appointment_type === 'writing') {
                $updatedAtThreshold = Carbon::parse($appointment->updated_at)->addDays(3);
                // dd($appointment, 'now', $now, $updatedAtThreshold);

                // dump('w', $updatedAtThreshold);

                // Check if the updated_at date is more than 3 days ago
                if ($updatedAtThreshold->lessThan($now)) {
                    $appointment->update(['status' => 'PASSED']);
                    if ($invoice->status == 'PENDING') {
                        $invoice->status = 'CANCELLED';
                        $invoice->save();
                        ConcernNotifications::sendNotification($invoice, 'CANCELLED');
                        ConcernNotifications::sendNotificationToAdmin($invoice, 'CANCELLED');
                    }
                }

            } elseif ($appointment->timeSlotDay && $appointment->timeSlot) {
                // Combine the date from timeSlotDay and time from timeSlot
                $appointmentDateTime = Carbon::parse($appointment->timeSlotDay->day)
                    ->setTimeFromTimeString($appointment->timeSlot->end_time); // Assuming end_time is the cutoff time

                    // dd('tp', $appointmentDateTime);

                // Check if the appointment is in the past
                if ($appointmentDateTime->lessThan($now)) {
                    $appointment->update(['status' => 'PASSED']);
                    if ($invoice->status == 'PENDING') {
                        $invoice->status = 'CANCELLED';
                        $invoice->save();
                        ConcernNotifications::sendNotification($invoice, 'CANCELLED');
                        ConcernNotifications::sendNotificationToAdmin($invoice, 'CANCELLED');
                    }
                }

            }
        }
    }

    public static function updatePassedAppointmentsForUser()
    {
        // Get current date and time
        $now = Carbon::now();

        // Retrieve appointments with statuses other than CANCELLED or PASSED
        $appointments = self::whereNotIn('status', ['CANCELLED', 'PASSED'])
            ->where('user_id', Auth::id())
            ->with(['timeSlotDay', 'timeSlot', 'invoice'])
            ->get();

        foreach ($appointments as $appointment) {
            $invoice = $appointment->invoice;
            // dd($invoice);
            // Check if the appointment type is 'writing'
            if ($appointment->appointment_type === 'writing' && $appointment->status != 'REPLY') {
                $updatedAtThreshold = Carbon::parse($appointment->updated_at)->addDays(3);

                // dump('w', $updatedAtThreshold);

                // Check if the updated_at date is more than 3 days ago
                if ($updatedAtThreshold->lessThan($now)) {
                    $appointment->update(['status' => 'PASSED']);
                    if ($invoice->status == 'PENDING') {
                        $invoice->status = 'CANCELLED';
                        $invoice->save();
                        ConcernNotifications::sendNotification($invoice, 'PASSED');
                        ConcernNotifications::sendNotificationToAdmin($invoice, 'PASSED');
                    }
                }

            } elseif ($appointment->timeSlotDay && $appointment->timeSlot) {
                // Combine the date from timeSlotDay and time from timeSlot
                $appointmentDateTime = Carbon::parse($appointment->timeSlotDay->day)
                    ->setTimeFromTimeString($appointment->timeSlot->end_time); // Assuming end_time is the cutoff time

                    // dd('tp', $appointmentDateTime);

                // Check if the appointment is in the past
                if ($appointmentDateTime->lessThan($now)) {
                    $appointment->update(['status' => 'PASSED']);
                    if ($invoice->status == 'PENDING') {
                        $invoice->status = 'CANCELLED';
                        $invoice->save();
                        ConcernNotifications::sendNotification($invoice, 'PASSED');
                        ConcernNotifications::sendNotificationToAdmin($invoice, 'PASSED');
                    }
                }

            }
        }
    }
}
