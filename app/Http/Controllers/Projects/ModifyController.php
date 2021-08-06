<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Projects\Project;
use App\Models\Projects\SavedProject;
use App\Services\Projects\SmetaGateway;
use Auth;
use Illuminate\Http\Request;

class ModifyController extends Controller
{

    private $smeta;

    public function __construct(SmetaGateway $smeta)
    {
        $this->smeta = $smeta;
    }

    public function save(Project $project, Request $request)
    {

        $this->validate($request, [

        ]);

        $user = Auth::user();

        if ($savedProject = $user->savedProjects()->where('project_id', $project->id)->first()) {

            $data = json_encode($request['editor_attributes'], JSON_UNESCAPED_UNICODE);

            $values = [];
            foreach ($request['purchase_attributes'] as $id => $attribute) {
                $values[$id] = $attribute;
            }
            $savedProject->values_data = $values;

            $savedProject->update();

            return response([
                'success' => true,
                'order_price' => $this->getCalculatedPrice($project)
            ]);
        }

        $savedProject = SavedProject::make([
            'data' => ''
        ]);

        $values = [];
        foreach ($request['purchase_attributes'] as $id => $attribute) {
            $values[$id] = $attribute;
        }
        $savedProject->values_data = $values;

        $savedProject->user()->associate($user);
        $savedProject->project()->associate($project);

        $savedProject->save();

        return response([
            'order_price' => $this->getCalculatedPrice($project)
        ]);
    }

    public function saveEditorData(Project $project, Request $request)
    {

        $this->validate($request, [

        ]);
        $user = Auth::user();

        if ($savedProject = $user->savedProjects()->where('project_id', $project->id)->first()) {

            $savedProject->update([
                'editor_data' => $request['editor_data']
            ]);

            return response([
                'success' => true,
                'order_price' => $this->getCalculatedPrice($project)
            ]);
        }

        $savedProject = SavedProject::make([
            'editor_data' => $request['editor_data']
        ]);

        $savedProject->user()->associate($user);
        $savedProject->project()->associate($project);

        $savedProject->save();

        return response([
            'order_price' => $this->getCalculatedPrice($project)
        ]);
    }

    public function discard(Project $project)
    {
        $user = Auth::user();

        if ($savedProject = $user->savedProjects()->where('project_id', $project->id)) {
            $savedProject->delete();
        }

        return response([
            'order_price' => $project->price
        ]);
    }

    private function getCalculatedPrice($data)
    {
        try {
            $price = $this->smeta->calculatePrice($data);
        } catch (\Exception $exception) {
            return 0;
        }

        return $price;
    }
}
