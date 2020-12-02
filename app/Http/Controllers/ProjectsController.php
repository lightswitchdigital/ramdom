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

    public function __construct(SearchService $service) {
        $this->service = $service;
    }

    public function index(SearchRequest $request) {

        $projects = $this->service->searchProjects($request, 20, $request->get('page', 1));

        $attributes = Attribute::all();

        return view('projects.index', compact('projects', 'attributes'));

    }

    public function show($slug) {
        $project = Project::where('slug', $slug)->with(['images', 'values'])->first();
        if (!$project) {
            abort(404);
        }

        $images = $project->getImagesInJson();
        $created_at = $project->created_at->format('d-m-Y');
        $values = $project->getValuesInJson();
        $order_attributes = ProjectAttribute::all()->toJson();
        $isAuthenticated = Auth::check();
        $isInFavorites = Auth::check()? Auth::user()->hasInFavorites($project): false;

        return view('projects.show', compact('project', 'images', 'created_at', 'values', 'order_attributes', 'isAuthenticated', 'isInFavorites'));
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
