<?php

namespace App\Console\Commands;

use App\Models\Notification;
use Illuminate\Console\Command;

class ExpireNotificationsCommand extends Command
{

    protected $signature = 'notifications:expire';


    public function handle()
    {
        Notification::findExpired()->delete();
    }
}
