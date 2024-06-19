<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DispatchNotification extends Notification
{
    use Queueable;

    private String $number_courrier;
    private String $user_name;
    private String $typeNotification;

    /**
     * Create a new notification instance.
     */
    public function __construct($number_courrier,$user_name,$typeNotification)
    {
        $this->number_courrier = $number_courrier;
        $this->user_name = $user_name;
        $this->typeNotification = $typeNotification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Information')
                    ->action('Notification Action', url('/'))
                    ->line('Un courrier vous a ete dispatcher');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [

            'number_courrier'=>$this->number_courrier,
            'user_name'=>$this->user_name,
            'type_notification'=>$this->typeNotification,
            'message'=>$this->user_name." Vous a affecter à un courrier ( $this->number_courrier ), Veillez consulter la liste de vos courriers."
        
        ];
    }
}
