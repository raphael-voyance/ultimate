<?php

namespace App\Http\Controllers\Universe;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DrawCard;
use App\Models\TarotCard;

//use Illuminate\Support\Facades\Gate;

class DrawsController extends Controller
{
    public function index(): View {
        $draws = DrawCard::all();

        return view('universe.draws.index', [
            'draws' => $draws
        ]);
    }

    public function create(): View {
        return view('universe.draws.create');
    }

    public function store(Request $request): View {
        
        //dd($request->all());
        $draw = DrawCard::create($request->all());
        
        if($draw) {
            $cards = TarotCard::all();

            $nbArcane = $request->totalSelectedCards;
            $datas = [];

            for ($i = 1; $i <= $nbArcane; $i++) {
                $datas[(string)$i] = '';
            }

            foreach($cards as $card) {
                $interpretations = json_decode($card->interpretationsForDrawingCard, true);

                if (is_array($interpretations)) {
                    // Ajouter ou mettre à jour une propriété dans le tableau
                    $interpretations[$request->slug] = $datas;
    
                    // Encoder le tableau en JSON
                    $card->interpretationsForDrawingCard = json_encode($interpretations);
    
                    // Enregistrer les modifications
                    $card->save();
    
                    //dump($interpretations);
                } else {
                    // Gérer le cas où le décodage JSON échoue
                    dd('Erreur de décodage JSON pour la carte: ' . $card->id);
                }
                
            }
            
            //dd($draw, $cards);
        }


        return view('universe.draws.index');
    }
}
