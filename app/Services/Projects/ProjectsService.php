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
use Artisan;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Storage;

class ProjectsService
{
    private $pdf;

    public function __construct(\Barryvdh\DomPDF\PDF $PDF)
    {
        $this->pdf = $PDF;
    }

    public function buy($user_id, $project_id, BuyRequest $request)
    {

        $user = $this->getUser($user_id);
        $project = $this->getProject($project_id);

        $savedProject = $user->savedProjects()->where('project_id', $project->id)->first();

        if ($user->balance < $project->price) {
            throw new \DomainException('Недостаточно средств на балансе');
        }

        DB::transaction(function () use ($user, $project, $request, $savedProject) {

            $purchased_project = PurchasedProject::make([
                'data' => $savedProject ? $savedProject->editor_data : $request['editor_attributes'],
                'price' => $project->price,
                'building_price' => $savedProject ? $savedProject->building_price : 0
            ]);

            $purchased_project->user()->associate($user);
            $purchased_project->project()->associate($project);

            $purchased_project->save();

            $user->withholdFromBalance($project->price);

            foreach (PurchaseAttribute::all() as $attribute) {
                $value = $request['purchase_attributes'][$attribute->id] ?? null;
                if (!empty($value)) {
                    $purchased_project->values()->create([
                        'attribute_id' => $attribute->id,
                        'value' => $value
                    ]);
                }
            }

            $docsPaths = $this->composeDocs($user, $project);

            foreach ($docsPaths as $documentPath) {
                $purchased_project->documents()->create([
                    'file' => $documentPath
                ]);
            }

//            SendEmailJob::dispatch($user, new DocumentsMail($user, $purchased_project, $docsPaths));

            return $purchased_project;

        });
    }

    public function create(CreateRequest $request): Project {

        $project = DB::transaction(function () use ($request) {

            $slug = Str::slug($request['title']);

            $project = Project::create([
                'title' => $request['title'],
                'slug' => $slug,
                'description' => $request['description'],
                'price' => $request['price'],
                'status' => Project::STATUS_ACTIVE,
            ]);

            $editor_attributes = $this->generateJsonFile($request);
            $name = $project->slug . '.json';
            $path = join("/", ['project-attributes', Carbon::now()->format('d-m-Y'), $name]);
            Storage::disk('public')->put($path, $editor_attributes);

            $docsPath = join("/", [resource_path('views'), "documents", $slug]);
            mkdir($docsPath);

            $project->update([
                'file' => $path
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

        Artisan::call('search:index');

        return $project;
    }

    public function composeDocs(User $user, Project $project)
    {
        $docs = [];

        $docsPath = join("/", [resource_path('views'), "documents", $project->slug]);
        foreach (File::allFiles($docsPath) as $file) {
            $docs[] = "documents." . $project->slug . "." . explode(".", $file->getBasename())[0];
        }

        $paths = [];
        foreach ($docs as $document) {
            $output = $this->pdf
                ->setPaper('a4', 'landscape')
                ->loadView($document, ['greeting' => 'hello'])
                ->output();

            $path = 'userdocuments/' . $user->id . "/" . Carbon::now()->format('d-m-Y') . "/" . $project->slug . ".pdf";
            Storage::disk('public')->put($path, $output);

            $paths[] = $path;
        }

        return $paths;

    }

    public function edit($id, EditRequest $request) {
        $project = $this->getProject($id);

        DB::transaction(function() use ($request, $project) {

            Storage::disk('public')->delete($project->file);

            $editor_attributes = $this->generateJsonFile($request);
            $name = $project->slug . '.json';
            $path = join("/", ['project-attributes', Carbon::now()->format('d-m-Y'), $name]);
            Storage::disk('public')->put($path, $editor_attributes);

            $project->update([
                'file' => $path
            ]);

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

    /**
     * Generates a json file with editor attributes
     * for this projects
     *
     * @param Request $request
     * @return string
     */
    public function generateJsonFile(Request $request): string
    {
        return json_encode($request['editor_attributes'], JSON_UNESCAPED_UNICODE);
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
