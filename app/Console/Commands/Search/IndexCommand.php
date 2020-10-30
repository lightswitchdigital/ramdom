<?php

namespace App\Console\Commands\Search;

use App\Models\Project;
use App\Services\Search\ProjectsIndexerService;
use Illuminate\Console\Command;

class IndexCommand extends Command
{

    protected $signature = 'search:index';

    private $service;

    public function __construct(ProjectsIndexerService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function handle()
    {
        $this->service->clear();

        foreach (Project::orderBy('id')->cursor() as $project) {
            $this->service->index($project);
        }

        $this->info('Projects have been successfully indexed');

        return true;
    }
}
