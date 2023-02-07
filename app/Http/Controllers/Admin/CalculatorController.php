<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        $calculator = json_decode(file_get_contents(public_path('internal/calculator.json')), true);
        $rate = $calculator['rate'];

        return view('admin.calculator.index', compact('rate'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'rate' => ['required', 'numeric', 'max:100']
        ]);

        $data = [
            'rate' => $request['rate']
        ];
        file_put_contents(public_path('internal/calculator.json'), json_encode($data));

        return redirect()->back()
            ->with('success', 'Успешно');
    }
}
