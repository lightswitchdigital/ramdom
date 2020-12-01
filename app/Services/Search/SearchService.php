<?php


namespace App\Services\Search;

use App\Http\Requests\Projects\SearchRequest;
use App\Models\Projects\Project;
use Elasticsearch\Client;
use Illuminate\Database\Query\Expression;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchService
{
    private $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function searchProjects(SearchRequest $request, $perPage, $page): LengthAwarePaginator {

        $values = array_filter((array)$request->input('attrs'), function($value) {
            return !empty($value['equals']) || !empty($value['from']) || !empty($value['to']);
        });

        $searchArray = [
            'index' => 'projects',
            'body' => [
                '_source' => ['id'],
                'from' => ($page - 1) * $perPage,
                'size' => $perPage,
                'sort' => empty($request['text']) ? [
                    ['created_at' => ['order' => 'desc']],
                ] : [],
                'query' => [
                    'bool' => [
                        'must' => array_merge(
                            [
                                ['term' => ['status' => Project::STATUS_ACTIVE]],
                            ],
                            array_filter([
                                !empty($request['text']) ? ['multi_match' => [
                                    'query' => $request['text'],
                                    'fields' => [ 'title^3' ]
                                ]] : false,
                            ]),
                            array_map(function ($value, $id) {
                                return [
                                    'nested' => [
                                        'path' => 'values',
                                        'query' => [
                                            'bool' => [
                                                'must' => array_values(array_filter([
                                                    ['match' => ['values.attribute' => $id]],
                                                    !empty($value['equals']) ? ['match' => ['values.value_string' => $value['equals']]] : false,
                                                    !empty($value['from']) ? ['range' => ['values.value_int' => ['gte' => $value['from']]]] : false,
                                                    !empty($value['to']) ? ['range' => ['values.value_int' => ['lte' => $value['to']]]] : false,
                                                ])),
                                            ],
                                        ],
                                    ],
                                ];
                            }, $values, array_keys($values))
                        )
                    ],
                ],
            ]
        ];
        $response = $this->client->search($searchArray);

        $ids = array_column($response['hits']['hits'], '_id');

        if ($ids) {
            $items = Project::whereIn('id', $ids)
                ->orderBy(new Expression('FIELD(id,' . implode(',', $ids) . ')'))
                ->get();
            $pagination = new LengthAwarePaginator($items, $response['hits']['total']['value'], $perPage, $page);
        }else {
            $pagination = new LengthAwarePaginator([], 0, $perPage, $page);
        }

        return $pagination;
    }

    public function searchRaw($searchArray) {
        $response = $this->client->search($searchArray);

        $hits = $response['hits']['hits'];

        return $hits;
    }
}
