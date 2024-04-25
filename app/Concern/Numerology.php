<?php

namespace App\Concern;

class Numerology
{

    // Fonction pour réduire un nombre à un chiffre entre 1 et 9
    private function reduceNumberBetweenOneToNine($number) {
        if ($number <= 9) {
            return $number;
        } else {
            $sum = 0;
            while ($number > 0) {
                $sum += $number % 10;
                $number = floor($number / 10);
            }
            return $this->reduceNumberBetweenOneToNine($sum);
        }
    }

    // Fonction pour calculer la somme des chiffres de la date
    public function calculatePath($dateStr, $currentYear = null) {
        $datas = [];
        // Extrait uniquement l'année, le mois et le jour de la chaîne de date
        
        [$year, $month, $day] = explode("-", $dateStr);

        $birthdate = $day . '/' . $month . '/' . $year;

        // Conversion en nombres
        $year = $currentYear ? intval($currentYear) : intval($year);
        $month = intval($month);
        $day = intval($day);

        $sumBirthdate = $year + $month + $day;

        //dd('day: ' . $day, 'm: ' . $month, 'y: ' . $year);
        // Addition des chiffres de chaque composant
        $lifePath = $this->reduceNumberBetweenOneToNine($sumBirthdate);

        if($currentYear) {
            $sumCurrentYear = $currentYear + $month + $day;
            $annualPath = $this->reduceNumberBetweenOneToNine($sumCurrentYear);
        }else {
            $sumCurrentYear = intval(date("Y")) + $month + $day;
            $annualPath = $this->reduceNumberBetweenOneToNine($sumCurrentYear);
        }

        $lifePath = $this->reduceNumberBetweenOneToNine($lifePath);
        $annualPath = $this->reduceNumberBetweenOneToNine($annualPath);
        $sumPath = $this->reduceNumberBetweenOneToNine($annualPath + $lifePath);

        return json_encode($datas = [
            'birthdate' => $birthdate,
            'lifePath' => $lifePath,
            'annualPath' => $annualPath,
            'sumPath' => $sumPath
        ]);
    }

}