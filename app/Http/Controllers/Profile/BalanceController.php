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
        $user = Auth::user();

        $payment = Payment::create([
            'user_id' => $user->id,
            'type' => Payment::TYPE_REPLENISHMENT,
            'amount' => $request['amount'],
            'status' => Payment::STATUS_PENDING
        ]);

        return [
            'amount' => $request['amount'],
            'company_name' => 'ООО Рамдом',
            'inn' => '123',
            'kpp' => '123123',
            'orgn' => '123123123',
            'payment_account' => '99999999',
            'correspondent_account' => '00000000',
            'bik' => '1111111',
            'purpose' => 'Пополнение баланса ID ' . $user->id,
            'name' => $user->getFullName(),
            'qrcode_url' => 'https://spbformat.ru/wp-content/uploads/2020/05/qr-kod.jpg'
        ];
    }
}
