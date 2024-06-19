<?php

namespace App\Concern;

use App\Models\DrawCard;
use App\Models\TarotCard;
use Illuminate\Support\Str;

class Tarot
{

    public $cards = [];
    public $arrayCards = [];

    public $drawingCards = [];

    public function __construct()
    {
        $this->cards = TarotCard::all();
        $this->drawingCards = DrawCard::all();
    }

    //Tirages
    public function loadDeck($except = [], $only = [])
    {
        if ($only) {
            $this->cards = $this->cards->setVisible($only);;
        }
        if ($except) {
            $this->cards = $this->cards->setHidden($except);;
        }
        return $this->cards;
    }

    public function loadInterpretations(array $drawCards = [], string $draw = '')
    {
        //dd($drawCards, $draw);
        //$draw = str_replace('-', '_', $draw);
        $drawInterpretation = $this->createResponseInterpretation($drawCards, $draw);
        return response()->json($drawInterpretation, 200);
    }

    private function createResponseInterpretation($cards, $drawSlug)
    {
        // recuperer le draw dans une variable $drawModel
        // creer une variable hasSum = false
        // verifier si le tirage contient un hasSumCards et attribuer true à hasSum
        // si oui, l'ajouter 

        // if($hasSum) {
        //     $sum = array_sum($cards);
        //     $sum = $this->reduceNumberBetweenOneToTwentyOne($sum);
        //     $cards[] = str($sum);
        // }
        
        $draw = [
            'drawSlug' => $drawSlug
        ];

        if($cards[0] == 'cut') array_shift($cards);

        if($drawSlug == 'tirage-en-croix') {
            $sum = array_sum($cards);
            $sum = $this->reduceNumberBetweenOneToTwentyOne($sum);
            $cards[] = str($sum);
        }

        

        foreach($cards as $k=>$card) {
            $card = $this->getCard($card);

            $position = $k +1;
            $interpretations = json_decode($card->interpretationsForDrawingCard);

            if(isset($interpretations->$drawSlug)) {
                $interpretation = $interpretations->$drawSlug->$position;
            }else {
                $interpretation = "Aucune interprétation trouvée pour cette carte...";
            }
            
            
            //dump($interpretation);

            $c = [
                'position' => $position,
                'name' => $card->name,
                'nbArcane' => $card->numberArcane,
                'path' => $card->imgPath,
                'interpretation' => $interpretation
            ];

            

            $draw[] = $c;

            //dump($card);
        }

        //dump($draw);

        return [
            "cards" => $cards,
            "draw" => $draw,
            "drawSlug" => $drawSlug
        ];
    }

    //Numérologie
    public function calculatePath($dateStr, $currentYear = null)
    {
        $datas = [];
        // Extrait uniquement l'année, le mois et le jour de la chaîne de date

        [$year, $month, $day] = explode("-", $dateStr);

        $birthdate = $day . '/' . $month . '/' . $year;

        // Conversion en nombres
        $year = $currentYear ? intval($currentYear) : intval($year);
        $month = intval($month);
        $day = intval($day);

        $sumBirthdate = $year + $month + $day;

        $arcaneLifePath = $this->reduceNumberBetweenOneToTwentyOne($sumBirthdate);

        if ($currentYear) {
            $sumCurrentYear = $currentYear + $month + $day;
            $arcaneAnnualPath = $this->reduceNumberBetweenOneToTwentyOne($sumCurrentYear);
        } else {
            $sumCurrentYear = intval(date("Y")) + $month + $day;
            $arcaneAnnualPath = $this->reduceNumberBetweenOneToTwentyOne($sumCurrentYear);
        }

        $arcaneSumPath = $this->reduceNumberBetweenOneToTwentyOne($arcaneAnnualPath + $arcaneLifePath);

        $arcaneLifePath = $this->getCard($arcaneLifePath);
        $arcaneAnnualPath = $this->getCard($arcaneAnnualPath);
        $arcaneSumPath = $this->getCard($arcaneSumPath);

        return json_encode($datas = [
            'birthdate' => $birthdate,
            'arcaneLifePath' => $arcaneLifePath,
            'arcaneAnnualPath' => $arcaneAnnualPath,
            'arcaneSumPath' => $arcaneSumPath,
        ]);
    }

    public function getCard($numberOfCard)
    {
        $card = TarotCard::where('numberArcane', $numberOfCard)->first();
        return $card;
    }

    private function reduceNumberBetweenOneToTwentyOne($number)
    {
        if ($number <= 22) {
            return $number;
        } else {
            $sum = 0;
            while ($number > 0) {
                $sum += $number % 10;
                $number = floor($number / 10);
            }
            return $this->reduceNumberBetweenOneToTwentyOne($sum);
        }
    }
}
