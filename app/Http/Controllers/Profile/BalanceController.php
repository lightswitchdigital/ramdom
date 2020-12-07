<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\PaymentsService;
use Auth;
use Illuminate\Http\Request;

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
            'inn' => '',
            'kpp' => '',
            'orgn' => '',
            'payment_account' => '',
            'correspondent_account' => '',
            'bik' => '',
            'purpose' => 'Пополнение баланса ID '.$user->id,
            'name' => $user->getFullName()
        ];
    }
}
