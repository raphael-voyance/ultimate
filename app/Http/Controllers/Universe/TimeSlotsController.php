<?php

namespace App\Http\Controllers\Universe;

use DateTime;
use DateInterval;
use App\Models\TimeSlot;
use Illuminate\View\View;
use App\Models\Appointment;
use App\Models\TimeSlotDay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeSlotsController extends Controller
{
    public function index(): View
    {
        return view('universe.timeslots.index');
    }

    public function createi(Request $request)
    {
        // Récupération des paramètres de la requête
        $mode = $request->mode;
        $time = new DateInterval('PT' . $this->parseTimeToInterval($request->time)); // durée du créneau
        $interval = new DateInterval('PT' . $this->parseTimeToInterval($request->interval)); // intervalle de temps entre les créneaux
        $startTime = new DateTime($request->start_time); // heure de départ
        $endTime = new DateTime($request->end_time); // heure de fin

        $timeSlotDays = [];

        if ($mode == 'betweenDate') {
            $dateStart = new DateTime($request->dateStart); // date de départ
            $dateEnd = new DateTime($request->dateEnd); // date de fin

            // Boucle pour chaque jour entre dateStart et dateEnd
            for ($date = clone $dateStart; $date <= $dateEnd; $date->modify('+1 day')) {
                $timeSlotDays[] = $this->createTimeSlotDay($date, $startTime, $endTime, $time, $interval);
            }
        } elseif ($mode == 'days') {
            $nbWeeks = $request->nbWeeks; // nombre de semaines à générer
            $mtofOrWe = $request->mtofOrWe; // mtof => du lundi au vendredi, we => week-end

            // Boucle pour générer les jours en fonction de la période et du nombre de semaines
            $currentDate = new DateTime();
            for ($week = 0; $week < $nbWeeks; $week++) {
                for ($day = 0; $day < 7; $day++) {
                    $currentDate->modify('+1 day');
                    $dayOfWeek = $currentDate->format('N');

                    if (($mtofOrWe === 'mtof' && $dayOfWeek <= 5) || ($mtofOrWe === 'we' && $dayOfWeek >= 6)) {
                        $timeSlotDays[] = $this->createTimeSlotDay(clone $currentDate, $startTime, $endTime, $time, $interval);
                    }
                }
            }
        }

        // Persistance dans la base de données
        // foreach ($timeSlotDays as $timeSlotDay) {
        //     $timeSlotDay->save();
        // }

        if (empty(array_filter($timeSlotDays))) {
            return response()->json(['message' => 'Aucun nouveau créneau horaire à enregistrer.'], 400);
        }

        //dd($mode, $time, $interval, $startTime, $endTime, $nbWeeks, $mtofOrWe, $currentDate, $dayOfWeek, $timeSlotDays);

        return response()->json(['message' => 'Les nouveaux créneaux horaires ont bien été enregistrés.'], 200);
    }

    public function createu(Request $request)
    {
        dd($request->all());
        // dd($request->startModel);
        // Validations
        $request->validate([
            'time' => 'required|string',
            'interval' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'nbWeeks' => 'required|integer|min:1|max:4',
            'mtofOrWe' => 'required|string|in:mtof,we',

            'startModel' => 'required|string|in:tomorrow,date',
            'dateStart' => 'nullable|date|required_if:startModel,date',
        ]);

        // dd($request->all());

        $time = new DateInterval('PT' . $this->parseTimeToInterval($request->time));
        $interval = new DateInterval('PT' . $this->parseTimeToInterval($request->interval));
        $startTime = DateTime::createFromFormat('H:i', $request->start_time)->format("H:i");
        $endTime = DateTime::createFromFormat('H:i', $request->end_time)->format("H:i");

        $startModel = $request->startModel;

        // dd($time, $interval, $startTime, $endTime);

        $timeSlotDays = [];

        $nbWeeks = $request->nbWeeks;
        $mtofOrWe = $request->mtofOrWe;
        $currentDate = $startModel == 'tomorrow' ? (new DateTime())->modify('+1 day') : new DateTime($request->dateStart);

        // dd($nbWeeks, $mtofOrWe, $currentDate);

        for ($week = 0; $week < $nbWeeks; $week++) {
            for ($day = 0; $day < 7; $day++) {
                $dayOfWeek = $currentDate->format('N');

                if (($mtofOrWe === 'mtof' && $dayOfWeek <= 5) || ($mtofOrWe === 'we' && $dayOfWeek >= 6)) {
                    $timeSlotDays[] = $this->createTimeSlotDay(clone $currentDate, $startTime, $endTime, $time, $interval);
                }
            }
        }

        $timeSlotDays = array_filter($timeSlotDays); // Filtrer les entrées nulles
        if (empty($timeSlotDays)) {
            return response()->json(['message' => 'Aucun nouveau créneau horaire à enregistrer.'], 400);
        }

        return response()->json(['message' => 'Les nouveaux créneaux horaires ont bien été enregistrés.'], 200);
    }


    private function createTimeSlotDayu($date, $startTime, $endTime, $time, $interval)
    {
        $existingTimeSlotDay = TimeSlotDay::where('day', $date->format('Y-m-d'))->first();

        if ($existingTimeSlotDay) {
            return;
        }

        // dd($date, $startTime, $endTime, $time, $interval);

        $timeSlotDay = new TimeSlotDay();
        $timeSlotDay->day = $date->format('Y-m-d 00:00:00');

        // dd($timeSlotDay);

        $timeSlotDay->save();

        $startTime = DateTime::createFromFormat('H:i', $startTime);
        $endTime = DateTime::createFromFormat('H:i', $endTime);
        $slots = [];

        // dd($startTime);

        $currentSlotStart = clone $startTime;

        while ($currentSlotStart < $endTime) {
            $slotEndTime = (clone $currentSlotStart)->add($time);

            $existingSlot = TimeSlot::where('start_time', $currentSlotStart->format('H:i'))
                ->where('end_time', $slotEndTime->format('H:i'))
                ->first();

            if ($existingSlot) {
                $timeSlotDay->time_slots()->attach($existingSlot->id);
            } else {
                $slot = new TimeSlot();
                $slot->start_time = $currentSlotStart->format('H:i');
                $slot->end_time = $slotEndTime->format('H:i');
                $slot->save();

                $slots[] = $slot;
            }

            // Créer un objet DateTime de référence (n'importe quelle date/heure)
            $referenceDate = new DateTime();
            $referenceDate->add($interval);
            // dd($referenceDate);
            $referenceDate->add($time);

            // dd($referenceDate);

            // Calculer la différence en partant de la date de référence initiale
            $resultInterval = $referenceDate->diff(new DateTime());
            $currentSlotStart->add($resultInterval);

            dd($currentSlotStart);
        }

        // Associer les nouveaux TimeSlots au TimeSlotDay
        $timeSlotDay->time_slots()->saveMany($slots);

        return $timeSlotDay;
    }

    public function create(Request $request)
    {
        $request->validate([
            'addUniqueTimeSlot' => 'required|boolean',
        ]);

        if($request->addUniqueTimeSlot) {
            
            $request->validate([
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i',
                'date' => 'required|date',
            ]);

            $startTime = DateTime::createFromFormat('H:i', $request->start_time);
            $endTime = DateTime::createFromFormat('H:i', $request->end_time);
            $date = new DateTime($request->date);

            // Vérifie si un TimeSlotDay existe déjà pour cette date
            $timeSlotDay = TimeSlotDay::where('day', $date->format('Y-m-d'))->first();

            // Si aucun TimeSlotDay n'existe, créer un nouveau TimeSlotDay
            if (!$timeSlotDay) {
                $timeSlotDay = new TimeSlotDay();
                $timeSlotDay->day = $date->format('Y-m-d 00:00:00');
                $timeSlotDay->save();
            }

            // Vérifier si un TimeSlot qui commence à la même heure existe déjà
            $existingSlot = TimeSlot::where('start_time', $startTime->format('H:i:s'))
                ->where('end_time', $endTime->format('H:i:s'))
                ->first();

            if ($existingSlot) {
                $timeSlotDay->time_slots()->syncWithoutDetaching([$existingSlot->id]);
            }else {
                $slot = new TimeSlot();
                $slot->start_time = $startTime->format('H:i:s');
                $slot->end_time = $endTime->format('H:i:s');
                $slot->save();

                $timeSlotDay->time_slots()->attach($slot->id);
            }
            
            return response()->json(['message' => 'Le créneau horaire a bien été enregistré.'], 200);
        }

        // Validation des entrées
        $request->validate([
            'time' => 'required|string',
            'interval' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'nbWeeks' => 'required|integer|min:1|max:4',
            'mtofOrWe' => 'required|string|in:mtof,we',
            'startModel' => 'required|string|in:tomorrow,date',
            'dateStart' => 'nullable|date|required_if:startModel,date',
        ]);

        // Conversion des paramètres
        $time = new DateInterval('PT' . $this->parseTimeToInterval($request->time));
        $interval = new DateInterval('PT' . $this->parseTimeToInterval($request->interval));
        $startTime = DateTime::createFromFormat('H:i', $request->start_time);
        $endTime = DateTime::createFromFormat('H:i', $request->end_time);

        // Détermination de la date de début
        $startModel = $request->startModel;
        $currentDate = $startModel == 'tomorrow' ? (new DateTime())->modify('+1 day') : new DateTime($request->dateStart);

        // Récupération du nombre de semaines et des jours sélectionnés (semaine ou week-end)
        $nbWeeks = $request->nbWeeks;
        $mtofOrWe = $request->mtofOrWe;

        // Création des créneaux horaires
        for ($week = 0; $week < $nbWeeks; $week++) {
            for ($day = 0; $day < 7; $day++) {
                $dayOfWeek = $currentDate->format('N');

                if (($mtofOrWe === 'mtof' && $dayOfWeek <= 5) || ($mtofOrWe === 'we' && $dayOfWeek >= 6)) {
                    $this->createTimeSlotDay(clone $currentDate, $startTime, $endTime, $time, $interval);
                }
                $currentDate->modify('+1 day');
            }
        }

        return response()->json(['message' => 'Les nouveaux créneaux horaires ont bien été enregistrés.'], 200);
    }

    private function createTimeSlotDayn($date, $startTime, $endTime, $time, $interval)
    {
        // Vérifie si un TimeSlotDay existe déjà pour cette date
        //$existingTimeSlotDay = TimeSlotDay::where('day', $date->format('Y-m-d'))->first();
        $timeSlotDay = TimeSlotDay::where('day', $date->format('Y-m-d'))->first();
        // dd($timeSlotDay);
        if (!$timeSlotDay) {
            // Crée un nouveau TimeSlotDay
            $timeSlotDay = new TimeSlotDay();
            $timeSlotDay->day = $date->format('Y-m-d 00:00:00');
            $timeSlotDay->save();
        }

        // Crée les créneaux horaires pour ce jour
        $currentSlotStart = clone $startTime;
        $slots = [];

        while ($currentSlotStart < $endTime) {
            // Calcul du créneau de fin
            $slotEndTime = (clone $currentSlotStart)->add($time);

            // Vérifie que le créneau de fin ne dépasse pas la limite spécifiée par $endTime
            if ($slotEndTime > $endTime) {
                break; // Sortir de la boucle si l'heure de fin dépasse la limite
            }

            // Vérifier si le timeslot commence à la mm h, si oui détacher le timeslot et l'attacher à un autre timeslotday
            $existingSlotSomeStart = TimeSlot::where('start_time', $currentSlotStart->format('H:i:s'))->get();
            // dd($existingSlotSomeStart);
            if ($existingSlotSomeStart) {
                foreach($existingSlotSomeStart as $slot) {
                    $timeSlotDay->time_slots()->detach($slot->id);
                }
            }

            // Vérifie si ce créneau horaire existe déjà
            $existingSlot = TimeSlot::where('start_time', $currentSlotStart->format('H:i:s'))
                ->where('end_time', $slotEndTime->format('H:i:s'))
                ->first();

            if ($existingSlot) {
                // Si le créneau existe, l'associer au TimeSlotDay
                $timeSlotDay->time_slots()->syncWithOutDetaching($existingSlot->id);
            } else {
                // Sinon, créer un nouveau créneau horaire
                $slot = new TimeSlot();
                $slot->start_time = $currentSlotStart->format('H:i:s');
                $slot->end_time = $slotEndTime->format('H:i:s');
                $slot->save();

                $slots[] = $slot; // Ajouter le créneau créé à la liste
            }

            // Avancer l'heure de début du créneau suivant avec l'intervalle spécifié
            // Maintenant, nous ajoutons la durée du créneau ($time) + l'intervalle ($interval)
            $currentSlotStart = (clone $slotEndTime)->add($interval);
        }

        // Associer tous les nouveaux créneaux horaires au TimeSlotDay
        if (!empty($slots)) {
            $timeSlotDay->time_slots()->saveMany($slots);
        }

        return $timeSlotDay;
    }

    private function createTimeSlotDay($date, $startTime, $endTime, $time, $interval)
{
    // Vérifie si un TimeSlotDay existe déjà pour cette date
    $timeSlotDay = TimeSlotDay::where('day', $date->format('Y-m-d'))->first();

    // Si aucun TimeSlotDay n'existe, créer un nouveau TimeSlotDay
    if (!$timeSlotDay) {
        $timeSlotDay = new TimeSlotDay();
        $timeSlotDay->day = $date->format('Y-m-d 00:00:00');
        $timeSlotDay->save();
    }

    // Crée les créneaux horaires pour ce jour
    $currentSlotStart = clone $startTime;
    $slots = [];

    while ($currentSlotStart < $endTime) {
        // Calcul du créneau de fin
        $slotEndTime = (clone $currentSlotStart)->add($time);

        // Vérifie que le créneau de fin ne dépasse pas la limite spécifiée par $endTime
        if ($slotEndTime > $endTime) {
            break; // Sortir de la boucle si l'heure de fin dépasse la limite
        }

        // Vérifier si un TimeSlot qui commence à la même heure existe déjà
        $existingSlot = TimeSlot::where('start_time', $currentSlotStart->format('H:i:s'))->first();

        if ($existingSlot) {
            // Si un créneau avec la même heure de début existe déjà
            // Attacher le créneau existant au TimeSlotDay
            $timeSlotDay->time_slots()->syncWithoutDetaching([$existingSlot->id]);

            // Passer au créneau suivant
            $currentSlotStart = (clone $slotEndTime)->add($interval);
            continue;
        }

        // Sinon, créer un nouveau créneau horaire
        $slot = new TimeSlot();
        $slot->start_time = $currentSlotStart->format('H:i:s');
        $slot->end_time = $slotEndTime->format('H:i:s');
        $slot->save();

        // Ajouter le créneau à la liste pour l'association ultérieure avec le TimeSlotDay
        $slots[] = $slot;

        // Avancer l'heure de début du créneau suivant avec l'intervalle spécifié
        $currentSlotStart = (clone $slotEndTime)->add($interval);
    }

    // Associer tous les nouveaux créneaux horaires au TimeSlotDay
    if (!empty($slots)) {
        $timeSlotDay->time_slots()->saveMany($slots);
    }

    return $timeSlotDay;
}





    // Fonction utilitaire pour convertir une durée de type "01:00" en intervalle DateInterval
    private function parseTimeToInterval($time)
    {
        [$hours, $minutes] = explode(':', $time);
        return ($hours * 60 + $minutes) . 'M';
    }
}
