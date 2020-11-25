<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\OrderRequest;
use App\Models\Projects\Project;
use App\Services\OrderService;
use DomainException;

class OrderController extends Controller
{
    private $service;

    public function __construct(OrderService $service) {
        $this->service = $service;
    }

    public function order(Project $project, OrderRequest $request) {

        try {
            $this->service->order($project->id, $request);
        }catch (DomainException $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Заказ на строительство успешно оформлен');
    }
}
