<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\TimeSlotDay;
use Illuminate\Database\Eloquent\Builder;

class ModalEditAppointment extends Component
{
    public $ModalEditAppointment = false;
    public $appointment;
    public $appointmentDay;
    public $appointmentTime;
    public $initialeDate;
    public $timeSlotDays;
    public int $offsetTimeSlot = 0;
    public $totalOffsetTimeSlot;

    public function mount($appointment)
    {
        $this->appointment = $appointment;
        $this->appointmentDay = $appointment->timeSlotDay->day;
        $this->appointmentTime = $appointment->timeSlot->start_time;
        $this->initialeDate = $this->completeInitialeDate();

        // Initialize SlotDays - JEN SUIS ICI -
        $totalSlotDays = TimeSlotDay::all()->count();
        $this->totalOffsetTimeSlot = ceil($totalSlotDays / 5);
        $this->loadTimeSlotDays();
    }

    private function completeInitialeDate()
    {
        // Convertir la date et l'heure en instances Carbon
        $date = Carbon::parse($this->appointmentDay);
        $time = Carbon::parse($this->appointmentTime);

        // Formater la date et l'heure
        $formattedDate = $date->format('d/m/Y');
        $formattedTime = $time->format('H\hi');

        // Retourner la date et l'heure formatées
        return $formattedDate . ' à ' . $formattedTime;
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
            ->limit(5)
            ->get()
            ->map(function ($timeSlotDay) {
                // Formater le timestamp 'day' pour chaque créneau horaire
                $timeSlotDay->dayFormatte = Carbon::parse($timeSlotDay->day)->translatedFormat('l j F Y');

                // creer une fonction qui retourne vrai ou faux en fonction de si un timeslotday possède au moins 1 timeslot actif

                return $timeSlotDay;
            })->toArray();
    }

    public function render()
    {
        return view('livewire.modal-edit-appointment');
    }
}
