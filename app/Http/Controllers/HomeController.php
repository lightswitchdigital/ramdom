<?php

namespace App\Http\Controllers;

use App\Models\Advice;
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

    public function advice() {
        $advice = Advice::paginate(env('ADVICE_PAGINATION'));

        return view('advice', compact('advice'));
    }
}
