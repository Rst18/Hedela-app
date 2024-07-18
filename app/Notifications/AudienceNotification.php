<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class AudienceNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public string $message;
    public string $typeNotification;
    /**
     * Create a new notification instance.
     */
    public function __construct(string $message, string $typeNotification)
    {
        $this->message = $message;
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
        // return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Bonjour !')
                    ->line($this->message)
                    ->action('Voir mes audiences', url('/audience/mes-audiences'))
                    ->line('Merci');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            
            'type_notification'=>$this->typeNotification,
            'message'=>$this->message
        
        ];
    }
}
