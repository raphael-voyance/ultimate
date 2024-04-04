<?php

namespace App\Http\Controllers\Galaxy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index() {
        return view("galaxy.appointments");
    }
}
