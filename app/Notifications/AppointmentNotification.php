<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentNotification extends Notification
{
    use Queueable;

    private $details;
    private $message;
    private $status;
    private $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($message, $details, $status, $token)
    {
        $this->message = $message;
        $this->status = $status;
        $this->details = $details;
        $this->token = $token;
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
        return (new MailMessage)
        ->subject('Appointment Status: ' . $this->status)
                    ->line('The status of your appointment is: ' . $this->status)
                    ->line('Details: ' . json_encode($this->details))
                    ->line($this->message)
                    ->action('Notification Action', url(route('my_space.appointment.view', $this->token)))
                    ->line('Thank you for using our application!');
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
