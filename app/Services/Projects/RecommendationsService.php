<?php


namespace App\Services\Projects;


use App\Models\Projects\Project;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Collection;
use Str;

class RecommendationsService
{
    private $limit;

    public function __construct() {
        $this->limit = 10;
    }

    public function getRecommendations($project_id): Collection
    {
        return Project::all();
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
