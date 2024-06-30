<?php

namespace App\Http\Controllers\Universe;

use App\Concern\Tarot;
use App\Models\DrawCard;
use App\Models\TarotCard;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TarotController extends Controller
{
    public function index() {
        $t_creator = new Tarot();
        $cards = $t_creator->cards;
        return view('universe.tarot.index', ['cards' => $cards]);
    }

    public function view(Request $request) {

        $card = TarotCard::where('slug', $request->slug)->firstOrFail();
        $interpretations = json_decode($card->interpretationsForDrawingCard);
        $numerology = json_decode($card->arcanePath);
        $draws = DrawCard::all();

        return view('universe.tarot.view', [
            'card' => $card,
            'interpretations' => $interpretations,
            'numerology' => $numerology,
            'draws' => $draws
        ]);
    }

    public function update(Request $request) {

        //** Récupérer le champ à modifier : soit interpretation / numerology / autre
        $request->validate([
            'field' => 'required',
            'value' => 'required'
        ]);

        $card = TarotCard::where('slug', $request->slug)->firstOrFail();

        $field = $request->field;
        $value = $request->value;

        if($field == 'interpretation') {
            $request->validate([
                'draw' => 'required',
                'position' => 'required'
            ]);

            $draw = $request->draw;
            $position = $request->position;

            $interpretations = json_decode($card->interpretationsForDrawingCard, true);

            if (isset($interpretations[$draw])) {
                $interpretations[$draw][$position] = $value;
            } else {
                $interpretations[$draw] = [
                    $position => $value
                ];
            }


            $card->interpretationsForDrawingCard = json_encode($interpretations);


        }else if($field == 'numerology') {
            $request->validate([
                'arcanePath' => 'required'
            ]);

            $arcanePath = $request->arcanePath;

            $interpretations = json_decode($card->arcanePath, true);

            if (isset($interpretations[$arcanePath])) {
                $interpretations[$arcanePath] = $value;
            } else {
                $interpretations[$arcanePath] = [
                    $arcanePath => $value
                ];
            }

            $card->arcanePath = json_encode($interpretations);
            
        }else {
            if($field == "name") {
                $slug = Str::slug($value, $separator = '-', $language = 'fr');
                $card->name = $value;
                $card->slug = $slug;
            }else {
                $card->$field = $value;
            }
        }
        
        $card->save();

        return response()->json(['message' => 'La carte a été mise à jour avec succés !']);
    }
}
