<?php


namespace App\Services;


use App\Models\Payment;
use App\Models\User;

class PaymentsService
{

    public function create($user_id, $gateway, $amount) {

        $user = $this->getUser($user_id);

        $payment = Payment::make([
            'gateway' => $gateway,
            'amount' => $amount
        ]);
        $payment->user()->associate($user);

        $payment->save();

        return $payment;
    }

    public function finish($payment_id) {
        $payment = $this->getPayment($payment_id);

        $payment->update([
            'status' => Payment::STATUS_FINISHED,
            'expires_at' => null
        ]);

        return $payment;
    }

    public function expire($payment_id) {
        $payment = $this->getPayment($payment_id);

        $payment->update([
            'status' => Payment::STATUS_EXPIRED,
            'expires_at' => null
        ]);

        return $payment;
    }


    private function getUser($id): User
    {
        return User::findOrFail($id);
    }

    private function getPayment($id): Payment
    {
        return Payment::findOrFail($id);
    }
}
