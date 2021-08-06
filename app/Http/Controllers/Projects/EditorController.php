<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Services\Projects\SmetaGateway;
use Illuminate\Http\Request;

class EditorController extends Controller
{

    private SmetaGateway $gateway;

    public function __construct(SmetaGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function index(Request $request) {
        $price = $this->gateway->calculatePrice($request->all());

        return [
            'price' => $price
        ];
    }
}
