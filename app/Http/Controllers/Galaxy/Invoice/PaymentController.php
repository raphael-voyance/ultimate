<?php

namespace App\Http\Controllers\Galaxy\Invoice;

use App\Models\User;
use App\Models\Invoice;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Concern\StatusAppointmentNotifications as ConcernNotifications;
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
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->with('appointment')->firstOrFail();
        $invoice_informations = json_decode($invoice->invoice_informations);
        $servicesProducts = $invoice->products->where('type', 'SERVICE_PRODUCT');
        $physicalsProducts = $invoice->products->where('type', 'PHYSICAL_PRODUCT');
        $hasPhysicalsProducts = $invoice->products->contains('type', 'PHYSICAL_PRODUCT');

        $user = Auth::user();
        $userContact = json_decode($user->profile->contact);

        $appointment = $invoice->appointment;
        $appointmentPassed = $appointment->status == 'PASSED' ? true : false;
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

                // dd($checkoutSession);

                if($checkoutSession->status == 'complete') {
                    $invoice->status = 'PAID';
                    $invoice->payment_intent = $checkoutSession->payment_intent;
                    $invoice->save();

                    $appointment->status = 'APPROVED';
                    $appointment->save();

                    ConcernNotifications::sendNotification($invoice, 'PAID');

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
            'appointmentPassed' => $appointmentPassed,
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

        if($invoice->payment_intent) {
            toast()
                ->info('Vous avez déjà payé cette facture.')
                ->pushOnNextPage();
            return back();
        }

        $stripePriceId = $invoice->products->first()->stripe_price_id;

        $quantity = 1;

        // dd($quantity);

        return $request->user()->checkout([$stripePriceId => $quantity], [
            'success_url' => route('payment.create', ['payment_invoice_token' => $invoice->payment_invoice_token]).'?session_id={CHECKOUT_SESSION_ID}',

            'cancel_url' => route('payment.create', ['payment_invoice_token' => $invoice->payment_invoice_token]),
        ]);

        //dd($stripePriceId);
    }

    // public function delete(Request $request) {
    //     // Invoice
    //     $invoice_token = $request->payment_invoice_token;
    //     $invoice = Invoice::where('payment_invoice_token', $invoice_token)->with('appointment')->firstOrFail();

    //     $appointment = $invoice->appointment;

    //     if ($invoice->payment_id) {
    //         \Stripe\Refund::create([
    //             'payment_intent' => $invoice->payment_id,
    //         ]);
    //         dd($invoice->payment_id);
    //     }

    //     if($appointment->appointment_type != 'writing' && $appointment) {
    //         $timeSlot = TimeSlot::where('id', $appointment->time_slot_id)->firstOrFail();

    //         $timeSlot->time_slot_days()->updateExistingPivot($appointment->time_slot_day_id, ['available' => true]);
    //     }

    //     $appointment->invoice_id = null;
    //     $appointment->status = 'CANCELLED';
    //     $appointment->time_slot_day_id = null;
    //     $appointment->time_slot_id = null;
    //     $appointment->save();
    //     // $invoice->products()->detach();

    //     $invoice->status = 'CANCELLED';
    //     $invoice->save();

    //     toast()
    //         ->success('Votre demande de consultation a été annulée avec succés.')
    //         ->pushOnNextPage();

    //     $redirectRoute = route('my_space.index');
    //     return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    // }

    public function delete(Request $request) {
        $invoice_token = $request->payment_invoice_token;
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->with('appointment')->firstOrFail();
        $appointment = $invoice->appointment;
    
        // Vérification et création du remboursement
        if ($invoice->payment_intent) {
            try {
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

                \Stripe\Refund::create([
                    'payment_intent' => $invoice->payment_intent,
                ]);
                ConcernNotifications::sendNotification($invoice, 'REFUNDED');
                // Ajout d'un message de confirmation pour le remboursement
                toast()->success('Le remboursement de votre consultation a été effectué avec succès.')->pushOnNextPage();
            } catch (\Exception $e) {
                // Gestion d'erreur en cas de problème avec Stripe
                report($e);
                toast()->warning('Une erreur est survenue lors du remboursement. Veuillez réessayer plus tard.')->pushOnNextPage();
                return response()->json(['status' => 'error', 'message' => 'Refund failed.'], 500);
            }
        }
    
        // Mise à jour des créneaux de rendez-vous si ce n'est pas un rendez-vous "writing"
        if ($appointment && $appointment->appointment_type != 'writing') {
            $timeSlot = TimeSlot::where('id', $appointment->time_slot_id)->first();
            if ($timeSlot) {
                $timeSlot->time_slot_days()->updateExistingPivot($appointment->time_slot_day_id, ['available' => true]);
            }
        }
    
        // Mise à jour de l'état du rendez-vous
        $appointment->invoice_id = null;
        $appointment->status = 'CANCELLED';
        $appointment->time_slot_day_id = null;
        $appointment->time_slot_id = null;
        $appointment->save();
    
        // Mise à jour de l'état de la facture
        if ($invoice->payment_intent) {
            $invoice->status = 'REFUNDED';
        } else {
            $invoice->status = 'CANCELLED';
        }
        $invoice->save();

        ConcernNotifications::sendNotification($invoice, 'CANCELLED');

        toast()->success('Votre demande de consultation a été annulée avec succés.')->pushOnNextPage();
    
        $redirectRoute = route('my_space.index');
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }

    public function download(Request $request) {
        $invoice_ref = $request->invoice_ref;
        $invoice = Invoice::where('ref', $invoice_ref)->with('products')->firstOrFail();
        $user = User::where('id', $invoice->user_id)->with('profile')->firstOrFail();
        $userId = $user->id;
        $this->IC = new InvoiceController($userId);

        if ($request->user()->cannot('view', $invoice)) {
            abort(403);
        }

        // dd(json_decode($user->profile->contact));

        $userName = $user->first_name . ' ' . $user->last_name;

        $userEmail = $user->email;

        $userAdress = json_decode($user->profile->contact);
        $userAdress = '<p>' . 
        $userAdress->address->facturation->number_of_way . ', ' . $userAdress->address->facturation->type_of_way . ' ' . $userAdress->address->facturation->name_of_way . '</p>' . 
        
        '<p>' .
        $userAdress->address->facturation->postal_code . ' ' . $userAdress->address->facturation->city . ', ' . $userAdress->address->facturation->country . '</p>';

        $products = $invoice->products;
        $subTotalPrice = 0;
        foreach($products as $product) {
            $subTotalPrice = $subTotalPrice + $product->price;
        }
        $additionalFees = 0;

        $totalPrice = $this->IC->setAmountPriceForHuman($subTotalPrice + $additionalFees); 

        $subTotalPrice = $this->IC->setAmountPriceForHuman($subTotalPrice);

        $data = [
            'invoice' => $invoice,
            'userName' => $userName,
            'userAdress' => $userAdress,
            'userEmail' => $userEmail,
            'products' => $products,
            'subTotalPrice' => $subTotalPrice,
            'additionalFees' => $additionalFees,
            'totalPrice' => $totalPrice,
            'IC' => $this->IC,
        ];
        
        try {
            $pdf = Pdf::loadView('galaxy.invoice.download', $data);
            //dd($pdf->stream($invoice->invoice_ref . '.pdf'));
            return $pdf->download($invoice->ref . '.pdf');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

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
