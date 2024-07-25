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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function timeSlotDay() {
        return $this->belongsTo(TimeSlotDay::class);
    }

    public function timeSlot() {
        return $this->belongsTo(TimeSlot::class);
    }

    public function invoice() {
        return $this->hasOne(Invoice::class);
    }
}
