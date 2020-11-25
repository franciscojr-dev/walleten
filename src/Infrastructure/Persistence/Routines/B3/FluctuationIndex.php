<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Routines\B3;

use App\Domain\Index\Index;
use App\Domain\IndexComposition\IndexComposition;
use App\Domain\Ticker\Ticker;
use GuzzleHttp\Client;

$client = new Client();

$list_index = Index::all()->toArray();

foreach ($list_index as $index) {
    $response = $client->request('GET', 'http://cotacao.b3.com.br/mds/api/v1/DailyFluctuationHistory/'.$index['name']);
    
    $data = $response->getBody()->getContents();
    if (!empty($data)) {
        $data = json_decode($data, true);

        $history = $data['TradgFlr']['scty']['lstQtn'];
        $last_history = end($history);
        
        $history_price = [];
        array_walk($history, function($v, $k) use (&$history_price) {
            $history_price[] = $v['closPric'];
        });

        $index = array_merge($index, [
            'open' => $history[0]['closPric'],
            'high' => max($history_price),
            'close' => $last_history['closPric'],
            'low' => min($history_price),
            'change' => round($last_history['prcFlcn'], 2),
            'change_abs' => bcsub((string) $last_history['closPric'], (string) $history[0]['closPric'], 2),
        ]);
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
