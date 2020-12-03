<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function about() {
        return view('about');
    }

    public function faq() {
        return view('faq');
    }

    public function advice() {
        return view('advice');
    }
}
