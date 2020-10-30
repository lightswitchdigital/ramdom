<?php


namespace App\Services\Search;

use App\Models\Project;
use Elasticsearch\Client;
use stdClass;

class ProjectsIndexerService
{
    private $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function clear() {
        $this->client->deleteByQuery([
            'index' => 'projects',
            'body' => [
                'query' => [
                    'match_all' => new stdClass()
                ]
            ]
        ]);
    }

    public function index(Project $project) {
        $this->client->index([
            'index' => 'projects',
            'id' => $project->id,
            'body' => [
                'id' => $project->id,
                'created_at' => $project->created_at,
                'title' => $project->title,
//                'description' => $project->description,
//                'status' => $project->status,
//                'values' => array_map(function (Value $value) {
//
//                }, )
            ]
        ]);
    }

    public function remove(Project $project) {
        $this->client->delete([
            'index' => 'projects',
            'id' => $project->id
        ]);
    }
}
