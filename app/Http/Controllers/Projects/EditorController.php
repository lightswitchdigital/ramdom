<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Projects\Project;
use App\Services\Projects\SmetaGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorController extends Controller
{

    private SmetaGateway $gateway;

    public function __construct(SmetaGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function index(Project $project, Request $request) {
        $price = $this->gateway->calculatePrice($project, $request);

        return [
            'price' => $price
        ];
    }
}
