<?php

namespace App\Console\Commands\Search;

use App\Models\Projects\Project;
use App\Models\User;
use App\Services\Search\FavoritesIndexerService;
use App\Services\Search\ProjectsIndexerService;
use Illuminate\Console\Command;

class IndexCommand extends Command
{

    protected $signature = 'search:index';

    private $projectsIndexer;
    private $favoritesIndexer;

    public function __construct(ProjectsIndexerService $projectsIndexer, FavoritesIndexerService $favoritesIndexer)
    {
        parent::__construct();

        $this->projectsIndexer = $projectsIndexer;
        $this->favoritesIndexer = $favoritesIndexer;
    }

    public function handle()
    {

        $this->indexProjects();
        $this->indexFavorites();

        $this->info('Projects have been successfully indexed');

        return true;
    }

    public function indexProjects() {

        $this->projectsIndexer->clear();

        foreach (Project::active()->orderBy('id')->cursor() as $project) {
            $this->projectsIndexer->index($project);
        }

    }

    public function indexFavorites() {

        $this->favoritesIndexer->clear();

        foreach (User::active()->hasFavorites()->orderBy('id')->cursor() as $user) {
            $this->favoritesIndexer->index($user);
        }

    }
}
