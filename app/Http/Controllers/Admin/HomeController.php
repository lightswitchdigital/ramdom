<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    public function index()
    {
        $settings = json_decode(file_get_contents(public_path('internal/main.json')), true);

        return view('admin.index', compact('settings'));
    }

    public function saveSettings(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:100'],
            'text' => ['required', 'string', 'max:1000']
        ]);

        $data = json_encode($request->except('_token'));
        file_put_contents(public_path('internal/main.json'), $data);

        return redirect()->back()
            ->with('success', 'Данные изменены');
    }
}
