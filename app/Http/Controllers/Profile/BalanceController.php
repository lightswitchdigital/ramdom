<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\PaymentsService;
use Auth;
use Illuminate\Http\Request;
use QrCode;

class BalanceController extends Controller
{
    private $service;

    public function __construct(PaymentsService $service) {
        $this->service = $service;
    }

    public function index() {
        $user = Auth::user();
        $payments = $user->balanceOperations()->paginate(10);

        return view('profile.balance.index', compact('user', 'payments'));
    }

    public function add() {
        return view('profile.balance.add');
    }

    public function check(Request $request) {
        $this->validate($request, [
            'amount' => ['required', 'numeric']
        ]);

        $user = Auth::user();

        $this->service->create($user->id, $request['amount']);

        return [
            'company_name' => 'ООО Рамдом',
            'inn' => '123',
            'kpp' => '123123',
            'orgn' => '123123123',
            'payment_account' => '99999999',
            'correspondent_account' => '00000000',
            'bik' => '1111111',
            'purpose' => 'Пополнение баланса ID '.$user->id,
            'name' => $user->getFullName(),
            'qrcode_url' => 'https://spbformat.ru/wp-content/uploads/2020/05/qr-kod.jpg'
        ];
    }
}
