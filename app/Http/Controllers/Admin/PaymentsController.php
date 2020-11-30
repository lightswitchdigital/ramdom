<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\PaymentsService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    private $service;

    public function __construct(PaymentsService $service) {
        $this->service = $service;
    }

    public function index(Request $request) {
        $query = Payment::orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        if (!empty($value = $request->get('amount'))) {
            $query->where('amount', $value);
        }

        if (!empty($value = $request->get('gateway'))) {
            $query->where('gateway', $value);
        }

        $payments = $query->paginate(config('ADMIN_PAGINATION'));
        $statuses = Payment::statusesList();
        $gateways = Payment::gatewaysList();

        return view('admin.payments.index', compact('payments', 'statuses', 'gateways'));
    }

    public function show(Payment $payment) {
        return view('admin.payments.show', compact('payment'));
    }
}
