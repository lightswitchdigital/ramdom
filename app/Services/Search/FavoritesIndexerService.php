<?php


namespace App\Services\Search;

use App\Models\Projects\Project;
use App\Models\User;
use Elasticsearch\Client;
use stdClass;

class FavoritesIndexerService
{
    private $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function clear() {
        $this->client->deleteByQuery([
            'index' => 'favorites',
            'body' => [
                'query' => [
                    'match_all' => new stdClass()
                ]
            ]
        ]);
    }

    public function index(User $user) {
        $this->client->index([
            'index' => 'favorites',
            'id' => $user->id,
            'body' => [
                'id' => $user->id,
                'favorites' => array_map(function (Project $project) {
                    return [
                        'id' => $project->id,
                        'title' => $project->title,
                        'price' => $project->price
                    ];
                }, $user->favorites()->getModels())
            ]
        ]);
    }
}
