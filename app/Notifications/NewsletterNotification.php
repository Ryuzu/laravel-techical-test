<?php

namespace App\Notifications;

use App\Mail\NotificationShippedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsletterNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new NotificationShippedMail())->to($notifiable);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
