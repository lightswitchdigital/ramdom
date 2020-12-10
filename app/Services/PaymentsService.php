<?php


namespace App\Services;


use App\Models\BalanceOperation;
use App\Models\User;

class PaymentsService
{

    public function create($user_id, $amount) {

        $user = $this->getUser($user_id);

        $user->balanceOperations()->create([
            'type' => BalanceOperation::TYPE_ADD,
            'amount' => $amount,
            'status' => BalanceOperation::STATUS_PENDING
        ]);

        $user->update();
    }

    public function pay($user_id, $amount) {
        $user = $this->getUser($user_id);

        if ($user->balance < $amount) {
            throw new \DomainException('На балансе недостаточно средств.');
        }

        $user->balance = $user->balance - $amount;

        $user->balanceOperations()->create([
            'type' => BalanceOperation::TYPE_PROJECT_BOUGHT,
            'amount' => $amount,
            'status' => BalanceOperation::STATUS_FINISHED
        ]);

        $user->update();
    }

    public function accept($payment_id) {
        $payment = $this->getPayment($payment_id);

        $payment->update([
            'status' => BalanceOperation::STATUS_FINISHED,
        ]);

        return $payment;
    }

    public function reject($payment_id) {
        $payment = $this->getPayment($payment_id);

        $payment->update([
            'status' => BalanceOperation::STATUS_REJECTED,
        ]);

        return $payment;
    }


    private function getUser($id): User
    {
        return User::findOrFail($id);
    }

    public function getPayment($id): BalanceOperation
    {
        return BalanceOperation::findOrFail($id);
    }

}
