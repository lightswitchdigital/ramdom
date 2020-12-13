<?php

namespace App\Console\Commands;

use App\Models\BalanceOperation;
use App\Models\Notification;
use App\Models\Plans\PlanSubscription;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class RenewSubscriptionsCommand extends Command
{

    protected $signature = 'subscriptions:renew';


    public function handle()
    {
        PlanSubscription::chunk(200, function (Collection $subscriptions) {
           foreach ($subscriptions as $subscription) {
               $user = $subscription->user;
               $price = $subscription->plan->price;

               if ($user->balance < $price) {

                   Notification::generate([
                       'user_id' => $user->id,
                       'title' => 'Подписка не может быть продлена',
                       'content' => 'Ваша подписка на план '.$subscription->plan->name.' не может быть продлена, так как на счете недостаточно средств.'
                   ]);

                   return;
               }

               $user->subscription->renew();

               $user->balance -= $price;

               Notification::generate([
                   'user_id' => $user->id,
                   'title' => 'Подписка успешно продлена',
                   'content' => 'Ваша подписка на план '.$subscription->plan->name.' была успешно продлена'
               ]);

               $user->balanceOperations()->create([
                   'type' => BalanceOperation::TYPE_SUBSCRIPTION_CHARGED,
                   'status' => BalanceOperation::STATUS_FINISHED,
                   'amount' => $price
               ]);

               return;
           }
        });
    }
}
