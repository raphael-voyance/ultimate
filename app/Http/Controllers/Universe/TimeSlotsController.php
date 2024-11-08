<?php

namespace App\Http\Controllers\Universe;

use App\Models\TimeSlot;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class TimeSlotsController extends Controller
{
    public function index(): View {
        

        return view('universe.timeslots.index');
    }
}
