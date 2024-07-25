<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DataTableAppointment extends Component
{
    public $user_id;
    public $pastAppointments;
    public $upComingAppointments;

    public function mount() {
        $this->user_id = Auth::user()->id;
        $now = Carbon::now();

        $appointments = Appointment::where('user_id', $this->user_id)
            ->with('timeSlot', 'timeSlotDay')
            ->get();

            $this->pastAppointments = $appointments->filter(function ($appointment) use ($now) {
            $appointmentDateTime = Carbon::parse($appointment->timeSlotDay->day)
                ->setTimeFromTimeString($appointment->timeSlot->start_time);
            return $appointmentDateTime->isPast();
        });

        $this->upComingAppointments = $appointments->filter(function ($appointment) use ($now) {
            $appointmentDateTime = Carbon::parse($appointment->timeSlotDay->day)
                ->setTimeFromTimeString($appointment->timeSlot->start_time);
            return $appointmentDateTime->isFuture();
        });
    }
    

    public function render()
    {        
        return view('livewire.data-table-appointment');
    }
}
