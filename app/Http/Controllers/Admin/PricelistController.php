<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PricelistController extends Controller
{
    public function index()
    {
        $pricelistValues = json_decode(file_get_contents(public_path('internal/pricelist-values.json')), true);

        $saveFile = [
            'data' => $pricelistValues
        ];

        return view('admin.pricelist.index', compact('saveFile'));
    }

    public function save(Request $request)
    {
        $this->validate($request, [

        ]);

        $data = json_encode($request->all());
        file_put_contents(public_path('internal/pricelist-values.json'), $data);

        return [
            'success' => true
        ];
    }
}
