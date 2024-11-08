<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\TimeSlot;
use App\Models\TimeSlotDay;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DataTableTimeSlots extends Component
{
    public $perPage = 10;
    public $currentPage = 1;
    public $headers;
    public $timeslots;
    public $timeslotForDeleted = false;

    public function mount() {
        $this->headers = [
            ['key' => 'day', 'label' => 'Jours'],
            ['key' => 'start_time', 'label' => 'Heure de début'],
            ['key' => 'end_time', 'label' => 'Heure de fin'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];

        $this->timeslots = TimeSlotDay::with('time_slots')->get();
        foreach ($this->timeslots as $timeSlotDay) {
            foreach ($timeSlotDay->time_slots as $timeslot) {
                
                $dateTime = Carbon::parse($timeSlotDay->day)->setTimeFromTimeString($timeslot->end_time);
                
                if ($dateTime->lessThan(now())) {
                    $this->timeslotForDeleted = true;
                }
            }
        }
    }

    public function deletePastsTimeslots() {
        
        $timeslotDeleted = false;

        foreach ($this->timeslots as $timeSlotDay) {
            foreach ($timeSlotDay->time_slots as $timeslot) {
                
                $dateTime = Carbon::parse($timeSlotDay->day)->setTimeFromTimeString($timeslot->end_time);
                
                if ($dateTime->lessThan(now())) {
                    $timeslot->delete();
                    $timeslotDeleted = true;
                }
            }
        }

        if($timeslotDeleted) {
            toast()->success('Les créneaux horaires antérieurs à aujourd\'hui ont bien été supprimés.')->pushOnNextPage();
            $this->dispatch('refreshPage');
        }
    }

    public function render()
    {
        $timeSlotDays = TimeSlotDay::with('time_slots')->get()->sortBy('day');
        $rows = [];

        foreach ($timeSlotDays as $timeSlotDay) {
            foreach ($timeSlotDay->time_slots as $timeslot) {
                $rows[] = [
                    'day' => \Carbon\Carbon::parse($timeSlotDay->day)->translatedFormat('l d F Y'),
                    'start_time' => \Carbon\Carbon::parse($timeslot->start_time)->format('H\hi'),
                    'end_time' => \Carbon\Carbon::parse($timeslot->end_time)->format('H\hi'),
                    'actions' => $timeSlotDay->id,
                    'available' => $timeslot->pivot->available,
                ];
            }
        }

        $cell_decoration = [
            'start_time' => [
                'bg-red-500/25' => fn($row) => $row['available'] == false,
            ],
            'end_time' => [
                'bg-red-500/25' => fn($row) => $row['available'] == false,
            ],
        ];

        $paginatedRows = $this->paginate($rows);

        return view('livewire.admin.data-table-time-slots', [
            'rows' => $paginatedRows,
            'cell_decoration' => $cell_decoration,
        ]);
    }

    public function paginate($items)
    {
        $items = collect($items);
        $total = $items->count();
        $items = $items->slice(($this->currentPage - 1) * $this->perPage, $this->perPage)->values();
        return new LengthAwarePaginator($items, $total, $this->perPage, $this->currentPage, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }

    public function gotoPage($page)
    {
        $this->currentPage = $page;
    }
}
