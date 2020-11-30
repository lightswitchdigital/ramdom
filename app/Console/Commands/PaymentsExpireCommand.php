<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Services\PaymentsService;
use Illuminate\Console\Command;

class PaymentsExpireCommand extends Command
{

    protected $signature = 'payments:expire';

    private $service;

    public function __construct(PaymentsService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function handle()
    {
        Payment::findExpired()->chunk(200, function($payments) {
            foreach ($payments as $payment) {
                $this->service->expire($payment->id);
            }
        });

        $this->info('payments statuses successfully changed');
    }
}
