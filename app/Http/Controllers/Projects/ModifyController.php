<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\BuyRequest;
use App\Models\Projects\Project;
use App\Models\Projects\SavedProject;
use Auth;
use Illuminate\Http\Request;

class ModifyController extends Controller
{
    public function save(Project $project, BuyRequest $request) {
        $this->validate($request, [

        ]);

        $user = Auth::user();

        if ($savedProject = $user->savedProjects()->where('project_id', $project->id)->first()) {

            $savedProject->data = '';

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

    public function discard(Project $project) {
        $user = Auth::user();

        if($savedProject = $user->savedProjects()->where('project_id', $project->id)) {
            $savedProject->delete();
        }

        return response('', 204);
    }

    private function getCalculatedPrice(Project $project) {
        return $project->price;
    }
}
