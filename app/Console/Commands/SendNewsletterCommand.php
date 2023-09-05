<?php

namespace App\Console\Commands;

use App\Jobs\SendNewsletterJob;
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
        $totalUsers = 500;
        $batchSize = 100;

        for ($offset = 0; $offset < $totalUsers; $offset += $batchSize) {
            $users = User::where('email_sent', false)
                ->limit($batchSize)
                ->offset($offset)
                ->get();

            foreach ($users as $user) {
                dispatch(new SendNewsletterJob($user))->onQueue('newsletter');
            }
        }

        $this->info('Newsletter sending tasks added to the queue.');
    }
}
