<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Auth;
use Illuminate\Http\Request;

class BalanceController extends Controller
{

    public function index()
    {
        $payments = Payment::whereUserId(\Auth::id())->get();
        $user = Auth::user();

        return view('profile.balance.index', compact('payments', 'user'));
    }

    public function replenish(Request $request)
    {

        $payment = Payment::create([
            'type' => Payment::TYPE_REPLENISHMENT,
            'amount' => $request['amount']
        ]);

        return ($request->expectsJson()) ? [
            'success' => true,
            'payment' => $payment->toArray()
        ] : redirect()->back()
            ->with('success', 'Платеж создан');
    }
}
