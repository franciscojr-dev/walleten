<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Routines\B3;

use GuzzleHttp\Client;
use App\Domain\Ticker\Ticker;

$columns = [
    'name',
    'description',
    'type',
    'open',
    'high',
    'close',
    'low',
    'change',
    'change_abs'
];

$client = new Client();
$response = $client->request(
    'POST',
    'https://scanner.tradingview.com/brazil/scan',
    [
        'json' => [
            'columns' => $columns,
            'range' => [
                0,
                2000
            ],
            'symbols' => [
                'tickers' => []
            ],
            'sort' => [
                'sortBy' => 'name',
                'sortOrder' => 'asc'
            ],
        ]
    ]
);

$data = $response->getBody()->getContents();
if (!empty($data)) {
    $data = json_decode($data, true);

    foreach ($data['data'] as $values) {
        try {
            $insert = array_combine($columns, $values['d']);
            $insert = array_filter($insert, function($v, $k) {
                return !empty($v);
            }, \ARRAY_FILTER_USE_BOTH);

            Ticker::updateOrCreate(
                ['name' => $insert['name']],
                $insert
            );
        } catch(\PDOException $e) {
            echo $e->getMessage();
            echo PHP_EOL;
            print_r($insert);
            break;
        }
    }
}
