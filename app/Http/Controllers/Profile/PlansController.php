<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Plans\Plan;
use App\Services\PlansService;
use Auth;
use DomainException;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    private $service;

    public function __construct(PlansService $service) {
        $this->service = $service;
    }

    public function index() {
        return view('profile.plans.index');
    }

    public function payment(Plan $plan) {

    }

    public function subscribe(Plan $plan) {
        $user = Auth::user();

        try {
            $this->service->subscribe($user->id, $plan->id);
        }catch (DomainException $e) {

        }


    }

}
