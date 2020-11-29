<?php


namespace App\Services;

use App\Jobs\SendEmailJob;
use App\Mail\Service\Plans\PlanIntervalUpdatedMail;
use App\Mail\Service\Plans\PlanPriceUpdatedMail;
use App\Models\Plans\Plan;
use Illuminate\Http\Request;

class PlansService
{

    public function update(Request $request, Plan $plan): Plan
    {

        $price = $plan->price;
        $interval = $plan->interval;

        $subscriptions = $plan->subscriptions();

        $plan->name = $request['name'];
        $plan->price = $request['price'];
        $plan->interval = $request['interval'];

        $plan->update();

        if ($price != $request['price']) {
            $subscriptions->chunk(200, function($subscriptions) use($plan) {
                foreach ($subscriptions as $subscription) {
                    $user = $subscription->user;
                    SendEmailJob::dispatch($user, new PlanPriceUpdatedMail($user, $plan))->onQueue('email');
                }
            });
        }
        if ($interval != $request['interval']) {
            $subscriptions->chunk(200, function($subscriptions) use($plan) {
                foreach ($subscriptions as $subscription) {
                    $user = $subscription->user;

                    $subscription->setNewInterval();
                    SendEmailJob::dispatch($user, new PlanIntervalUpdatedMail($user, $plan))->onQueue('email');
                }
            });
        }

        return $plan;

    }

}
