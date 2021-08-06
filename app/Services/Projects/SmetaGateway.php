<?php


namespace App\Services\Projects;

use Illuminate\Support\Facades\Http;

class SmetaGateway
{

    public function calculatePrice($data)
    {
        $res = Http::get('http://' . env('SMETA_HOST') . '/api/v1/calculate', $data);

        return match ($res->status()) {
            200 => $res->body(),
            default => null,
        };
    }

}
