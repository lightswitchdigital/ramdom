<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projects\Project;
use Auth;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    public function add(Project $project) {
        $user = Auth::user();

        $user->addToFavorites($project->id);

        return response('', 204);
    }

    public function remove(Project $project) {
        $user = Auth::user();

        $user->removeFromFavorites($project->id);

        return response('', 204);
    }
}
