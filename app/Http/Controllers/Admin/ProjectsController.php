<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Projects\CreateRequest;
use App\Http\Requests\Admin\Projects\UpdateRequest;
use App\Models\Projects\Project;
use App\Services\ProjectsService;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    private $service;

    public function __construct(ProjectsService $service) {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = Project::orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('title'))) {
            $query->where('title', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('price'))) {
            $query->where('price', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        $projects = $query->paginate(config('ADMIN_PAGINATION'));
        $statusesList = Project::statusesList();

        return view('admin.projects.index', compact('projects', 'statusesList'));
    }


    public function create()
    {
        $statusesList = Project::statusesList();

        return view('admin.projects.create', compact('statusesList'));
    }


    public function store(CreateRequest $request)
    {
        $project = $this->service->create($request);

        return redirect()->route('admin.projects.show', $project);
    }


    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }


    public function edit(Project $project)
    {
        $statusesList = Project::statusesList();

        return view('admin.projects.edit', compact('project', 'statusesList'));
    }


    public function update(UpdateRequest $request, Project $project)
    {
        $project->update($request->all());

        return redirect()->route('admin.projects.show', $project)
            ->with('success', 'Проект успешно обновлен.');
    }


    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Проект успешно удален');
    }
}
