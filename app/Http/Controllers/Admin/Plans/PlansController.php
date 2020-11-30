<?php

namespace App\Http\Controllers\Admin\Plans;

use App\Http\Controllers\Controller;
use App\Models\Plans\Plan;
use App\Services\PlansService;
use DomainException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlansController extends Controller
{

    private $service;

    public function __construct(PlansService $service) {
        $this->service = $service;
    }

    public function index()
    {
        $plans = Plan::all();

        return view('admin.plans.index', compact('plans'));
    }


    public function show(Plan $plan)
    {
        $subscriptions = $plan->subscriptions()->paginate(env('ADMIN_PAGINATION'));

        return view('admin.plans.show', compact('plan', 'subscriptions'));
    }


    public function edit(Plan $plan)
    {
        $intervals = Plan::intervalsList();

        return view('admin.plans.edit', compact('plan', 'intervals'));
    }


    public function update(Request $request, Plan $plan)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'interval' => ['required', Rule::in(array_keys(Plan::intervalsList()))]
        ]);

        try {
            $plan = $this->service->update($request, $plan->id);
        } catch (DomainException $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }

        return redirect()->route('admin.plans.show', $plan)
            ->with('success', 'План успешно обновлен');
    }
}
