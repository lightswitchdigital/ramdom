<?php

namespace App\Mail;

use App\Models\Plans\Plan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanPriceChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }


    public function build()
    {
        $plan = $this->plan;

        return $this->view('mail.plan-price-changed', compact('plan'));
    }
}
