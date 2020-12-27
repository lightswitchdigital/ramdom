<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\OrderRequest;
use App\Models\Projects\Purchase\PurchasedProject;
use App\Models\Projects\SavedProject;
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
        return view('profile.projects.index');
    }

    public function getPurchasedProjects(Request $request) {

        $batch = (int) $request->get('batch') ?? 1;
        $skip = ($batch - 1) * env('PROJECTS_PAGINATION');

        $user = Auth::user();
        $purchased = $user->purchasedProjects()->with('project')->skip($skip)->take(env('PROJECTS_PAGINATION'))->get();

        return $purchased->toJson();
    }

    public function getProjects(Request $request) {

        $user = Auth::user();
        $saved = $user->savedProjects()->with('project')->with('project.images')->get();
        $purchased = $user->purchasedProjects()->with('project')->with('project.images')->get();

        return [
            'saved' => $saved,
            'purchased' => $purchased
        ];
    }

    public function removeFromSaved(SavedProject $project) {
        $user = Auth::user();

        $user->savedProjects()->where($project->id)->delete();

        return redirect()->back()
            ->with('success', 'Проект успешно удален из сохраненных.');
    }

    public function order(PurchasedProject $project) {
        $developers = User::active()->developers()->get();

        return view('profile.projects.order', compact('developers', 'project'));
    }

    public function orderSubmit(PurchasedProject $project, OrderRequest $request) {

        $user = Auth::user();

        try {
            $this->service->order($user->id, $project->id, $request);
        }catch (\DomainException $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Заказ на строительство успешно создан и передан застройщику. Скоро он с вами свяжется по телефону');
    }

}
