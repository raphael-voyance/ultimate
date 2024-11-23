<?php

namespace App\Concern;

use App\Models\Invoice;
use App\Concern\UserAdmin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Notifications\AppointmentNotification;
use App\Notifications\AppointmentNotificationAdmin;
use App\Notifications\AppointmentNotificationToAdmin;

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
                    $message = 'Votre demande de consultation par email a été envoyée avec succès.';
                    break;
                case 'CANCELLED':
                    $message = 'Votre demande de consultation par email a été annulée avec succès.';
                    break;
                case 'PASSED':
                    $message = 'Votre consultation est passée.';
                    break;
                case 'UPDATED':
                    $message = 'Votre demande de consultation par email a été modifiée avec succès.';
                    break;
                case 'PAID':
                    $message = 'Le paiement de votre consultation par email s\'est déroulé avec succès.';
                    break;
                case 'REFUNDED':
                    $message = 'Le remboursement de votre consultation par email a été envoyé avec succès.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        } else if($invoiceInformations['type'] == "phone") {
            switch ($status) {
                case 'CONFIRMED':
                    $message = 'Votre demande de rendez-vous par téléphone a été enregistrée avec succès.';
                    break;
                case 'CANCELLED':
                    $message = 'Votre demande de rendez-vous par téléphone a été annulée avec succès.';
                    break;
                case 'PASSED':
                    $message = 'Votre consultation est passée.';
                    break;
                case 'UPDATED':	
                    $message = 'Votre demande de rendez-vous par téléphone a été modifiée avec succès.';
                    break;
                case 'PAID':
                    $message = 'Le paiement de votre consultation par téléphone s\'est déroulé avec succès.';
                    break;
                case 'REFUNDED':
                    $message = 'Le remboursement de votre consultation par téléphone a été envoyé avec succès.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        } else if($invoiceInformations['type'] == "tchat") {
            switch ($status) {
                case 'CONFIRMED':
                    $message = 'Votre demande de rendez-vous par tchat a été enregistrée avec succès.';
                    break;
                case 'CANCELLED':
                    $message = 'Votre demande de rendez-vous par tchat a été annulée avec succès.';
                    break;
                case 'PASSED':
                    $message = 'Votre consultation est passée.';
                    break;
                case 'UPDATED':
                    $message = 'Votre demande de rendez-vous par tchat a été modifiée avec succès.';
                    break;
                case 'PAID':
                    $message = 'Le paiement de votre consultation par tchat s\'est déroulé avec succès.';
                    break;
                case 'REFUNDED':
                    $message = 'Le remboursement de votre consultation par tchat a été envoyé avec succès.';
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
            case 'APPROVED':
            case 'PASSED':
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

    public static function sendNotificationFromAdmin($invoice, $status, $user, $reply = null)
    {
        $UserAdmin = new UserAdmin();
        $admin = $UserAdmin->getUserAdmin();

        $invoiceInformations = json_decode($invoice->invoice_informations, true);
        $message = '';

        if($invoiceInformations['type'] == "writing") {
            switch ($status) {
                case 'CANCELLED':
                    $message = 'Votre demande de consultation par email a été annulée par Raphaël.';
                    break;
                case 'UPDATED':
                    $message = 'Votre demande de consultation par email a été modifiée par Raphaël.';
                    break;
                case 'PAID':
                    $message = 'Le paiement de votre consultation par téléphone a bien été enregistré.';
                    break;
                case 'REFUNDED':
                    $message = 'Raphaël a initié le remboursement de votre consultation par écrit, il apparaîtra sous quelques jours sur votre moyen de paiement.';
                    break;
                case 'FREE':
                    $message = 'Raphaël a modifié votre consultation par écrit en statut "gratuit".';
                    break;
                case 'REPLY':
                    $message = 'La réponse à votre question vous a été envoyée, elle est dès à présent disponible dans votre espace personnel.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        } else if($invoiceInformations['type'] == "phone") {
            switch ($status) {
                case 'APPROVED':
                    $message = 'Votre demande de rendez-vous par téléphone a été approuvée par Raphaël.';
                    break;
                case 'CANCELLED':
                    $message = 'Votre demande de rendez-vous par téléphone a été annulée par Raphaël.';
                    break;
                case 'UPDATED':	
                    $message = 'Votre demande de rendez-vous par téléphone a été modifiée par Raphaël.';
                    break;
                case 'PAID':
                    $message = 'Le paiement de votre consultation par téléphone a bien été enregistré.';
                    break;
                case 'REFUNDED':
                    $message = 'Raphaël a initié le remboursement de votre consultation par téléphone, il apparaîtra sous quelques jours sur votre moyen de paiement.';
                    break;
                case 'FREE':
                    $message = 'Raphaël a modifié votre consultation par téléphone en statut "gratuit".';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        } else if($invoiceInformations['type'] == "tchat") {
            switch ($status) {
                case 'APPROVED':
                    $message = 'Votre demande de rendez-vous par tchat a été approuvée par Raphaël.';
                    break;
                case 'CANCELLED':
                    $message = 'Votre demande de rendez-vous par tchat a été annulée par Raphaël.';
                    break;
                case 'UPDATED':
                    $message = 'Votre demande de rendez-vous par tchat a été modifiée par Raphaël.';
                    break;
                case 'PAID':
                    $message = 'Le paiement de votre consultation par tchat a bien été enregistré.';
                    break;
                case 'FREE':
                    $message = 'Raphaël a modifié votre consultation par tchat en statut "gratuit".';
                    break;
                case 'REFUNDED':
                    $message = 'Raphaël a initié le remboursement de votre consultation par tchat, il apparaîtra sous quelques jours sur votre moyen de paiement.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        }
        $userFullName = $user->fullName();
        $appointmentId = $invoice->appointment->id;
        // $message, $details, $status, $invoice_token
        return $user->notify(new AppointmentNotificationAdmin($message, $invoiceInformations, $status, $invoice->payment_invoice_token, $userFullName, $appointmentId));

    }

    public static function sendNotificationToAdmin($invoice, $status, $user = null) {
        $UserAdmin = new UserAdmin();
        $admin = $UserAdmin->getUserAdmin();

        $invoiceInformations = json_decode($invoice->invoice_informations, true);
        $message = '';

        if($invoiceInformations['type'] == "writing") {
            switch ($status) {
                case 'CONFIRMED':
                    $message = 'Une demande de consultation par email a été effectuée par un utilisateur.';
                    break;
                case 'CANCELLED':
                    $message = 'Une demande de consultation par email a été annulée par un utilisateur.';
                    break;
                case 'UPDATED':
                    $message = 'Une demande de consultation par email a été modifiée par un utilisateur.';
                    break;
                case 'PAID':
                    $message = 'Vous venez de recevoir un paiement pour une consultation par email.';
                    break;
                case 'REFUNDED':
                    $message = 'Un remboursement pour une consultation par email a été initié.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        } else if($invoiceInformations['type'] == "phone") {
            switch ($status) {
                case 'CONFIRMED':
                    $message = 'Une demande de consultation par téléphone a été effectuée par un utilisateur.';
                    break;
                case 'CANCELLED':
                    $message = 'Une demande de rendez-vous par téléphone a été annulée par un utilisateur.';
                    break;
                case 'UPDATED':	
                    $message = 'Une demande de rendez-vous par téléphone a été modifiée par un utilisateur.';
                    break;
                case 'PAID':
                    $message = 'Vous venez de recevoir un paiement pour une consultation par téléphone.';
                    break;
                case 'REFUNDED':
                    $message = 'Un remboursement pour une consultation par téléphone a été initié.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        } else if($invoiceInformations['type'] == "tchat") {
            switch ($status) {
                case 'CONFIRMED':
                    $message = 'Une demande de consultation par email a été effectuée par un utilisateur.';
                    break;
                case 'CANCELLED':
                    $message = 'Une demande de rendez-vous par tchat a été annulée par un utilisateur.';
                    break;
                case 'UPDATED':
                    $message = 'Une demande de rendez-vous par tchat a été modifiée par un utilisateur.';
                    break;
                case 'PAID':
                    $message = 'Vous venez de recevoir un paiement pour une consultation par tchat.';
                    break;
                case 'REFUNDED':
                    $message = 'Un remboursement pour une consultation par tchat a été initié.';
                    break;
                default:
                    $message = 'Votre rendez-vous a été mis à jour.';
                    break;
            }
        }

        $appointmentId = $invoice->appointment->id;
        // $message, $details, $status, $invoice_token
        return $admin->notify(new AppointmentNotificationToAdmin($message, $invoiceInformations, $status, $appointmentId));
    }
}