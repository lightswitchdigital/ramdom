<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\OrderRequest;
use App\Models\Order;
use App\Models\Projects\Project;
use App\Models\Projects\Purchase\PurchasedProject;
use App\Models\User;
use App\Services\OrderService;
use Auth;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    private $service;

    public function __construct(OrderService $service) {
        $this->service = $service;
    }

    public function index() {
        $user = Auth::user();
        $projects = $user->purchasedProjects()->with('project')->paginate(env('PROJECTS_PAGINATION'));

        return view('profile.projects.index', compact('projects'));
    }

    public function order(PurchasedProject $project) {
        $developers = User::active()->developers()->paginate(10);

        return view('profile.projects.order', compact('developers', 'project'));
    }

    public function orderSubmit(PurchasedProject $project, User $developer, OrderRequest $request) {

        $user = Auth::user();

        try {
            $this->service->order($user->id, $project->id, $developer->id, $request);
        }catch (\DomainException $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Заказ на строительство успешно создан и передан застройщику. Скоро он с вами свяжется по телефону');
    }

    public function calculatePrice(PurchasedProject $project) {

//        todo: Подключить смету
        return $project->project->price;
    }

}
