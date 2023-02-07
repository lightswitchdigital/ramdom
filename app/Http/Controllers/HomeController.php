<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Services\DadataService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request, DadataService $service)
    {
        $calculator = json_decode(file_get_contents(public_path('internal/calculator.json')), true);
        $rate = $calculator['rate'];
        $settings = json_decode(file_get_contents(public_path('internal/main.json')), true);

        return view('index', compact('rate', 'settings'));
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
