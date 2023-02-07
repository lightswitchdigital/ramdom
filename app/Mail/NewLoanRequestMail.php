<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewLoanRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    private $request;

    public function __construct(LoanRequest $request)
    {
        $this->request = $request;
    }


    public function build()
    {
        $loan = $this->request;
        return $this->subject("Новый запрос на кредитование")->view('mail.new-loan-request', compact('loan'));
    }
}
