<?php

namespace App\Console\Commands;

use App\Jobs\SendNewsletterJob;
use App\Mail\NotificationShipped;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\Console\Command\Command as CommandAlias;

class SendNewsletterCommand extends Command
{
    protected $signature = 'users:send-newsletter';

    protected $description = 'Command description';

    public function handle()
    {
        User::with('notifications')->chunk(100, function ($users) {
            foreach ($users as $user) {
                if ($user->notifications->isEmpty()) {
                    $user->notifications()->attach(1);
//                    dispatch(new SendNewsletterJob($user));
                    \Mail::to($user)->queue(new NotificationShipped());
                }
            }
            info('Sleeping...');
            sleep(5);
        });
    }
}
