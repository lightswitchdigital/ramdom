<?php


namespace App\Services;

use App\Jobs\SendEmailJob;
use App\Mail\Service\Plans\PlanIntervalUpdatedMail;
use App\Mail\Service\Plans\PlanPriceUpdatedMail;
use App\Models\Plans\Plan;
use App\Models\Plans\PlanSubscription;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class PlansService
{
    private $payments;

    public function __construct(PaymentsService $payments) {
        $this->payments = $payments;
    }

    public function subscribe($user_id, $plan_id) {

        $user = $this->getUser($user_id);
        $plan = $this->getPlan($plan_id);

        if ($user->subscription && $user->subscription->plan_id === $plan->id) {
            return redirect()->back()
                ->with('error', 'Вы уже подписаны на данный план');
        }

        if ($user->balance < $plan->price) {
            throw new \DomainException('На вашем балансе недостаточно средств');
        }

        DB::transaction(function () use ($user, $plan) {

            if ($user->subscription) {
                $user->subscription->changePlan($plan);

                return;
            }

            $starts_at = Carbon::now();
            $ends_at = $starts_at->addDays($plan->getIntervalInDays());

            $subscription = PlanSubscription::make([
                'starts_at' => $starts_at,
                'ends_at' => $ends_at,
                'status' => PlanSubscription::STATUS_ACTIVE
            ]);

            $subscription->plan()->associate($plan);
            $subscription->user()->associate($user);

            $user->update([
                'role' => $subscription->plan->slug
            ]);

            $subscription->save();

        });

        $this->payments->pay($user->id, $plan->price);

    }

    public function cancel($user_id) {

        $user = $this->getUser($user_id);
        $subscription = $user->subscription;

        $canceled_at = Carbon::now();

        $subscription->update([
            'canceled_at' => $canceled_at,
            'status' => PlanSubscription::STATUS_INACTIVE
        ]);
    }

    ///////////////////
    // Admin management

    public function update(Request $request, $plan_id): Plan
    {

        $plan = $this->getPlan($plan_id);

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


    ///////////////////
    // Getters

    private function getUser($id): User
    {
        return User::findOrFail($id);
    }

    private function getPlan($id): Plan
    {
        return Plan::findOrFail($id);
    }

}
