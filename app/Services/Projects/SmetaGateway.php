<?php


namespace App\Services\Projects;

use App\Models\Projects\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmetaGateway
{

    public function calculatePrice(Request $request)
    {
        $query = $request->all();
        $res = Http::get('http://' . env('SMETA_HOST') . '/api/v1/calculate', $query);

        return match ($res->status()) {
            200 => $res->body(),
            default => null,
        };
    }

}
