<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlotDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'day'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function time_slots()
    {
        return $this->belongsToMany(TimeSlot::class, 'time_slot_day_time_slot', 'time_slot_day_id', 'time_slot_id')
        ->withPivot('available');
    }

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
