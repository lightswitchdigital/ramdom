<?php


namespace App\Services\Projects;

use GuzzleHttp\Client;

class SmetaGateway
{

    public function calculatePrice($data)
    {

        $url = 'http://' . env('SMETA_HOST') . '/api/v1/calculate';

        $client = new Client();
        $res = $client->post(
            $url,
            array(
                'form_params' => $data
            )
        );

        return match ($res->getStatusCode()) {
            200 => $res->getBody()->getContents(),
            default => null,
        };
    }

}
