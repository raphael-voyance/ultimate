<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'time_slot_day_id', 'time_slot_id', 'invoice_id', 'appointment_message', 'appointment_type',
        'status', 'request_reason', 'request_message', 'request_approved', 'request_reply'
    ];

    public function getFormattedDayAttribute()
    {
        return Carbon::parse($this->timeSlotDay->day)->translatedFormat('l j F Y');
    }

    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->timeSlot->start_time)->format('H\hi');
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
        $appointments = self::whereNotIn('status', ['CANCELLED', 'PASSED'])
            ->with(['timeSlotDay', 'timeSlot'])
            ->get();

        foreach ($appointments as $appointment) {
            // Check if the appointment type is 'writing'
            if ($appointment->appointment_type === 'writing') {
                $updatedAtThreshold = Carbon::parse($appointment->updated_at)->addDays(3);

                // Check if the updated_at date is more than 3 days ago
                if ($updatedAtThreshold->lessThan($now)) {
                    $appointment->update(['status' => 'PASSED']);
                }
            } elseif ($appointment->timeSlotDay && $appointment->timeSlot) {
                // Combine the date from timeSlotDay and time from timeSlot
                $appointmentDateTime = Carbon::parse($appointment->timeSlotDay->day)
                    ->setTimeFromTimeString($appointment->timeSlot->end_time); // Assuming end_time is the cutoff time

                // Check if the appointment is in the past
                if ($appointmentDateTime->lessThan($now)) {
                    $appointment->update(['status' => 'PASSED']);
                }
            }
        }
    }
}
