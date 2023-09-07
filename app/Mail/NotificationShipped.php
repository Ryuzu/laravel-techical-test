<?php

namespace App\Mail;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationShipped extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private Notification $notification;

    public function __construct()
    {
    }

    public function build()
    {
        return $this->view('emails.notification-shipped');
    }
}
