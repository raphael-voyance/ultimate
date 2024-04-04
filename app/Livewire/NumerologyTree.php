<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class NumerologyTree extends Component
{
    public $day;
    public $month;
    public $year;
    public $results;
    public $user;
    public $currentYear;
    public $birthday;
    public $birthdayIsEmpty;
    public $age;
    public $btnText = 'Ajouter votre date de naissance';
    public $hasError;
    public $errorMessage;
    public bool $birthdayModal = false;

    public function mount()
    {
        $this->currentYear = date('Y');

        if ($this->user->profile->birthday) {
            $this->birthdayIsEmpty = false;
            $this->birthday = Carbon::create($this->user->profile->birthday);
            $this->day = str_pad($this->birthday->day, 2, '0', STR_PAD_LEFT);
            $this->month = str_pad($this->birthday->month, 2, '0', STR_PAD_LEFT);
            $this->year = $this->birthday->year;
            $this->age = $this->calculateAge();
            $this->btnText = 'Modifier votre date de naissance';
            $this->calculateNumerology();
        }else {
            $this->birthdayIsEmpty = true;
            $this->errorMessage = 'Merci de saisir une date valide';
        }
    }

    public function closeModal()
    {
        $this->birthdayModal = false;
    }

    public function saveBirthday()
    {
        $this->hasError = false;
        $this->calculateNumerology();

        if ($this->hasError) {
            return false;
        }

        $day = intval($this->day);
        $month = intval($this->month);
        $year = intval($this->year);
        $birthday = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) . ' 00:00:00';

        // Recalcule de l'âge de la personne
        $this->birthday = Carbon::create($birthday);
        $this->calculateAge();

        $this->user->profile->update([
            'birthday' => $birthday,
            'numerology' => json_encode($this->results),
            'age' => $this->age
        ]);
        $this->btnText = 'Modifier votre date de naissance';
        $this->closeModal();

        $this->dispatch('save-birthday');
    }

    public function calculateNumerology()
    {
        if (
            $this->day === null || $this->day === '' || intval($this->day) > 31 || intval($this->day) <= 0 ||
            $this->month === null || $this->month === '' || intval($this->month) > 12 || intval($this->month) <= 0 ||
            $this->year === null || intval($this->year) <= 0 || intval($this->year) == date('Y') || $this->year === '' || intval($this->year) < 1000 || intval($this->year) > 9999
        ) {
            $this->hasError = true;
            $this->day = date('d');
            $this->month = date('m');
            $this->year = date('Y');
            $this->errorMessage = 'Merci de saisir une date valide';
            return false;
        }

        $this->birthdayIsEmpty = false;
        $day = intval($this->day);
        $month = intval($this->month);
        $year = intval($this->year);
        $currentYear = intval($this->currentYear);

        // Fonction pour réduire un nombre à un chiffre
        $reduceToSingleDigit = function ($number) {
            if ($number > 9) {
                $digits = array_map('intval', str_split($number));
                $number = array_sum($digits);
            }
            return $number;
        };

        // Calcul de l'arbre de vie numérologique
        // Création des réductions successives de l'arbre
        $numerologyResults = [];

        while ($day > 9 || $month > 9 || $year > 9) {
            $tempDigits = [
                $reduceToSingleDigit($day),
                $reduceToSingleDigit($month),
                $reduceToSingleDigit($year)
            ];

            $numerologyResults[] = $tempDigits;

            $day = $tempDigits[0];
            $month = $tempDigits[1];
            $year = $tempDigits[2];
        }

        // Création des réductions successives du chemin de vie
        $lifePath = $day + $month + $year;
        $lifePathResults[] = [$lifePath];
        while ($lifePath > 9) {
            $tempDigits = [
                $reduceToSingleDigit($lifePath)
            ];

            $lifePathResults[] = $tempDigits;

            $lifePath = $tempDigits[0];
        }

        // Calcul de l'arbre de vie numérologique annuel
        // Création des réductions successives de l'arbre
        $numerologyCurrentYearResults = [];

        while ($day > 9 || $month > 9 || $currentYear > 9) {
            $tempDigits = [
                $reduceToSingleDigit($day),
                $reduceToSingleDigit($month),
                $reduceToSingleDigit($currentYear)
            ];

            $numerologyCurrentYearResults[] = $tempDigits;

            $day = $tempDigits[0];
            $month = $tempDigits[1];
            $currentYear = $tempDigits[2];
        }

        // Création des réductions successives du chemin de l'année
        $currentYearPath = $day + $month + $currentYear;
        $currentYearResults[] = [$currentYearPath];
        while ($currentYearPath > 9) {
            $tempDigits = [
                $reduceToSingleDigit($currentYearPath)
            ];

            $currentYearResults[] = $tempDigits;

            $currentYearPath = $tempDigits[0];
        }

        // Passage des résultats obtenus à la vue
        $this->results = [
            'numerologyResults' => $numerologyResults,
            'lifePathResults' => $lifePathResults,
            'lifePath' => $lifePath,
            'numerologyCurrentYearResults' => $numerologyCurrentYearResults,
            'currentYearResults' => $currentYearResults,
            'currentYearPath' => $currentYearPath,
        ];

        $this->dispatch('refresh-tree-numerology', tree: json_encode($this->results));

    }

    public function decrementYear() {
        $this->currentYear--;
        $this->calculateNumerology();
        $this->age--;
    }
    public function incrementYear() {
        $this->currentYear++;
        $this->calculateNumerology();
        $this->age++;
    }

    public function resetCurrentYear() {
        $this->currentYear = date('Y');
        $this->calculateNumerology();
        $this->age = $this->calculateAge();
    }

    public function calculateAge() {
        $this->age = $this->birthday->age;
        return $this->birthday->age;
    }

    public function render()
    {
        return view('livewire.numerology-tree');
    }
}
