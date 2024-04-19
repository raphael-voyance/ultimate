<?php

namespace App\Http\Controllers\Galaxy\Invoice;

use App\Models\Invoice;
use App\Models\TimeSlot;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Concern\Invoice as InvoiceController;

class PaymentController extends Controller
{

    public $IC;
    public $checkRequest = [
        'hasErrors' => true
    ];

    public function create(Request $request) {
        $userId = Auth::user()->id;
        //dd($userId);
        $this->IC = new InvoiceController($userId);

        // Invoice
        $invoice_token = $request->payment_invoice_token;
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->firstOrFail();
        $invoice_informations = json_decode($invoice->invoice_informations);
        $servicesProducts = $invoice->products->where('type', 'SERVICE_PRODUCT');
        $physicalsProducts = $invoice->products->where('type', 'PHYSICAL_PRODUCT');
        $hasPhysicalsProducts = $invoice->products->contains('type', 'PHYSICAL_PRODUCT');

        $user = Auth::user();
        $userContact = json_decode($user->profile->contact);

        //$this->addContactInformationToUser($user);

        //Check if user can access to invoice
        if ($request->user()->cannot('view', $invoice)) {
            abort(403);
        }

        //Check if route is payment
        if($request->routeIs('payment.*')) {

            $this->checkRequestIfIsComplete($userContact);

            if($invoice->status != 'PENDING') {
                return redirect()->route('invoice.view', ['payment_invoice_token' => $invoice_token]);
            }

            if($request->has('session_id')) {
                $checkoutSession = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));

                if($checkoutSession->status == 'complete') {
                    $invoice->status = 'PAID';
 
                    $invoice->save();

                    toast()
                        ->success('Votre paiement a été un succés. Merci, à très bientôt.')
                        ->pushOnNextPage();

                    return redirect()->route('invoice.view', ['payment_invoice_token' => $invoice_token]);
                };
            }
        }

        //Check if route is invoice
        if($request->routeIs('invoice.*')) {
            if($invoice->status == 'PENDING') {
                return redirect()->route('payment.create', ['payment_invoice_token' => $invoice_token]);
            }
        }
            
        return view('galaxy.invoice.payment', [
            'invoice' => $invoice,
            'invoice_informations' => $invoice_informations,
            'servicesProducts' => $servicesProducts,
            'physicalsProducts' => $physicalsProducts,
            'hasPhysicalsProducts' => $hasPhysicalsProducts,
            'user' => $user,
            'userContact' => $userContact,
            'ic' => $this->IC,
            'checkRequest' => json_encode($this->checkRequest)
        ]);

    }

    public function store(Request $request) {
        // dd('paymentCtrl@store');
        $invoice_token = $request->payment_invoice_token;
        
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->firstOrFail();

        $stripePriceId = $invoice->products->first()->stripe_price_id;

        $quantity = 1;

        return $request->user()->checkout([$stripePriceId => $quantity], [
            'success_url' => route('payment.create', ['payment_invoice_token' => $invoice->payment_invoice_token]).'?session_id={CHECKOUT_SESSION_ID}',

            'cancel_url' => route('payment.create', ['payment_invoice_token' => $invoice->payment_invoice_token]),
        ]);

        //dd($stripePriceId);
    }

    public function delete(Request $request) {
        // Invoice
        $invoice_token = $request->payment_invoice_token;
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->firstOrFail();

        $appointment = Appointment::where('invoice_id', $invoice->id)->firstOrFail();

        //dd($appointment);

        if($appointment->appointment_type != 'writing' && $appointment) {
            $timeSlot = TimeSlot::where('id', $appointment->time_slot_id)->firstOrFail();

            $timeSlot->time_slot_days()->updateExistingPivot($appointment->time_slot_day_id, ['available' => true]);
        }

        $appointment->delete();
        $invoice->products()->detach();
        $invoice->delete();

        toast()
            ->success('Votre demande de consultation a été annulée avec succés.')
            ->pushOnNextPage();

        $redirectRoute = route('my_space.index');
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }

    private function checkRequestIfIsComplete($userContact) {
        //dd($userContact->phone);
        if(isset($userContact->phone)) {
            $this->checkRequest['hasErrors'] = false;
        }else {
            $this->checkRequest['hasErrors'] = true;
            $this->checkRequest['errors']['phone'] = 'Merci de renseigner votre numéro de téléphone.';
        }

        if(isset($userContact->address->facturation)) {
            $this->checkRequest['hasErrors'] = false;
        }else {
            $this->checkRequest['hasErrors'] = true;
            $this->checkRequest['errors']['facturation_address'] = 'Merci de renseigner votre adresse de facturation.';
        }
    }

    private function addContactInformationToUser($user) {
        if($user->profile->contact == null) {
            $datas = [
                'phone' => "0616577576",
                'address' => [
                    'facturation' => [
                        'number_of_way' => '1bis',
                        'type_of_way' => 'rue',
                        'name_of_way' => 'Benjamin Franklin',
                        'postal_code' => '66000',
                        'city' => 'Perpignan',
                        'country' => 'France',
                    ],
                    'delivery' => [
                        'number_of_way' => '1bis',
                        'type_of_way' => 'rue',
                        'name_of_way' => 'Benjamin Franklin',
                        'postal_code' => '66000',
                        'city' => 'Perpignan',
                        'country' => 'France',
                    ]
                ]
            ];

            return $user->profile->update([
                'contact' => json_encode($datas)
            ]);
        }

        return;
        
    }
}
