<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'time_slot_days', 'invoice_id', 'appointment_message', 'appointment_type',
        'session_type', 'request_reason', 'request_message', 'request_approved', 'request_reply'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function timeSlotDays() {
        return $this->belongsTo(TimeSlotDay::class);
    }

    public function invoice() {
        return $this->hasOne(Invoice::class);
    }
}
