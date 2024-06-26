<?php

namespace App\Http\Controllers\Galaxy;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Concern\Numerology;
use App\Concern\Tarot;
use App\Models\DrawCard;
use Carbon\Carbon;

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

        return view('galaxy.tarot', [
            'user' => $user
        ]);
    }

    public function getDrawInterpretation(Request $request) {
        $i_creator = new Tarot();
        return $i_creator->loadInterpretations($request->drawCards, $request->drawSlug);
    }

    public function getPrevisions() {
        
        $user = Auth::user();

        if(!$user->profile->numerology) {
            return false;
        }

        $numerology = json_decode($user->profile->numerology);
        $tarologyArray = json_decode($user->profile->tarology);

        unset($tarologyArray->arcaneSumPath->interpretationsForDrawingCard);
        unset($tarologyArray->arcaneLifePath->interpretationsForDrawingCard);
        unset($tarologyArray->arcaneAnnualPath->interpretationsForDrawingCard);
            
        return response()->json([
            'numerology' => $numerology,
            'tarology' => $tarologyArray
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

        return response()->json(['numerology' => $numerology]);
    }
    
}
