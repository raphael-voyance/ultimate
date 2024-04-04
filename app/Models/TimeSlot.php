<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time', 'end_time'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function time_slot_days()
    {
        return $this->belongsToMany(TimeSlotDay::class, 'time_slot_day_time_slot', 'time_slot_id', 'time_slot_day_id');
    }
}
