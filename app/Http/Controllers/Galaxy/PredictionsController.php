<?php

namespace App\Http\Controllers\Galaxy;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PredictionsController extends Controller
{
    public function index(Request $request): View {
        $user = $request->user();
        if($user) {
            $user->load('profile');
        }

        return view('galaxy.predictions', [
            'user' => $user
        ]);
    }
}
