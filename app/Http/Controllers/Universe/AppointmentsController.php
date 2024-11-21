<?php

namespace App\Http\Controllers\Universe;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Concern\Invoice as InvoiceController;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppointmentsController extends Controller
{
    public $IC;

    public function index(): View {
        return view('universe.appointments.index');
    }

    public function show(Request $request): View {
        $appointment = Appointment::where('id', $request->id)->firstOrFail();
        $appointment_informations = json_decode($appointment->invoice()->firstOrFail()->invoice_informations);
        $user = User::where('id', $appointment->user_id)->firstOrFail();

        $this->IC = new InvoiceController($appointment->user_id);

        return view('universe.appointments.show', [
            'ic' => $this->IC,
            'user' => $user,
            'appointment' => $appointment,
            'appointment_informations' => $appointment_informations,
        ]);
    }
}
