<?php


namespace App\Services\Projects;


use App\Models\Projects\Project;
use App\Services\Search\SearchService;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Collection;
use Str;

class RecommendationsService
{
    private $search;
    private $limit;

    public function __construct(SearchService $search) {
        $this->search = $search;
        $this->limit = env('RECOMMENDATIONS_COUNT');
    }

    public function getRecommendations($project_id): Collection
    {
        $project = $this->getProject($project_id);

        $salt = Str::random(10);
        $hits = $this->search->searchRaw([
            'index' => 'favorites',
            'body' => [
                '_source' => ['favorites.id'],
                'from' => 0,
                'size' => 50,
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
                'sort' => [
                    '_script' => [
                        'script' => '(doc["_id"].value + "'.$salt.'").hashCode()',
                        'type' => 'number',
                        'order' => 'asc'
                    ]
                ]
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


        // Getting missing recommendations if they're insufficient
        if (count($ids) < $this->limit) {

            $additional_ids = $this->getRandomIdsExcept($ids);

            $ids = array_merge($ids, $additional_ids);
        }

        // Checking if recommendations count are excessive
        if (count($ids) > $this->limit)
            $ids = array_rand($ids, $this->limit);

        $items = collect();

        if (!empty($ids)) {
            $items = Project::whereIn('id', $ids)
                ->inRandomOrder()
                ->with('images')
                ->with('values')
                ->get();
        }

        return $items;
    }


    private function getRandomIdsExcept($ids): array
    {
        $left = $this->limit - count($ids);

        $additional_ids = Project::select(['id', 'slug'])
            ->whereNotIn('id', $ids)
            ->inRandomOrder()
            ->limit($left)
            ->get()
            ->toArray();

        return array_column($additional_ids, 'id');
    }

    private function getProject($project_id): Project
    {
        return Project::findOrFail($project_id);
    }
}
