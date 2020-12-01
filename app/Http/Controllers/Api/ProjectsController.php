<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projects\Project;
use App\Services\Projects\RecommendationsService;
use DomainException;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    private $service;

    public function __construct(RecommendationsService $service) {
        $this->service = $service;
    }

    public function recommendations(Project $project) {

        try {
            $items = $this->service->getRecommendations($project->id);
        }catch(DomainException $e) {

            return response('', 503);

        }

        return $items->toJson();
    }
}
