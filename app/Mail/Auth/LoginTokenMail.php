<?php

namespace App\Mail\Auth;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginTokenMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $token;


    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }


    public function build()
    {
        $user = $this->user;
        $token = $this->token;

        return $this
            ->subject('Подтверждение входа')
            ->view('mail.auth.login-token', compact('user', 'token'));
    }
}
