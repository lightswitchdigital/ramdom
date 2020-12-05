<?php


namespace App\Services\Projects;

use App\Http\Requests\Admin\Projects\CreateRequest;
use App\Http\Requests\Admin\Projects\EditRequest;
use App\Http\Requests\Projects\BuyRequest;
use App\Models\Projects\Attribute;
use App\Models\Projects\Project;
use App\Models\Projects\Purchase\PurchaseAttribute;
use App\Models\Projects\Purchase\PurchasedProject;
use App\Models\User;
use DB;
use Illuminate\Support\Str;
use Storage;

class ProjectsService
{

    public function buy($user_id, $project_id, BuyRequest $request) {

        $user = $this->getUser($user_id);
        $project = $this->getProject($project_id);

        DB::transaction(function() use($user, $project, $request) {

            $purchased_project = PurchasedProject::make([
                'data' => '',
                'price' => $project->price
            ]);

            $purchased_project->user()->associate($user);
            $purchased_project->project()->associate($project);

            $purchased_project->save();

            foreach (PurchaseAttribute::all() as $attribute) {
                $value = $request['purchase_attributes'][$attribute->id] ?? null;
                if (!empty($value)) {
                    $purchased_project->values()->create([
                        'attribute_id' => $attribute->id,
                        'value' => $value
                    ]);
                }
            }

            return $purchased_project;

        });
    }

    public function create(CreateRequest $request): Project {

        return DB::transaction(function () use ($request) {

            $project = Project::create([
                'title' => $request['title'],
                'slug' => Str::slug($request['title']),
                'description' => $request['description'],
                'price' => $request['price'],
                'status' => Project::STATUS_ACTIVE
            ]);

            foreach ($request['images'] as $file) {
                $project->images()->create([
                    'file' => $file->store('projects', 'public')
                ]);
            }

            foreach (Attribute::all() as $attribute) {
                $value = $request['attributes'][$attribute->id] ?? null;
                if (!empty($value)) {
                    $project->values()->create([
                        'attribute_id' => $attribute->id,
                        'value' => $value
                    ]);
                }
            }

            return $project;

        });

    }

    public function edit($id, EditRequest $request) {
        $project = $this->getProject($id);

        DB::transaction(function() use ($request, $project) {
            $project->values()->delete();
            foreach (Attribute::all() as $attribute) {
                $value = $request['attributes'][$attribute->id] ?? null;
                if (!empty($value)) {
                    $project->values()->create([
                        'attribute_id' => $attribute->id,
                        'value' => $value,
                    ]);
                }
            }
            if ($request['images']) {
                foreach ($project->images as $image) {
                    Storage::disk('public')->delete($image->file);
                }
                $project->images()->delete();
                foreach ($request['images'] as $file) {
                    $project->images()->create([
                        'file' => $file->store('projects', 'public')
                    ]);
                }
            }

            $project->update($request->only([
                'title', 'description', 'price'
            ]));
        });
    }

    public function remove($id) {
        $project = $this->getProject($id);
        $project->delete();
    }

    public function getUser($id): User
    {
        return User::findOrFail($id);
    }

    public function getProject($id): Project
    {
        return Project::findOrFail($id);
    }
}
