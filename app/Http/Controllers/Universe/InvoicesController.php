<?php

namespace App\Http\Controllers\Universe;

use App\Models\User;
use App\Models\Invoice;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Concern\Invoice as InvoiceController;
use App\Concern\StatusAppointmentNotifications as ConcernNotifications;

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

    public function delete(Request $request) {
        $invoice_token = $request->payment_invoice_token;
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->with('appointment')->firstOrFail();
        $appointment = $invoice->appointment;
        $user = User::where('id', $invoice->user_id)->firstOrFail();
    
        // Vérification et création du remboursement
        if ($invoice->payment_intent) {
            try {
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

                \Stripe\Refund::create([
                    'payment_intent' => $invoice->payment_intent,
                ]);
                ConcernNotifications::sendNotification($invoice, 'REFUNDED');
                // Ajout d'un message de confirmation pour le remboursement
                toast()->success('Le remboursement de la consultation a été effectué avec succès.')->pushOnNextPage();
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

        ConcernNotifications::sendNotificationFromAdmin($invoice, 'CANCELLED', $user);

        toast()->success('La demande de consultation a été annulée avec succés.')->pushOnNextPage();
    
        $redirectRoute = route('admin.index');
        return response()->json(['status' => 'success', 'redirectRoute' => $redirectRoute]);
    }

    public function refundInvoice($id) {
        $invoice = Invoice::where('id', $id)->firstOrFail();
        $user = User::where('id', $invoice->user_id)->firstOrFail();

        // Vérification et création du remboursement
        if ($invoice->payment_intent) {
            try {
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

                \Stripe\Refund::create([
                    'payment_intent' => $invoice->payment_intent,
                ]);
                ConcernNotifications::sendNotificationFromAdmin($invoice, 'REFUNDED', $user);
                // Ajout d'un message de confirmation pour le remboursement
                toast()->success('Le remboursement de la consultation a été effectué avec succès.')->pushOnNextPage();
                $invoice->status = 'REFUNDED';
                $invoice->save();
                
                return response()->json(['status' => 'success']);


            } catch (\Exception $e) {
                // Gestion d'erreur en cas de problème avec Stripe
                report($e);
                toast()->warning('Une erreur est survenue lors du remboursement. Veuillez réessayer plus tard.')->pushOnNextPage();
                return response()->json(['status' => 'error', 'message' => 'Refund failed.'], 500);
            }
        }
    }

    public function freeInvoice($id) {
        $invoice = Invoice::where('id', $id)->firstOrFail();
        $user = User::where('id', $invoice->user_id)->firstOrFail();
        $appointment = $invoice->appointment;

        // Mise à jour de l'état du rendez-vous
        $appointment->status = 'APPROVED';
        $appointment->save();

        $invoice->status = 'FREE';
        $invoice->save();

        ConcernNotifications::sendNotificationFromAdmin($invoice, 'FREE', $user);
        // Ajout d'un message de confirmation pour le remboursement
        toast()->success('Le status de la consultation a été modifié avec succès.')->pushOnNextPage();
        
        
        return response()->json(['status' => 'success']);

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
