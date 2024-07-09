<?php

namespace App\Concern;

use App\Models\DrawCard;
use App\Models\TarotCard;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

class Tarot
{

    public $cards = [];
    public $arrayCards = [];

    public $drawingCards = [];

    public function __construct()
    {
        $this->cards = TarotCard::all();
        $this->drawingCards = DrawCard::where('active', true)->get();
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
        $drawInterpretation = $this->createResponseInterpretation($drawCards, $draw);
        return response()->json($drawInterpretation, 200);
    }

    private function createResponseInterpretation($cards, $drawSlug)
    {
        $drawModel = DrawCard::where('slug', $drawSlug)->first();
        //dd($drawModel->positionsKeywords);
        $draw = [
            'drawSlug' => $drawSlug,
        ];

        if(isset($drawModel->positionsKeywords)) {
            $draw = [
                'drawPositions' => json_encode($drawModel->positionsKeywords),
            ];
        };

        if($cards[0] == 'cut') array_shift($cards);

        //dd($drawModel->hasSumCards);
        if(isset($drawModel->hasSumCards)) {
            $sum = array_sum($cards);
            $sum = $this->reduceNumberBetweenOneToTwentyOne($sum);
            $cards[] = strval($sum);
        }

        foreach($cards as $k=>$card) {
            
            $card = $this->getCard($card);

            $position = $k +1;
            //dd($position);
            $interpretations = json_decode($card->interpretationsForDrawingCard);

            if (isset($interpretations->$drawSlug)) {
                // Convert the object to an array for easier manipulation
                $interpretationsArray = (array) $interpretations->$drawSlug;

                // dd($interpretationsArray);
            
                if (isset($interpretationsArray[$position]) && ($interpretationsArray[$position] === null || $interpretationsArray[$position] === '')) {
                    $interpretation = $card->description;
                } else {
                    $interpretation = $interpretationsArray[$position] ?? "Aucune interprétation trouvée pour cette carte...";
                }
            } else {
                $interpretation = "Aucune interprétation trouvée pour cette carte...";
            }
            

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

        
        // dd($draw);

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

        $arcaneLifePath = $this->getCard($arcaneLifePath, true);
        $arcaneAnnualPath = $this->getCard($arcaneAnnualPath, true);
        $arcaneSumPath = $this->getCard($arcaneSumPath, true);

        // dd('arcaneLifePath', $arcaneLifePath,
        //     'arcaneAnnualPath', $arcaneAnnualPath,
        //     'arcaneSumPath', $arcaneSumPath);

        return json_encode($datas = [
            'birthdate' => $birthdate,
            'arcaneLifePath' => $arcaneLifePath,
            'arcaneAnnualPath' => $arcaneAnnualPath,
            'arcaneSumPath' => $arcaneSumPath,
        ]);
    }

    public function getCard($numberOfCard, $thatNumberArcane = false)
    {
        $card = TarotCard::where('numberArcane', $numberOfCard)->firstOrFail();
        if($thatNumberArcane == false) {
            return $card;
        }else {
            return $card->numberArcane;
        }
        
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
