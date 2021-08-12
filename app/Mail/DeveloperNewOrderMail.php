<?php

namespace App\Mail;

use App\Models\Projects\Purchase\PurchasedProject;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeveloperNewOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private $project;
    private $user;

    public function __construct(PurchasedProject $project, User $developer)
    {
        $this->project = $project;
        $this->user = $developer;
    }


    public function build()
    {
        $project = $this->project;
        $user = $this->user;

        return $this->subject('Новый заказ на строительство')->view('mail.developer-new-order', compact('project', 'user'));
    }
}
