<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Auth;

class FavoritesController extends Controller
{
    public function index() {
        $user = Auth::user();
        $projects = $user->favorites()->paginate(8);

        return view('profile.favorites.index', compact('projects'));
    }
}
