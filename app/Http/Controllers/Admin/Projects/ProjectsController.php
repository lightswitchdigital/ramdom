<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Projects\AttributesRequest;
use App\Http\Requests\Admin\Projects\CreateRequest;
use App\Http\Requests\Admin\Projects\EditRequest;
use App\Http\Requests\Admin\Projects\PhotosRequest;
use App\Models\Projects\Attribute;
use App\Models\Projects\Project;
use App\Services\Projects\ProjectsService;
use DomainException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $attributes = Attribute::all();
        $editor_attributes = $this->getEditorAttributes();

        return view('admin.projects.create', compact('statusesList', 'attributes', 'editor_attributes'));
    }


    public function store(CreateRequest $request)
    {
        $project = $this->service->create($request);

        return redirect()->route('admin.projects.show', $project);
    }


    public function show(Project $project)
    {
        $attributes = Attribute::all();
        return view('admin.projects.show', compact('project', 'attributes'));
    }


    public function edit(Project $project)
    {
        $statusesList = Project::statusesList();
        $attributes = Attribute::all();
        $values = $project->getValuesWithID();
        $default_attributes = $this->getEditorAttributes();
        $editor_attributes = json_decode(file_get_contents(Storage::disk('public')->path($project->file)), true);

        return view('admin.projects.edit', compact('project', 'statusesList', 'attributes', 'values', 'default_attributes', 'editor_attributes'));
    }

    public function getEditorAttributes() {
        $file = json_decode(file_get_contents(public_path('/internal/mappings.json')));
        $editor_attributes = collect();
        foreach ($file->cells as $name => $cell) {
            $cell->name = $name;
            $editor_attributes->add($cell);
        }

        return $editor_attributes->sortBy(function($item) {
            return strlen($item->id);
        }, SORT_REGULAR)->sortBy(function($item) {
            return $item->id;
        }, SORT_REGULAR);
    }

    public function update(EditRequest $request, Project $project)
    {
        try {
            $this->service->edit($project->id, $request);
        } catch (DomainException $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }

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
