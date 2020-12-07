<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceOperation;
use App\Services\PaymentsService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    private $service;

    public function __construct(PaymentsService $service) {
        $this->service = $service;
    }

    public function index(Request $request) {
        $query = BalanceOperation::typeAdd()->orderByDesc('id');

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
        $statuses = BalanceOperation::statusesList();

        return view('admin.payments.index', compact('payments', 'statuses'));
    }

    public function accept(BalanceOperation $payment) {
        $this->service->accept($payment->id);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Оплата успешно подтверждена');
    }

    public function reject(BalanceOperation $payment) {
        $this->service->reject($payment->id);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Оплата успешно отклонена');
    }
}
