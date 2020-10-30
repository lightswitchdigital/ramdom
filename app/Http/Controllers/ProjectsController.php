<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\SearchRequest;
use App\Services\Search\SearchService;

class ProjectsController extends Controller
{
    private $service;

    public function __construct(SearchService $service) {
        $this->service = $service;
    }

    public function index(SearchRequest $request) {

        $projects = $this->service->search($request, 20, $request->get('page', 1));

        dd($projects);
        return view('projects.index', compact('projects'));

    }
}
