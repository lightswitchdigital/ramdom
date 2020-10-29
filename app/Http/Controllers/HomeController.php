<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
}
