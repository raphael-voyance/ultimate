<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\TimeSlot;
use App\Models\TimeSlotDay;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;
use App\Concern\StatusAppointmentNotifications as ConcernNotifications;

class ModalEditAppointment extends Component
{
    public $ModalEditAppointment = false;
    public $appointment;
    public $appointmentDay;
    public $appointmentTime;
    public $initialeDate;
    public $initialAppointmentType;
    public $appointmentType;
    public $appointmentTypeHasChanged = false;

    public bool $timeSlotIsSelected = false;
    public int|null $timeSlotDayId = null;
    public int|null $timeSlotId = null;
    public string|null $timeSlotForHuman = null;
    public string|null $timeSlotDayForHuman = null;
    public $timeSlotDays;
    public int $offsetTimeSlot = 0;
    public $totalOffsetTimeSlot;

    public function mount($appointment)
    {
        $this->appointment = $appointment;
        $this->appointmentType = $appointment->appointment_type;
        $this->initialAppointmentType = $appointment->appointment_type;
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

    public function updated($propertyName)
    {
        if ($propertyName === 'appointmentType') {
            $this->updatedAppointmentType();
        }
    }

    public function updatedAppointmentType()
    {
        if($this->appointmentType != $this->initialAppointmentType) {
            $this->appointmentTypeHasChanged = true;
        } else {
            $this->appointmentTypeHasChanged = false;
        }
    }

    //Navigate Timeslot -NEXT-
    public function nextTimeSlots(): void
    {
        $this->offsetTimeSlot += 5;
        $this->loadTimeSlotDays();
    }
    //Navigate Timeslot -PREV-
    public function prevTimeSlots(): void
    {
        if ($this->offsetTimeSlot == 0) {
            $this->offsetTimeSlot = 0;
        } else {
            $this->offsetTimeSlot -= 5;
        }
        $this->loadTimeSlotDays();
    }

    // Consultation Tchat Or Phone >>>>>>
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
    }

    //Update Appointment
    public function updateAppointment(): void {

        $appointment = $this->appointment;
        $invoice = $appointment->invoice()->firstOrFail();

        //dd($invoice->products);

        if(!$this->timeSlotIsSelected) {

            //Mettre à jour l'appointment
            $appointment->appointment_type = $this->appointmentType;
            $appointment->save();

            //Mettre à jour la invoice
            $invoiceInformations = json_decode($invoice->invoice_informations, true);
            $invoiceInformations["type"] = $this->appointmentType;

            $invoice->invoice_informations = json_encode($invoiceInformations);
            $invoice->save();

            $invoice->products()->detach();
            $invoice->products()->attach(Product::where('slug', $this->appointmentType)->first()->id);

        }elseif($this->timeSlotIsSelected) {
            $lastTimeSlot = TimeSlot::where('id', $appointment->time_slot_id)->firstOrFail();
            $newTimeSlot = TimeSlot::where('id', $this->timeSlotId)->firstOrFail();

            //Mettre à jour l'appointment
            $appointment->appointment_type = $this->appointmentType;
            $appointment->time_slot_day_id = $this->timeSlotDayId;
            $appointment->time_slot_id = $this->timeSlotId;
            $appointment->save();

            //Mettre à jour le timeslot
            $lastTimeSlot->time_slot_days()->updateExistingPivot($appointment->time_slot_day_id, ['available' => true]);
            $newTimeSlot->time_slot_days()->updateExistingPivot($appointment->time_slot_day_id, ['available' => false]);

            //Mettre à jour la invoice
            $invoiceInformations = [
                "type" => $this->appointmentType,
                "time_slot_day" => $this->timeSlotDayId,
                "time_slot" => $this->timeSlotId,
                "time_slot_day_for_human" => $this->timeSlotDayForHuman,
                "time_slot_for_human" => $this->timeSlotForHuman
            ];
            $invoice->invoice_informations = json_encode($invoiceInformations);
            $invoice->save();

            $invoice->products()->detach();
            $invoice->products()->attach(Product::where('slug', $this->appointmentType)->first()->id);
        }

        if($appointment && $invoice) {
            toast()
            ->success('Votre consultation a été mise à jour avec succès.')
            ->pushOnNextPage();

            ConcernNotifications::sendNotification($invoice, 'updated');
            $this->redirectRoute('payment.create', [
                'payment_invoice_token' => $invoice->payment_invoice_token
            ]);
        }

        
            
    }

    public function render()
    {
        return view('livewire.modal-edit-appointment');
    }
}
