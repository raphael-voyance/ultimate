<?php

namespace App\Concern;

use App\Models\Invoice;
use App\Concern\UserAdmin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Notifications\AppointmentNotification;

class StatusAppointmentNotifications
{

    public static function sendNotification($invoice, $status)
    {
        $user = Auth::user();
        $UserAdmin = new UserAdmin();
        $admin = $UserAdmin->getUserAdmin();

        $invoiceInformations = json_decode($invoice->invoice_informations, true);
        $message = '';

        if($invoiceInformations['type'] == "writing") {
            switch ($status) {
                case 'CONFIRMED':
                    $message = 'Votre demande de consultation par email a été envoyé avec succès.';
                    break;
                case 'CANCELLED':
                    $message = 'Votre demande de consultation par email a été annulé avec succès.';
                    break;
                case 'UPDATED':
                    $message = 'Votre demande de consultation par email a été modifié avec succès.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        } else if($invoiceInformations['type'] == "phone") {
            switch ($status) {
                case 'CONFIRMED':
                    $message = 'Votre demande de rendez-vous par téléphone a été enregistré avec succès.';
                    break;
                case 'CANCELLED':
                    $message = 'Votre demande de rendez-vous par téléphone a été annulé avec succès.';
                    break;
                case 'UPDATED':	
                    $message = 'Votre demande de rendez-vous par téléphone a été modifié avec succès.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        } else if($invoiceInformations['type'] == "tchat") {
            switch ($status) {
                case 'CONFIRMED':
                    $message = 'Votre demande de rendez-vous par tchat a été enregistré avec succès.';
                    break;
                case 'CANCELLED':
                    $message = 'Votre demande de rendez-vous par tchat a été annulé avec succès.';
                    break;
                case 'UPDATED':
                    $message = 'Votre demande de rendez-vous par tchat a été modifié avec succès.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        }
        // $message, $details, $status, $invoice_token
        return $user->notify(new AppointmentNotification($message, $invoiceInformations, $status, $invoice->payment_invoice_token));

    }

    public function redirectToAppointment($invoice_token) {
        $invoice = Invoice::where('payment_invoice_token', $invoice_token)->firstOrFail();
        switch($invoice->status) {
            case 'PENDING':
            case 'CANCELLED':
            case 'REFUNDED':
                return redirect()->route('invoice.view', ['payment_invoice_token' => $invoice_token]);
                break;
            case 'CONFIRMED':
            case 'FREE':
                $userLastName = Auth::user()->last_name;
                $userFirstName = Auth::user()->first_name;
                $userName = Str::slug($userFirstName . '-' . $userLastName);
                $appointmentId = $invoice->appointment_id;
                return redirect()->route('my_space.appointment.show', ['appointment_id' => $appointmentId, 'user_name' => $userName]);
                break;
            default:
                return redirect()->route('invoice.view', ['payment_invoice_token' => $invoice_token]);
                break;
        }
    }
}