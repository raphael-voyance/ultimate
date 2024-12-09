<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentNotificationAdmin extends Notification
{
    use Queueable;

    private $details;
    private $message;
    private $status;
    private $token;
    private $userFullName;
    private $appointmentId;

    /**
     * Create a new notification instance.
     */
    public function __construct($message, $details, $status, $token, $userFullName = null, $appointmentId = null)
    {
        $this->message = $message;
        $this->status = $status;
        $this->details = $details;
        $this->token = $token;
        $this->userFullName = $userFullName;
        $this->appointmentId = $appointmentId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $details = json_encode($this->details);
        if($this->details['type'] === 'phone' || $this->details['type'] === 'tchat') {
            if ($this->status === 'CANCELLED') {
                return (new MailMessage)
                ->subject('Votre rendez-vous a été annulé par Raphaël')
                ->line($this->message)
                ->action('Retourner sur le site', url(route('home')))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'REFUNDED') {
                return (new MailMessage)
                ->subject('Un remboursement a été initié par Raphaël, il apparaitra sur votre moyen de paiement prochainement.')
                ->line($this->message)
                ->action('Retourner sur le site', url(route('home')))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'FREE') {
                return (new MailMessage)
                ->subject('Raphaël a bien enregistré votre demande de consultation gratuite')
                ->line($this->message)
                ->line('Elle aura lieu le ' . $this->details['time_slot_day_for_human'] . ' à ' . $this->details['time_slot_for_human'])
                ->line($this->details['type'] == 'phone' ? 'Par téléphone' : 'Par tchat')
                ->action('Voir le RDV', url(route('my_space.appointment.view', $this->token)))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'APPROVED') {
                return (new MailMessage)
                ->subject('Votre demande de rendez-vous a été approuvée par Raphaël')
                ->line($this->message)
                ->line('Il aura lieu le ' . $this->details['time_slot_day_for_human'] . ' à ' . $this->details['time_slot_for_human'])
                ->line($this->details['type'] == 'phone' ? 'Par téléphone' : 'Par tchat')
                ->action('Voir le RDV', url(route('my_space.appointment.view', $this->token)))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'UPDATED') {
                return (new MailMessage)
                ->subject('Votre demande de rendez-vous a été modifiée par Raphaël')
                ->line($this->message)
                ->line('Il aura lieu le ' . $this->details['time_slot_day_for_human'] . ' à ' . $this->details['time_slot_for_human'])
                ->line($this->details['type'] == 'phone' ? 'Par téléphone' : 'Par tchat')
                ->action('Voir le RDV', url(route('my_space.appointment.view', $this->token)))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'PAID') {
                return (new MailMessage)
                ->subject('Le paiement pour votre consultation' . $this->details['type'] == 'phone' ? 'par téléphone' : 'par tchat' . 'a été effectué avec succès')
                ->line($this->message)
                ->line('Raphaël vous enverra une confirmation par email dans les plus brefs délais.')
                ->action('Voir votre demande', url(route('my_space.appointment.view', $this->token)))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'CREATED') {
                return (new MailMessage)
                ->subject('Raphaël a bien enregistré votre demande de rendez-vous')
                ->line($this->message)
                ->action('Voir votre demande', url(route('my_space.appointment.view', $this->token)))
                ->line('Merci pour votre confiance !');
            }
        }elseif ($this->details['type'] === 'writing') {
            if ($this->status === 'CANCELLED') {
                return (new MailMessage)
                ->subject('Votre question par email a été annulée')
                ->line($this->message)
                ->action('Retourner sur le site', url(route('home')))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'REFUNDED') {
                return (new MailMessage)
                ->subject('Un remboursement est en cours pour votre demande de consultation par écrit')
                ->line($this->message)
                ->action('Retourner sur le site', url(route('home')))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'FREE') {
                return (new MailMessage)
                ->subject('Raphaël a bien enregistré votre demande de consultation gratuite par écrit')
                ->line($this->message)
                ->line('Je vous répondrai dans un délai de trois jours.')
                ->action('Voir votre demande', url(route('my_space.appointment.view', $this->token)))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'PAID') {
                return (new MailMessage)
                ->subject('Votre paiement pour votre consultation par écrit a été effectué avec succès')
                ->line($this->message)
                ->line('Je vous répondrai dans les trois jours à venir.')
                ->action('Voir votre demande', url(route('my_space.appointment.view', $this->token)))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'APPROVED') {
                return (new MailMessage)
                ->subject('Votre demande consultation par écrit a été approuvée par Raphaël')
                ->line($this->message)
                ->line('Je vous répondrai dans les trois jours suivant la réception de votre paiement.')
                ->action('Voir votre demande', url(route('my_space.appointment.view', $this->token)))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'UPDATED') {
                return (new MailMessage)
                ->subject('Votre demande de consultation par écrit a bien été modifiée')
                ->line($this->message)
                ->line('Je vous répondrai dans les plus brefs délais.')
                ->action('Voir votre demande', url(route('my_space.appointment.view', $this->token)))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'REPLY') {
                return (new MailMessage)
                ->subject('La réponse à votre consultation par écrit est disponible')
                ->line($this->message)
                ->action('Accéder à la réponse', url(route('my_space.appointment.show', ['user_name' => $this->userFullName, 'appointment_id' => $this->appointmentId])))
                ->line('Merci pour votre confiance !');
            }elseif ($this->status === 'CREATED') {
                return (new MailMessage)
                ->subject('Votre demande de consultation par email a été enregistrée avec succès')
                ->line($this->message)
                ->action('Voir votre demande', url(route('my_space.appointment.view', $this->token)))
                ->line('Merci pour votre confiance !');
            }
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'status' => $this->status,
            'details' => $this->details,
            'message' => $this->message,
        ];
    }
}