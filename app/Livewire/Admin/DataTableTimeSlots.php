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

    public array $selected = [];

    public function mount() {
        $this->headers = [
            ['key' => 'selection', 'label' => ''],
            ['key' => 'day', 'label' => 'Jours'],
            ['key' => 'start_time', 'label' => 'Heure de début'],
            ['key' => 'end_time', 'label' => 'Heure de fin'],
            ['key' => 'actions', 'label' => ''],
        ];

        $this->timeslots = TimeSlotDay::with('time_slots')->get();
        foreach ($this->timeslots as $timeSlotDay) {
            foreach ($timeSlotDay->time_slots as $timeslot) {
                
                $dateTime = Carbon::parse($timeSlotDay->day)->setTimeFromTimeString($timeslot->end_time);
                //$dateTime->lessThan(now())
                if ($dateTime->lessThan(Carbon::today())) {
                    if ($timeSlotDay->appointments()->exists()) {
                        continue;
                    }
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
                
                //si la date du créneau horaire est inférieure à la date actuelle
                if ($dateTime->lessThan(Carbon::today())) {
                    //si le créneau horaire a des rendez-vous
                    if ($timeSlotDay->appointments()->exists()) {
                        continue;
                    }
                    $timeSlotDay->delete();
                    $timeslotDeleted = true;
                }
            }
        }

        if($timeslotDeleted) {
            toast()->success('Les créneaux horaires antérieurs à aujourd\'hui ont bien été supprimés.')->pushOnNextPage();
            $this->dispatch('refreshPage');
        }
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

    public function toggleSelection($timeSlotDayId, $timeSlotId, $isChecked)
    {
        if ($isChecked) {
            // Ajouter au tableau $selected
            $this->selected[] = [
                'time_slot_day_id' => $timeSlotDayId,
                'time_slot_id' => $timeSlotId,
            ];
        } else {
            // Retirer du tableau $selected
            $this->selected = array_filter($this->selected, function ($selected) use ($timeSlotDayId, $timeSlotId) {
                return !($selected['time_slot_day_id'] == $timeSlotDayId && $selected['time_slot_id'] == $timeSlotId);
            });
        }
    }

    public function deleteSelectedTimeSlot() :void {
        $selected = $this->selected;
        foreach ($selected as $select) {
            $timeSlotDay = TimeSlotDay::find($select['time_slot_day_id']);
            $timeSlotDay->time_slots()->detach($select['time_slot_id']);
        }
        $this->selected = [];
    }

    public function deleteTimeSlot($timeSlotDayId, $timeSlotId) :void {
        $timeSlotDay = TimeSlotDay::find($timeSlotDayId);
        $timeSlotDay->time_slots()->detach($timeSlotId);
    }

    public function render()
    {
        $now = Carbon::now()->toDateString();

        // Récupérer les TimeSlotDays avec leurs time_slots associés, triés par jour
        $timeSlotDays = TimeSlotDay::with(['time_slots' => function ($query) {
            $query->orderBy('start_time'); // Tri des time_slots par heure de début
        }])
        ->where('day', '>=', $now)
        ->get()
        ->sortBy('day'); // Tri des TimeSlotDays par jour

        $rows = [];

        foreach ($timeSlotDays as $timeSlotDay) {

            //Tri supplémentaire des time_slots par start_time au cas où
            $sortedTimeSlots = $timeSlotDay->time_slots->sortBy('start_time');

            foreach ($sortedTimeSlots as $timeslot) {
                $rows[] = [
                    'selection' => [
                        'time_slot_day_id' => $timeSlotDay->id,
                        'time_slot_id' => $timeslot->id,
                    ],
                    'day' => \Carbon\Carbon::parse($timeSlotDay->day)->translatedFormat('l d F Y'),
                    'start_time' => \Carbon\Carbon::parse($timeslot->start_time)->format('H\hi'),
                    'end_time' => \Carbon\Carbon::parse($timeslot->end_time)->format('H\hi'),
                    'actions' => $timeSlotDay->id,
                    'available' => $timeslot->pivot->available,
                ];
            }
        }

        $cell_decoration = [
            'selection' => [
                'w-1' => fn() => true,
            ],
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

}
