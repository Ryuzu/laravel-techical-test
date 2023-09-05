<?php

namespace App\Console\Commands;

use App\Mail\NotificationShippedMail;
use App\Models\User;
use App\Notifications\NewsletterNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendNewsletterCommand extends Command
{
    protected $signature = 'send:newsletter';

    protected $description = 'Command description';

    public function handle()
    {
        $chunks = 500;
        $delay = 500;
        $totalUsers = 0;

        /*$users = User::all();

        foreach($users as $user) {
            $user->email_sent = true;
            $user->save();
            Notification::send($this->user, new NewsletterNotification());
        }*/

        User::where('email_sent', false)->chunk(function ($chunked_users){

        })

    }
}
