<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\BuyRequest;
use App\Http\Requests\Projects\OrderRequest;
use App\Http\Requests\Projects\SearchRequest;
use App\Models\Projects\Attribute;
use App\Models\Projects\Project;
use App\Models\Projects\Purchase\PurchaseAttribute;
use App\Services\Projects\ProjectsService;
use App\Services\Projects\RecommendationsService;
use App\Services\Search\SearchService;
use Auth;
use DomainException;

class ProjectsController extends Controller
{
    private $service;
    private $search;
    private $recommendations;

    public function __construct(ProjectsService $service, SearchService $search, RecommendationsService $recommendations) {
        $this->service = $service;
        $this->search = $search;
        $this->recommendations = $recommendations;
    }

    public function index(SearchRequest $request) {

        $projects = $this->search->searchProjects($request, env('PROJECTS_PAGINATION'), $request->get('page', 1));
        $projects->setPath('/projects');

        $attributes = Attribute::all();

        return view('projects.index', compact('projects', 'attributes'));

    }

    public function show($slug) {
        $project = Project::where('slug', $slug)->with(['images', 'values'])->first();
        if (!$project) {
            abort(404);
        }

        $created_at = $project->created_at->format('d-m-Y');
        $purchase_attributes = PurchaseAttribute::all()->toJson();
        $isAuthenticated = Auth::check();

        $recommendations = $this->recommendations->getRecommendations($project->id)->toJson();

        return view('projects.show', compact('project', 'created_at', 'purchase_attributes', 'isAuthenticated', 'recommendations'));
    }

    public function addToFavorites(Project $project) {
        $user = Auth::user();

        $user->addToFavorites($project->id);

        return response('', 204);
    }

    public function removeFromFavorites(Project $project) {
        $user = Auth::user();

        $user->removeFromFavorites($project->id);

        return response('', 204);
    }

    public function buy(Project $project, BuyRequest $request) {
        $user = Auth::user();

        try {
            $this->service->buy($user->id, $project->id, $request);
        }catch (DomainException $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Проект успешно куплен. Вы можете найти его в личном кабинете');
    }
}
