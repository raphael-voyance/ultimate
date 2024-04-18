<?php

namespace App\Http\Controllers\Galaxy\Invoice;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Concern\Invoice as InvoiceController;
use Usernotnull\Toast\Concerns\WireToast;

class PaymentController extends Controller
{
    use WireToast;

    public $IC;
    public $checkRequest = [
        'hasErrors' => true
    ];

    public function __construct()
    {
        
    }

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
                        ->success('Votre paiement a été un succés, Merci, à très bientôt.')
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

        //dd($invoice_informations);
        // User
        

        // $datas = [
        //     'phone' => "0616577576",
        //     'address' => [
        //         'facturation' => [
        //             'number_of_way' => '1bis',
        //             'type_of_way' => 'rue',
        //             'name_of_way' => 'Benjamin Franklin',
        //             'postal_code' => '66000',
        //             'city' => 'Perpignan',
        //             'country' => 'France',
        //         ],
        //         'delivery' => [
        //             'number_of_way' => '1bis',
        //             'type_of_way' => 'rue',
        //             'name_of_way' => 'Benjamin Franklin',
        //             'postal_code' => '66000',
        //             'city' => 'Perpignan',
        //             'country' => 'France',
        //         ]
        //     ]
        // ];

        // $user->profile->update([
        //     'contact' => json_encode($datas)
        // ]);
        
        

        //dd($userContact->address->facturation->number_of_way);
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

    private function checkRequestIfIsComplete($userContact) {
        //dd($userContact->phone);
        if(isset($userContact->phone)) {
            $this->checkRequest['hasErrors'] = false;
        }else {
            $this->checkRequest['hasErrors'] = true;
            $this->checkRequest['errors']['phone'] = 'Merci de renseigner votre numéro de téléphone.';
        }

        if(isset($userContact->adress->facturation)) {
            $this->checkRequest['hasErrors'] = false;
        }else {
            $this->checkRequest['hasErrors'] = true;
            $this->checkRequest['errors']['facturation_adress'] = 'Merci de renseigner votre adresse de facturation.';
        }
        
    }
}
