<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BalanceAddMail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentsController extends Controller
{

    public function index(Request $request) {
        $query = Payment::whereType(Payment::TYPE_REPLENISHMENT)->orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('user_id'))) {
            $query->where('user_id', $value);
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        if (!empty($value = $request->get('amount'))) {
            $query->where('amount', $value);
        }

        $payments = $query->paginate(config('ADMIN_PAGINATION'));
        $statuses = Payment::statusesList();

        return view('admin.payments.index', compact('payments', 'statuses'));
    }

    public function accept(Payment $payment)
    {
        $user = $payment->user;

        $user->addToBalance($payment->amount);
        $payment->update([
            'status' => Payment::STATUS_FINISHED
        ]);

        Mail::to($user->email)->send(new BalanceAddMail($user, $payment->amount));

        return redirect()->route('admin.payments.index')
            ->with('success', 'Оплата успешно подтверждена');
    }
}
