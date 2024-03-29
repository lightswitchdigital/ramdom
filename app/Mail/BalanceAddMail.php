<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BalanceAddMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $amount;

    public function __construct(User $user, $amount)
    {
        $this->user = $user;
        $this->amount = $amount;
    }


    public function build()
    {
        $user = $this->user;
        $amount = $this->amount;

        return $this->view('mail.balance-add', compact('user', 'amount'));
    }
}
