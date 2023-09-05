<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    protected $notification;

    public function __construct(User $user, Notification $notification)
    {
        $this->notification = $this->notification->first()->title;
        $this->user = $user;
    }

    public function handle()
    {
        info("Mail sent to" . $this->user->email . "Title:  ", $this->notification);
    }
}
