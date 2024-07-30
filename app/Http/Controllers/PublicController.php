<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home(): View {
        $messages = collect([
            "Messages 1",
            "Messages 2",
            "Messages 3",
            "Messages 4",
            "Messages 5",
            "Messages 6",
        ]);
        return view('home')->with(['messages'=> $messages]);
    }
    public function contact(): View {
        return view('contact');
    }
    public function store_contact(): View {
        return view('contact');
    }
    public function consultations(): View {
        return view('consultations');
    }
    public function testimonies(): View {
        return view('testimonies');
    }

}
