<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Services\DadataService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request, DadataService $service)
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

    public function discounts() {
        return view('discounts');
    }
}
