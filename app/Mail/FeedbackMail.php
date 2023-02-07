<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    private $userID;
    private $name;
    private $email;
    private $message;

    public function __construct($userID, $name, $email, $message)
    {
        $this->userID = $userID;
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function build()
    {
        $userID = $this->userID;
        $name = $this->name;
        $email = $this->email;
        $msg = $this->message;

        return $this->subject("Новое обращение от пользователя")->view('mail.feedback', compact('userID', 'name', 'email', 'msg'));
    }
}
