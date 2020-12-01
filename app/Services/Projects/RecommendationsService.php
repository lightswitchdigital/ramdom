<?php


namespace App\Services\Projects;


use App\Models\Projects\Project;
use App\Services\Search\SearchService;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Collection;

class RecommendationsService
{
    private $search;

    public function __construct(SearchService $search) {
        $this->search = $search;
    }

    public function getRecommendations($project_id): Collection
    {
        $project = $this->getProject($project_id);

        $hits = $this->search->searchRaw([
            'index' => 'favorites',
            'body' => [
                '_source' => ['favorites.id'],
                'from' => 0,
                'size' => 10,
                'query' => [
                    'nested' => [
                        'path' => 'favorites',
                        'query' => [
                            'match' => [
                                'favorites.id' => $project->id
                            ]
                        ]
                    ],
                ],
            ]
        ]);

        $favorites = [];
        foreach ($hits as $hit) {
            $items = array_column($hit['_source']['favorites'], 'id');
            foreach ($items as $item) {
                $favorites[] = $item;
            }
        }
        $ids = array_unique($favorites);
        if (($key = array_search($project->id, $ids)) !== false) {
            unset($ids[$key]);
        }

        $items = Project::whereIn('id', $ids)
            ->orderBy(new Expression('FIELD(id,' . implode(',', $ids) . ')'))
            ->get();


        return $items;
    }


    private function getProject($project_id): Project
    {
        return Project::findOrFail($project_id);
    }
}
