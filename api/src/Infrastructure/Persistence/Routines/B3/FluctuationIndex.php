<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Routines\B3;

use App\Domain\Index\Index;
use App\Domain\IndexComposition\IndexComposition;
use App\Domain\Ticker\Ticker;
use GuzzleHttp\Client;

$client = new Client();

$list_index = [
    'IBOV',
    'IFIX'
];

foreach ($list_index as $index) {
    $response = $client->request('GET', 'http://cotacao.b3.com.br/mds/api/v1/instrumentQuotation/'.$index);
    
    $data = $response->getBody()->getContents();
    if (!empty($data)) {
        $data = json_decode($data, true);
        $info = $data['Trad'][0]['scty']['SctyQtn'];
        
        $index = [
            'name' => $index,
            'open' => $info['opngPric'],
            'high' => $info['maxPric'],
            'close' => $info['curPrc'],
            'low' => $info['minPric'],
            'change' => round($info['prcFlcn'], 2),
            'change_abs' => bcsub((string) $info['curPrc'], (string) $info['opngPric'], 2),
        ];
        unset($history);
        unset($history_price);
    }
    
    $index = array_filter($index, function($v, $k) {
        return !empty($v);
    }, \ARRAY_FILTER_USE_BOTH);

    try {
        Index::updateOrCreate(
            ['name' => $index['name']],
            $index
        );
    } catch(\PDOException $e) {
        echo $e->getMessage();
        echo PHP_EOL;
        print_r($index);
        break;
    }
}
