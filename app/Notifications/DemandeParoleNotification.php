<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeParoleNotification extends Notification
{
    use Queueable;
    public $reunion;
    public $typeNotification;
    /**
     * Create a new notification instance.
     */
    public function __construct($reunion,$typeNotification)
    {
        $this->reunion = $reunion;
        $this->typeNotification = $typeNotification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->line( $this->typeNotification)
        ->line("Votre demande d'intervation au courant de la reunion a ete bien accepter")
        ->action('Voir la reunion ', url('/reunion/list-page'))
        ->line("Merci !");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'code_reunion'=>$this->reunion->id,
            'type_notification'=>$this->typeNotification,
            'message'=>"Votre demande d'intervation au courant de la reunion a ete bien accepter"
        ];
    }
}
