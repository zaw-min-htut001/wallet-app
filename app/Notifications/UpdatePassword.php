<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UpdatePassword extends Notification
{
    use Queueable;

    public $title, $message, $sourceable_id, $sourceable_type, $web_link ,$user_id;
    /**
     * Create a new notification instance.
     */
    public function __construct($title, $message, $sourceable_id, $sourceable_type, $web_link,$user_id)
    {
        $this->title = $title;
        $this->message = $message;
        $this->sourceable_id = $sourceable_id;
        $this->sourceable_type = $sourceable_type;
        $this->web_link = $web_link;
        $this->user_id = $user_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => $this->title ,
            'message' => $this->message,
            'sourceable_id' => $this->sourceable_id,
            'sourceable_type' => $this->sourceable_type,
            'web_link' => $this->web_link,
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title' => $this->title ,
            'message' => $this->message,
            'sourceable_id' => $this->sourceable_id,
            'sourceable_type' => $this->sourceable_type,
            'web_link' => $this->web_link,
            'user_id' => $this->user_id,
        ]);
    }
}
