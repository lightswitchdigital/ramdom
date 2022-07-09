<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $mail;

    public function __construct(User $user, Mailable $mail)
    {
        $this->user = $user;
        $this->mail = $mail;
    }


    public function handle()
    {
        $user = $this->user;
        $mail = $this->mail;

        Mail::to($user->email)->send($mail);
    }
}
