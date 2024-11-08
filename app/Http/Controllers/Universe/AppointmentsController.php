<?php

namespace App\Http\Controllers\Universe;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AppointmentsController extends Controller
{
    public function index(): View {
        return view('universe.index');
    }
}
