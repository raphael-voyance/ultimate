<?php

namespace App\Http\Controllers\Galaxy;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Concern\Numerology;
use App\Concern\Tarot;
use Carbon\Carbon;

class PrevisionsController extends Controller
{
    public function index(Request $request): View {
        $user = $request->user();
        if($user) {
            $user->load('profile');
        }

        return view('galaxy.previsions', [
            'user' => $user
        ]);
    }

    public function getPrevisions() {
        
        $user = Auth::user();

        if(!$user->profile->numerology) {
            return false;
        }

        $numerology = json_decode($user->profile->numerology);
        $tarologyArray = json_decode($user->profile->tarology);

        unset($tarologyArray->arcaneSumPath->interpretationsForTirages);
        unset($tarologyArray->arcaneLifePath->interpretationsForTirages);
        unset($tarologyArray->arcaneAnnualPath->interpretationsForTirages);

        //dd($tarologyArray);
            
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
