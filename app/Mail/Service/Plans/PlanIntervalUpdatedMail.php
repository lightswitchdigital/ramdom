<?php

namespace App\Mail\Service\Plans;

use App\Models\Plans\Plan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanIntervalUpdatedMail extends Mailable
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

        return $this->subject('Изменения вашего тарифного плана')->view('mail.service.plans.plan-interval-updated', compact('user', 'plan'));
    }
}
