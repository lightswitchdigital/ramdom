<?php


namespace App\Services;

use App\Http\Requests\Admin\Projects\CreateRequest;
use App\Models\Projects\Project;

class ProjectsService
{
    public function create(CreateRequest $request) {

        $project = Project::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'price' => $request['price'],
        ]);

        return $project;
    }
}
