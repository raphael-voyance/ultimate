<?php

namespace App\Http\Controllers\Galaxy;

use Exception;
use Carbon\Carbon;
use App\Concern\Tarot;
use App\Models\DrawCard;
use Illuminate\View\View;
use App\Concern\Numerology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Numerology as ModelsNumerology;
use App\Models\TarotCard as ModelsTarology;
use App\Models\UserDraw;

class PrevisionsController extends Controller
{
    public function index(Request $request): View {
        $user = $request->user();
        $drawCards = DrawCard::where('active', true)->get();
        //dd($drawCards);
        if($user) {
            $user->load('profile');
        }

        return view('galaxy.previsions', [
            'user' => $user,
            'drawCards' => $drawCards
        ]);
    }

    public function tarotPage(Request $request): View {
        $user = $request->user();
        if($user) {
            $user->load('profile');
        }

        return view('tarot', [
            'user' => $user
        ]);
    }

    public function getDrawCards(Request $request, $id) {
        // dd($id);
        $user = $request->user();
        // dd($user);
        if(!$user) {
            return abort(401);
        }
        $draw = UserDraw::where('user_id', $user->id)->where('id', $id)->firstOrFail();

        $i_creator = new Tarot();
        //dd(json_decode($draw->draw, true));
        // $draw = $i_creator->loadInterpretations(json_decode($draw->draw, true), 'tirage-de-la-journee');
        
        $draw->makeHidden(['user_id']);

        // dd($draw);

        return view('tarot', [
            'user' => $user,
            'draw' => json_encode($draw)
        ]);
    }

    public function drawCardsIndex(Request $request) {
        $user = $request->user();
        if(!$user) {
            return abort(401);
        }
        $draws = $user->draws()->get();
        return view('galaxy.tarot.index', [
            'draws' => $draws
        ]);
    }

    public function getDrawInterpretation(Request $request) {
        $i_creator = new Tarot();
        return $i_creator->loadInterpretations($request->drawCards, $request->drawSlug);
    }

    public function saveDraw(Request $request) {
        $user = $request->user();

        if(!$user) {
            return response()->json(['error' => 'Vous devez être connecté pour effectuer cette action.'], 401);
        }

        // dd($user->id);
        // dd(json_encode($request->notes));
        // dd($request->draw);
        if($request->draw == []) {
            return response()->json(['error' => 'Vous devez effectuer un tirage pour l\'enregistrer.'], 400);
        }

        $draw = UserDraw::create([
            'user_id' => $user->id,
            'draw' => json_encode($request->draw),
            'notes' => $request->notes
        ]);
        return response()->json($draw);
    }

