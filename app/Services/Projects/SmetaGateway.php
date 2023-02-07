<?php


namespace App\Services\Projects;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class SmetaGateway
{

    public function calculatePrice($data)
    {
        $url = 'http://' . env('SMETA_HOST') . '/api/v1/calculate';

        if (count($data) == 0) {
            $data = new \stdClass();
        }

        $pricelistValues = json_decode(file_get_contents(public_path('internal/pricelist-values.json')), true);
        if (count($pricelistValues) == 0) {
            $pricelistValues = new \stdClass();
        }

        $client = new Client();
        $res = $client->get(
            $url, [
                RequestOptions::JSON => [
                    'data' => $data,
                    'pricelist' => $pricelistValues
                ]
            ]
        );

        return match ($res->getStatusCode()) {
            200 => $res->getBody()->getContents(),
            default => null,
        };
    }

    public function getDocs($data, $pricelist, $path, $projectName, $logo, $companyInfo)
    {
        $url = 'http://' . env('SMETA_HOST') . '/api/v1/get-docs';

        $client = new Client();

//        dd($data, $pricelist);
        if (count($data) == 0) {
            $data = new \stdClass();
        }

        $payload = [
            'path' => $path,
            'projectName' => $projectName,
            'companyInfo' => $companyInfo,
            'logo' => $logo,
            'data' => $data,
            'pricelist' => $pricelist
        ];

        $res = $client->post(
            $url, [
                RequestOptions::JSON => $payload
            ]
        );

        return match ($res->getStatusCode()) {
            200 => $res->getBody()->getContents(),
            default => null,
        };
    }

}
