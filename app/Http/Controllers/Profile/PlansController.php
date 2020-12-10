<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Plans\Plan;
use App\Services\PaymentsService;
use App\Services\PlansService;
use Auth;
use DomainException;

class PlansController extends Controller
{
    private $service;
    private $payments;

    public function __construct(PlansService $service, PaymentsService $payments) {
        $this->service = $service;
        $this->payments = $payments;
    }

    public function index() {
        $plans = Plan::all();

        return view('profile.plans.index', compact('plans'));
    }

    public function subscribe(Plan $plan) {
        $user = Auth::user();

        try {

            $this->service->subscribe($user->id, $plan->id);

        }catch (DomainException $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Вы успешно перешли на новый план');
    }

}
