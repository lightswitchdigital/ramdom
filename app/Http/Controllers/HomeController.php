<?php

namespace App\Http\Controllers;

use App\Models\FAQ;

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
        $faq = FAQ::all();

        return view('faq', compact('faq'));
    }


}
