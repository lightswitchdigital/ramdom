<?php

namespace App\Console\Commands\Search;

use Elasticsearch\Common\Exceptions\BadRequest400Exception;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Illuminate\Console\Command;
use Elasticsearch\Client;

class InitCommand extends Command
{

    protected $signature = 'search:init';

    private $client;

//    public function __construct(Client $client)
//    {
//        parent::__construct();
//        $this->client = $client;
//    }

    public function handle()
    {

        $this->initProjects();
        $this->initFavorites();

        $this->info('ElasticSearch indices has been successfully set');

        return true;
    }

    public function initProjects() {

        try {
            $this->client->indices()->delete([
                'index' => 'projects'
            ]);
        }catch(Missing404Exception $e) {

        }

        $this->client->indices()->create([
            'index' => 'projects',
            'body' => [
                'mappings' => [
                    '_source' => [
                        'enabled' => true,
                    ],
                    'properties' => [
                        'id' => [
                            'type' => 'integer',
                        ],
                        'created_at' => [
                            'type' => 'date',
                        ],
                        'title' => [
                            'type' => 'text',
                        ],
                        'price' => [
                            'type' => 'integer'
                        ],
                        'description' => [
                            'type' => 'text',
                        ],
                        'status' => [
                            'type' => 'keyword',
                        ],
                        'values' => [
                            'type' => 'nested',
                            'properties' => [
                                'attribute' => [
                                    'type' => 'integer'
                                ],
                                'value_string' => [
                                    'type' => 'keyword',
                                ],
                                'value_int' => [
                                    'type' => 'integer',
                                ],
                            ],
                        ],
                    ],
                ],
                'settings' => [
                    'analysis' => [
                        'char_filter' => [
                            'replace' => [
                                'type' => 'mapping',
                                'mappings' => [
                                    '&=> and '
                                ],
                            ],
                        ],
                        'filter' => [
                            'word_delimiter' => [
                                'type' => 'word_delimiter',
                                'split_on_numerics' => false,
                                'split_on_case_change' => true,
                                'generate_word_parts' => true,
                                'generate_number_parts' => true,
                                'catenate_all' => true,
                                'preserve_original' => true,
                                'catenate_numbers' => true,
                            ],
                            'trigrams' => [
                                'type' => 'ngram',
                                'min_gram' => 4,
                                'max_gram' => 5,
                            ],
                        ],
                        'analyzer' => [
                            'default' => [
                                'type' => 'custom',
                                'char_filter' => [
                                    'html_strip',
                                    'replace',
                                ],
                                'tokenizer' => 'whitespace',
                                'filter' => [
                                    'lowercase',
                                    'word_delimiter',
                                    'trigrams',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

    }

    public function initFavorites() {

        try {
            $this->client->indices()->delete([
                'index' => 'favorites'
            ]);
        }catch(Missing404Exception $e) {

        }

        $this->client->indices()->create([
            'index' => 'favorites',
            'body' => [
                'mappings' => [
                    '_source' => [
                        'enabled' => true,
                    ],
                    'properties' => [
                        'id' => [
                            'type' => 'integer'
                        ],
                        'favorites' => [
                            'type' => 'nested',
                            'properties' => [
                                'id' => [
                                    'type' => 'integer'
                                ],
                                'title' => [
                                    'type' => 'keyword'
                                ],
                                'price' => [
                                    'type' => 'integer'
                                ]
                            ],
                        ],
                    ],
                ],
            ],
        ]);

    }
}
