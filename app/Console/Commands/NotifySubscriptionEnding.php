<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\Plans\PlanSubscription;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class NotifySubscriptionEnding extends Command
{

    protected $signature = 'subscriptions:notify';


    public function handle()
    {
        PlanSubscription::active()->findEndingPeriod()->chunk(200, function(Collection $subscriptions) {
            foreach ($subscriptions as $subscription) {
                $user = $subscription->user;

                Notification::generate([
                    'user_id' => $user->id,
                    'title' => 'Заканчивается подписка на план',
                    'content' => 'Заканчивается подписка на план ' . $subscription->plan->name . '. Проверьте, чтобы на балансе хватало средств для ее продления'
                ]);
            }
        });
    }
}
