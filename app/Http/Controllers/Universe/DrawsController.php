<?php

namespace App\Http\Controllers\Universe;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DrawCard;
use Illuminate\Support\Facades\Gate;

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
}
