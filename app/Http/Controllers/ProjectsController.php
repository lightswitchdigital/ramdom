<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\SearchRequest;
use App\Models\Projects\Attribute;
use App\Models\Projects\Project;
use App\Services\Search\SearchService;
use Storage;

class ProjectsController extends Controller
{
    private $service;

    public function __construct(SearchService $service) {
        $this->service = $service;
    }

    public function index(SearchRequest $request) {

        $projects = $this->service->search($request, 20, $request->get('page', 1));

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

        return view('projects.show', compact('project', 'images', 'created_at', 'values'));
    }
}
