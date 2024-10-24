<?php

namespace App\Http\Controllers\Galaxy;

use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    public function index() {
        return view("galaxy.appointments.index");
    }
}
