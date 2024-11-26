<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentNotificationToAdmin extends Notification
{
    use Queueable;

    private $details;
    private $message;
    private $status;
    private $appointmentId;

    /**
     * Create a new notification instance.
     */
    public function __construct($message, $details, $status, $appointmentId = null)
    {
        $this->message = $message;
        $this->status = $status;
        $this->details = $details;
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
                ->subject('Un rendez-vous a été annulé')
                ->line($this->message)
                ->action('Retourner sur le site', url(route('admin.index')));
            }elseif ($this->status === 'REFUNDED') {
                return (new MailMessage)
                ->subject('Un remboursement pour un rendez-vous est en cours')
                ->line($this->message)
                ->action('Retourner sur le site', url(route('admin.appointments.show', $this->appointmentId)));
            }elseif ($this->status === 'CONFIRMED') {
                return (new MailMessage)
                ->subject('Une nouvelle demande de consultation a été effectuée')
                ->line($this->message)
                ->action('Retourner sur le site', url(route('admin.appointments.show', $this->appointmentId)));
            }elseif ($this->status === 'UPDATED') {
                return (new MailMessage)
                ->subject('Un rendez-vous a été modifié')
                ->line($this->message)
                ->line('Il aura lieu le ' . $this->details['time_slot_day_for_human'] . ' à ' . $this->details['time_slot_for_human'])
                ->line($this->details['type'] == 'phone' ? 'Par téléphone' : 'Par tchat')
                ->action('Voir le RDV', url(route('admin.appointments.show', $this->appointmentId)));
            }elseif ($this->status === 'PAID') {
                return (new MailMessage)
                ->subject('Un paiement pour une consultation a été effectué')
                ->line($this->message)
                ->action('Voir la demande', url(route('admin.appointments.show', $this->appointmentId)));
            }
        }elseif ($this->details['type'] === 'writing') {
            if ($this->status === 'CANCELLED') {
                return (new MailMessage)
                ->subject('Une demande de consultation par écrit a été annulée')
                ->line($this->message)
                ->action('Retourner sur le site', url(route('admin.index')));
            }elseif ($this->status === 'REFUNDED') {
                return (new MailMessage)
                ->subject('Un remboursement pour une consultation par écrit est en cours')
                ->line($this->message)
                ->action('Retourner sur le site', url(route('admin.appointments.show', $this->appointmentId)));
            }elseif ($this->status === 'CONFIRMED') {
                return (new MailMessage)
                ->subject('Une nouvelle demande de consultation par écrit a été effectuée')
                ->line($this->message)
                ->action('Retourner sur le site', url(route('admin.appointments.show', $this->appointmentId)));
            }elseif ($this->status === 'PAID') {
                return (new MailMessage)
                ->subject('Un paiement pour une consultation par écrit a été effectué')
                ->line($this->message)
                ->line('Celle-ci est en attente de réponse sous 3 jours.')
                ->action('Voir la demande', url(route('admin.appointments.show', $this->appointmentId)));
            }elseif ($this->status === 'UPDATED') {
                return (new MailMessage)
                ->subject('Une demande de consultation par écrit a été modifiée')
                ->line($this->message)
                ->line('Celle-ci est en attente de réponse.')
                ->action('Voir la demande', url(route('admin.appointments.show', $this->appointmentId)));
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