<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index() {
        return view('profile.projects.index');
    }
}
