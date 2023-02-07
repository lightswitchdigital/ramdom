<?php

namespace App\Mail;

use App\Models\BuildRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBuildRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $buildRequest;

    public function __construct(User $user, BuildRequest $buildRequest)
    {
        $this->user = $user;
        $this->buildRequest = $buildRequest;
    }

    public function build()
    {
        $user = $this->user;
        $buildRequest = $this->buildRequest;

        return $this->subject('Новый запрос на строительство')->view('mail.new-build-request', compact('user', 'buildRequest'));
    }
}
