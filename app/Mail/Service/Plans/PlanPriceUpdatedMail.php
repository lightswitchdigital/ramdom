<?php

namespace App\Mail\Service\Plans;

use App\Models\Plans\Plan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanPriceUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $plan;

    public function __construct(User $user, Plan $plan)
    {
        $this->user = $user;
        $this->plan = $plan;
    }

    public function build()
    {
        $user = $this->user;
        $plan = $this->plan;

        return $this->subject('Обновлена цена вашего тарифного плана')->view('mail.service.plans.plan-price-updated', compact('user', 'plan'));
    }
}
