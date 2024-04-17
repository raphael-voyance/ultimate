<?php

namespace App\Http\Controllers\Galaxy\Invoice;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Concern\Invoice as InvoiceController;

class PaymentController extends Controller
{

    public $IC;

    public function __construct()
    {
        $this->IC = new InvoiceController(1);
    }

    public function create(Request $request) {
        // Invoice
        $invoice_token = $request->payment_invoice_token;
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->firstOrFail();
        $invoice_informations = json_decode($invoice->invoice_informations);
        $servicesProducts = $invoice->products->where('type', 'SERVICE_PRODUCT');
        $physicalsProducts = $invoice->products->where('type', 'PHYSICAL_PRODUCT');
        $hasPhysicalsProducts = $invoice->products->contains('type', 'PHYSICAL_PRODUCT');

        if ($request->user()->cannot('view', $invoice)) {
            abort(403);
        }

        if($request->routeIs('payment.*')) {
            if($invoice->status != 'PENDING') {
                return redirect()->route('invoice.view', ['payment_invoice_token' => $invoice_token]);
            }
        }

        if($request->routeIs('invoice.*')) {
            if($invoice->status == 'PENDING') {
                return redirect()->route('payment.create', ['payment_invoice_token' => $invoice_token]);
            }
        }

        //dd($invoice_informations);
        // User
        $user = Auth::user();

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
        
        $userContact = json_decode($user->profile->contact);

        //dd($userContact->address->facturation->number_of_way);
            
        return view('galaxy.invoice.payment', [
            'invoice' => $invoice,
            'invoice_informations' => $invoice_informations,
            'servicesProducts' => $servicesProducts,
            'physicalsProducts' => $physicalsProducts,
            'hasPhysicalsProducts' => $hasPhysicalsProducts,
            'user' => $user,
            'userContact' => $userContact,
            'ic' => $this->IC
        ]);
    }

    public function store(Request $request) {
        $invoice_token = $request->payment_invoice_token;
        
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->firstOrFail();

        $stripePriceId = $invoice->products->first()->stripe_price_id;

        $quantity = 1;

        return $request->user()->checkout([$stripePriceId => $quantity], [
            'success_url' => route('invoice.view', ['payment_invoice_token' => $invoice->payment_invoice_token]),
            'cancel_url' => route('payment.create', ['payment_invoice_token' => $invoice->payment_invoice_token]),
        ]);

        //dd($stripePriceId);
    }
}
