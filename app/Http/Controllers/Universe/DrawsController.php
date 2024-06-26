<?php

namespace App\Http\Controllers\Universe;

use App\Models\DrawCard;
use App\Models\TarotCard;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

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

    public function store(Request $request) {
        
        $validated = $request->validate([
            'name' => 'required|unique:draw_cards|max:255|min:4',
            'slug' => 'required|unique:draw_cards',
            'description' => 'required|min:4',
            'totalSelectedCards' => 'required',
            'hasSumCards' => 'boolean',
            'active' => 'boolean',
        ]);

        $draw = new DrawCard();
        $draw->name = $request->name;
        $draw->slug = $request->slug;
        $draw->description = $request->description;
        $draw->totalSelectedCards = $request->totalSelectedCards;
        $draw->hasSumCards = $request->hasSumCards;
        $draw->active = $request->active;
        $draw->save();
        
        if($draw) {
            $cards = TarotCard::all();

            $nbArcane = $request->hasSumCards ? $request->totalSelectedCards +1 : $request->totalSelectedCards;
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
            
            toast()
                ->success('Le tirage a été créé avec succés !')
                ->pushOnNextPage();
        }


        return redirect()->route('admin.draw.index');
    }

    public function edit(Request $request) {
        // Draw
        $draw_id = $request->id;
        $draw = DrawCard::where('id', $draw_id)->firstOrFail();
        $drawKeywords = $draw->positionsKeywords ? json_decode($draw->positionsKeywords) : null;

        return view('universe.draws.edit', [
            'draw' => $draw,
            'drawKeywords' => $drawKeywords,
        ]);
    }
    
    public function update(Request $request) {
        // Draw
        $draw_id = $request->id;
        $draw = DrawCard::where('id', $draw_id)->firstOrFail();
    
        // Règles de validation
        $validated = $request->validate([
            'name' => [
                'required',
                'max:255',
                'min:4',
                Rule::unique('draw_cards', 'name')->ignore($draw_id)
            ],
            'slug' => [
                'required',
                Rule::unique('draw_cards', 'slug')->ignore($draw_id)
            ],
            'description' => 'required|min:4',
            'totalSelectedCards' => 'required',
            'hasSumCards' => 'boolean',
            'active' => 'boolean',
        ]);
    
        $draw->name = $request->name;
        $draw->slug = $request->slug;
        $draw->description = $request->description;
        $draw->totalSelectedCards = $request->totalSelectedCards;
        $draw->hasSumCards = $request->hasSumCards;
        $draw->active = $request->active;
        $draw->save();
    
        if ($draw) {
            $cards = TarotCard::all();
            $nbArcane = $request->hasSumCards ? $request->totalSelectedCards +1 : $request->totalSelectedCards;
    
            foreach ($cards as $card) {
                $interpretations = json_decode($card->interpretationsForDrawingCard, true);
    
                if (is_array($interpretations)) {
                    
                    if (!isset($interpretations[$request->slug]) || !is_array($interpretations[$request->slug])) {
                        $interpretations[$request->slug] = [];
                    }
    
                    $currentCount = count($interpretations[$request->slug]);
                    //dd((int)$nbArcane);
    
                    if ($currentCount < (int)$nbArcane) {
                        // Ajouter des lignes si le nombre actuel est inférieur au nombre requis
                        for ($i = $currentCount + 1; $i <= $nbArcane; $i++) {
                            $interpretations[$request->slug][(string)$i] = '';
                        }
                    } elseif ($currentCount > $nbArcane) {
                        // Retirer des lignes si le nombre actuel est supérieur au nombre requis
                        for ($i = $nbArcane + 1; $i <= $currentCount; $i++) {
                            unset($interpretations[$request->slug][(string)$i]);
                        }
                    }
    
                    // Assurer que l'ordre des clés est maintenu
                    ksort($interpretations[$request->slug]);
    
                    // Encoder le tableau en JSON
                    $card->interpretationsForDrawingCard = json_encode($interpretations);
                    // Enregistrer les modifications
                    $card->save();
                } else {
                    // Gérer le cas où le décodage JSON échoue
                    dd('Erreur de décodage JSON pour la carte: ' . $card->id);
                }
            }
    
            toast()
                ->success('Le tirage a été enregistré avec succès !')
                ->pushOnNextPage();
        }
    
        return redirect()->route('admin.draw.edit', $draw_id);
    }

    public function saveKeywords(Request $request) {
        // Valider les données de la requête
        $validated = $request->validate([
            'drawId' => 'required|integer|exists:draw_cards,id',
            'icone' => 'required|string',
            'keywords' => 'required|string',
            'position' => 'required|integer',
        ]);
    
        // Récupérer les données de la requête
        $drawId = $validated['drawId'];
        $icone = $validated['icone'];
        $keywords = $validated['keywords'];
        $position = $validated['position'];
    
        // Récupérer le tirage
        $draw = DrawCard::where('id', $drawId)->firstOrFail();
    
        // Décoder la colonne JSON
        $positionsKeywords = json_decode($draw->positionsKeywords, true);
    
        // Mettre à jour la position correspondante
        $updated = false;
        foreach ($positionsKeywords as &$item) {
            if ($item['position'] == $position) {
                $item['icone'] = $icone;
                $item['keywords'] = $keywords;
                $updated = true;
                break;
            }
        }
    
        // Vérifier si la mise à jour a été effectuée
        if (!$updated) {
            return response()->json(['error' => 'Position not found'], 404);
        }
    
        // Encoder à nouveau l'objet JSON et sauvegarder dans la base de données
        $draw->positionsKeywords = json_encode($positionsKeywords);
        $draw->save();
    
        // Retourner une réponse JSON
        return response()->json(['success' => 'Position updated successfully', 'positionsKeywords' => $positionsKeywords]);
    }

    public function destroy(Request $request) {
        // Draw
        $draw_id = $request->id;
        $draw = DrawCard::where('id', $draw_id)->firstOrFail();

        //dd($draw);

        $draw->delete();

        toast()
            ->success('Le tirage vient d\'être supprimé avec succés.')
            ->pushOnNextPage();

        $redirectRoute = route('admin.draw.index');
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }

}
