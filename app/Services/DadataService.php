<?php


namespace App\Services;

use Http;

class DadataService
{
    private $token;

    public function __construct($token) {
        $this->token = $token;
    }

    public function getCityName($ip) {
        $res = $this->sendRequest($ip);

        return $res->location? $res->location->data->city : null;
    }

    public function getCityKladr($ip) {
        $res = $this->sendRequest($ip);

        return $res->location? $res->location->data->city_kladr_id : null;
    }


    private function sendRequest($ip) {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Token '.$this->token
        ])
            ->get('https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/address?ip='.$ip);

        return $response->object();
    }
}