    public function getPrevisions() {
        
        $user = Auth::user();

        if(!$user->profile->numerology) {
            return false;
        }

        $numerology = json_decode($user->profile->numerology, true);
        $modelNumerology = new ModelsNumerology();
        $modelTarology = new ModelsTarology();

        try {
            if (!isset($numerology['lifePath'])) {
                throw new Exception('lifePath is not set in $numerology.');
            }
            $interpretationLifePath = $modelNumerology->where('number', $numerology['lifePath'])->firstOrFail();
            if (!isset($interpretationLifePath->interpretations)) {
                throw new Exception('interpretations property is not set in the database result.');
            }
            $interpretationLifePath = json_decode($interpretationLifePath->interpretations, true);
            if (!isset($interpretationLifePath['lifePath'])) {
                throw new Exception('lifePath key is not set in the decoded JSON.');
            }
            $numerology['interpretationLifePath'] = $interpretationLifePath['lifePath'];
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        try {
            if (!isset($numerology['annualPath'])) {
                throw new Exception('annual is not set in $numerology.');
            }
            $interpretationAnnualPath = $modelNumerology->where('number', $numerology['annualPath'])->firstOrFail();
            if (!isset($interpretationAnnualPath->interpretations)) {
                throw new Exception('interpretations property is not set in the database result.');
            }
            $interpretationAnnualPath = json_decode($interpretationAnnualPath->interpretations, true);
            if (!isset($interpretationAnnualPath['annualPath'])) {
                throw new Exception('annualPath key is not set in the decoded JSON.');
            }
            $numerology['interpretationAnnualPath'] = $interpretationAnnualPath['annualPath'];
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        try {
            if (!isset($numerology['sumPath'])) {
                throw new Exception('sumPath is not set in $numerology.');
            }
            $interpretationSumPath = $modelNumerology->where('number', $numerology['sumPath'])->firstOrFail();
            if (!isset($interpretationSumPath->interpretations)) {
                throw new Exception('interpretations property is not set in the database result.');
            }
            $interpretationSumPath = json_decode($interpretationSumPath->interpretations, true);
            if (!isset($interpretationSumPath['sumPath'])) {
                throw new Exception('sumPath key is not set in the decoded JSON.');
            }
            $numerology['interpretationSumPath'] = $interpretationSumPath['sumPath'];
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        $tarology = json_decode($user->profile->tarology, true);

        try {
            if (!isset($tarology['arcaneLifePath'])) {
                throw new Exception('arcaneLifePath is not set in $tarology.');
            }
            $interpretationArcaneLifePath = $modelTarology->where('numberArcane', $tarology['arcaneLifePath'])->firstOrFail();

            $tarology['imgArcaneLifePath'] = $interpretationArcaneLifePath->imgPath;
            $tarology['nameArcaneLifePath'] = $interpretationArcaneLifePath->name;

            if (!isset($interpretationArcaneLifePath->arcanePath)) {
                throw new Exception('interpretations property is not set in the database result.');
            }
            $interpretationArcaneLifePath = json_decode($interpretationArcaneLifePath->arcanePath, true);
            
            if (!isset($interpretationArcaneLifePath['lifePath'])) {
                throw new Exception('lifePath key is not set in the decoded JSON.');
            }
            $tarology['interpretationArcaneLifePath'] = $interpretationArcaneLifePath['lifePath'];
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        try {
            if (!isset($tarology['arcaneAnnualPath'])) {
                throw new Exception('arcaneAnnualPath is not set in $tarology.');
            }
            $interpretationArcaneAnnualPath = $modelTarology->where('numberArcane', $tarology['arcaneAnnualPath'])->firstOrFail();

            $tarology['imgArcaneAnnualPath'] = $interpretationArcaneAnnualPath->imgPath;
            $tarology['nameArcaneAnnualPath'] = $interpretationArcaneAnnualPath->name;

            if (!isset($interpretationArcaneAnnualPath->arcanePath)) {
                throw new Exception('interpretations property is not set in the database result.');
            }
            $interpretationArcaneAnnualPath = json_decode($interpretationArcaneAnnualPath->arcanePath, true);
            
            if (!isset($interpretationArcaneAnnualPath['annualPath'])) {
                throw new Exception('annualPath key is not set in the decoded JSON.');
            }
            $tarology['interpretationArcaneAnnualPath'] = $interpretationArcaneAnnualPath['annualPath'];
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        try {
            if (!isset($tarology['arcaneSumPath'])) {
                throw new Exception('arcaneSumPath is not set in $tarology.');
            }
            $interpretationArcaneSumPath = $modelTarology->where('numberArcane', $tarology['arcaneSumPath'])->firstOrFail();

            $tarology['imgArcaneSumPath'] = $interpretationArcaneSumPath->imgPath;
            $tarology['nameArcaneSumPath'] = $interpretationArcaneSumPath->name;

            if (!isset($interpretationArcaneSumPath->arcanePath)) {
                throw new Exception('interpretations property is not set in the database result.');
            }
            $interpretationArcaneSumPath = json_decode($interpretationArcaneSumPath->arcanePath, true);
            
            if (!isset($interpretationArcaneSumPath['sumPath'])) {
                throw new Exception('sumPath key is not set in the decoded JSON.');
            }
            $tarology['interpretationArcaneSumPath'] = $interpretationArcaneSumPath['sumPath'];
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        
        return response()->json([
            'numerology' => $numerology,
            'tarology' => $tarology
        ]);
        
    }

    public function postBirthdate(Request $request) {
        $birthdate = Carbon::createFromFormat('d/m/Y', $request->birthdate)->format('Y-m-d');

        $numerology_creator = new Numerology();
        $numerology = $numerology_creator->calculatePath($birthdate);

        $tarot_creator = new Tarot();
        $tarology = $tarot_creator->calculatePath($birthdate);

        $user = $request->user();
        
        $user->profile()->update([
            'tarology' => $tarology,
            'numerology' => $numerology,
            'birthday' => $birthdate
        ]);

        toast()
                ->success('Votre date de naissance a été modifié avec succés.')
                ->pushOnNextPage();

        return response()->json(['numerology' => $numerology]);
    }
    
}
