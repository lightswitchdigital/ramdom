<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Services\Projects\SmetaGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EditorController extends Controller
{

    private SmetaGateway $gateway;

    public function __construct(SmetaGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function index(Request $request)
    {
        try {
            $price = $this->gateway->calculatePrice($request->all());
        } catch (\Exception $e) {
            File::put(base_path('editor.log'), $e->getMessage() . "\n");
        }

        return [
            'price' => $price
        ];

    }
}
