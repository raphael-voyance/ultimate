<?php

namespace App\Http\Controllers\Universe;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Concern\Invoice as InvoiceController;
use App\Models\User;

class InvoicesController extends Controller
{
    public $IC;

    public function show(Request $request) :View
    {
        

        $invoice = Invoice::where('id', $request->id)->with('appointment')->firstOrFail();
        // dd($invoice);
        $invoice_informations = json_decode($invoice->invoice_informations);

        $user = User::where('id', $invoice->user_id)->firstOrFail();
        $userContact = json_decode($user->profile->contact);
        $this->IC = new InvoiceController($user->id);

        $appointment = $invoice->appointment;
        $appointmentPassed = $appointment->status == 'PASSED' ? true : false;

        $servicesProducts = $invoice->products->where('type', 'SERVICE_PRODUCT');
        $physicalsProducts = $invoice->products->where('type', 'PHYSICAL_PRODUCT');
        $hasPhysicalsProducts = $invoice->products->contains('type', 'PHYSICAL_PRODUCT');

        return view('universe.invoices.show', [
            'ic' => $this->IC,
            'user' => $user,
            'userContact' => $userContact,
            'invoice' => $invoice,
            'invoice_informations' => $invoice_informations,
            'servicesProducts' => $servicesProducts,
            'physicalsProducts' => $physicalsProducts,
            'hasPhysicalsProducts' => $hasPhysicalsProducts,
            'appointmentPassed' => $appointmentPassed,
        ]);
    }
}
