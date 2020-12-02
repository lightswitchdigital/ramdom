<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\SearchRequest;
use App\Models\Orders\ProjectAttribute;
use App\Models\Projects\Attribute;
use App\Models\Projects\Project;
use App\Services\Projects\RecommendationsService;
use App\Services\Search\SearchService;
use Auth;
use DomainException;
use Storage;

class ProjectsController extends Controller
{
    private $service;
    private $recommendations;

    public function __construct(SearchService $service, RecommendationsService $recommendations) {
        $this->service = $service;
        $this->recommendations = $recommendations;
    }

    public function index(SearchRequest $request) {

        $projects = $this->service->searchProjects($request, env('PROJECTS_PAGINATION'), $request->get('page', 1));
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
        $order_attributes = ProjectAttribute::all()->toJson();
        $isAuthenticated = Auth::check();

        $recommendations = $this->recommendations->getRecommendations($project->id)->toJson();

        return view('projects.show', compact('project', 'created_at', 'order_attributes', 'isAuthenticated', 'recommendations'));
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
}
