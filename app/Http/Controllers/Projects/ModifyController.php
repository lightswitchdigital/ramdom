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
            $savedProject->price = $this->getCalculatedPrice($request['editor_attributes']);

            $savedProject->update();

            return response([
                'success' => true,
                'order_price' => $this->getCalculatedPrice([])
            ]);
        }

        $savedProject = SavedProject::make([
            'editor_data' => null
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

        $price = $this->getCalculatedPrice($request->all());

        if ($savedProject = $user->savedProjects()->where('project_id', $project->id)->first()) {


            $savedProject->update([
                'editor_data' => $request->all(),
                'building_price' => $price
            ]);

            return response([
                'success' => true,
                'order_price' => $price
            ]);
        }

        $savedProject = SavedProject::make([
            'editor_data' => $request->all(),
            'values_data' => null,
            'building_price' => $price
        ]);

        $savedProject->user()->associate($user);
        $savedProject->project()->associate($project);

        $savedProject->save();

        return response([
            'success' => true,
            'order_price' => $price
        ]);
    }

    public function discard(Project $project)
    {
        $user = Auth::user();

        if ($savedProject = $user->savedProjects()->where('project_id', $project->id)) {
            $savedProject->delete();
        }

        return response([
            'success' => true,
            'order_price' => $project->price
        ]);
    }

    private function getCalculatedPrice($data)
    {
        return $this->smeta->calculatePrice($data);
    }
}
