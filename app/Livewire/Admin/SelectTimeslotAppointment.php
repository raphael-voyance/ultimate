<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\TimeSlot;
use App\Models\TimeSlotDay;
use Illuminate\Database\Eloquent\Builder;

class SelectTimeslotAppointment extends Component
{
    public $appointment;

    public $timeSlotDays;
    public int|null $timeSlotDayId = null;
    public int|null $timeSlotId = null;
    public string|null $timeSlotForHuman = null;
    public string|null $timeSlotDayForHuman = null;
    public bool $timeSlotIsSelected = false;

    public $limitTimeSlotDays = 3;
    public $totalOffsetTimeSlot;
    public int $offsetTimeSlot = 0;

    public function mount()
    {
        // Initialize SlotDays
        $totalSlotDays = TimeSlotDay::all()->count();
        $this->totalOffsetTimeSlot = ceil($totalSlotDays / $this->limitTimeSlotDays);
        $this->loadTimeSlotDays();
    }

        //Load All TimeSlotDays to Array
        private function loadTimeSlotDays()
        {
            $this->timeSlotDays = TimeSlotDay::with('time_slots')
                ->whereHas('time_slots', function(Builder $query) {
                    return $query->where('available', true);
                })
                ->where('day', '>', Carbon::now()->startOfDay())
                ->orderBy('day')
                ->skip($this->offsetTimeSlot)
                ->limit($this->limitTimeSlotDays)
                ->get()
                ->map(function ($timeSlotDay) {
                    // Formater le timestamp 'day' pour chaque créneau horaire
                    $timeSlotDay->dayFormatte = Carbon::parse($timeSlotDay->day)->translatedFormat('l j F Y');
    
                    // creer une fonction qui retourne vrai ou faux en fonction de si un timeslotday possède au moins 1 timeslot actif
    
                    return $timeSlotDay;
                })->toArray();
        }

            //Select Timeslot
    public function selectTimeSlot(int $timeSlotDayId, int $timeSlotId): void
    {
        $this->timeSlotDayId = $timeSlotDayId;
        $this->timeSlotId = $timeSlotId;

        $this->timeSlotDayForHuman = Carbon::parse(TimeSlotDay::where('id', $timeSlotDayId)->firstOrFail()->day)->translatedFormat('l j F Y');
        
        $this->timeSlotForHuman = Carbon::parse(TimeSlot::where('id', $timeSlotId)->firstOrFail()->start_time)->format('H\hi');

        $this->appointment["time_slot_day"] = $this->timeSlotDayId;
        $this->appointment["time_slot"] = $this->timeSlotId;

        $this->appointment["time_slot_day_for_human"] = $this->timeSlotDayForHuman;
        $this->appointment["time_slot_for_human"] = $this->timeSlotForHuman;
        
        $this->timeSlotIsSelected = true;

        // dd('Appointment Data:', $this->appointment);

        $this->dispatch('timeslot-is-selected', ['appointment' => $this->appointment]);
    }

        //Navigate Timeslot -NEXT-
        public function nextTimeSlots(): void
        {
            $this->offsetTimeSlot += $this->limitTimeSlotDays;
            $this->loadTimeSlotDays();
        }
        //Navigate Timeslot -PREV-
        public function prevTimeSlots(): void
        {
            if ($this->offsetTimeSlot == 0) {
                $this->offsetTimeSlot = 0;
            } else {
                $this->offsetTimeSlot -= $this->limitTimeSlotDays;
            }
            $this->loadTimeSlotDays();
        }

    public function render()
    {
        return view('livewire.admin.select-timeslot-appointment');
    }
}
