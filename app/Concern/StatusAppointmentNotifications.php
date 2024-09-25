<?php

namespace App\Concern;

use App\Concern\UserAdmin;
use Illuminate\Support\Facades\Auth;
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
                case 'confirmed':
                    $message = 'Votre demande de consultation par email a été envoyé avec succès.';
                    break;
                case 'canceled':
                    $message = 'Votre demande de consultation par email a été annulé avec succès.';
                    break;
                case 'updated':
                    $message = 'Votre demande de consultation par email a été modifié avec succès.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        } else if($invoiceInformations['type'] == "phone") {
            switch ($status) {
                case 'confirmed':
                    $message = 'Votre demande de rendez-vous par téléphone a été enregistré avec succès.';
                    break;
                case 'canceled':
                    $message = 'Votre demande de rendez-vous par téléphone a été annulé avec succès.';
                    break;
                case 'updated':
                    $message = 'Votre demande de rendez-vous par téléphone a été modifié avec succès.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        } else if($invoiceInformations['type'] == "tchat") {
            switch ($status) {
                case 'confirmed':
                    $message = 'Votre demande de rendez-vous par tchat a été enregistré avec succès.';
                    break;
                case 'canceled':
                    $message = 'Votre demande de rendez-vous par tchat a été annulé avec succès.';
                    break;
                case 'updated':
                    $message = 'Votre demande de rendez-vous par tchat a été modifié avec succès.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        }
        // $message, $details, $status
        return $user->notify(new AppointmentNotification($message, $invoiceInformations, $status));

    }

}