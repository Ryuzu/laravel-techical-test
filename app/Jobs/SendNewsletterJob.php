<?php

namespace App\Jobs;

use App\Mail\NotificationShipped;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(): void
    {
//        Notification::send($this->user, new NotificationShipped());
//        \Mail::to($this->user->email)->send(new NotificationShipped());
        info('Sending email to ' . $this->user->email);
    }
}
