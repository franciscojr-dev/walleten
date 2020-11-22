<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Routines\B3;

use App\Domain\Index\Index;
use App\Domain\IndexComposition\IndexComposition;
use App\Domain\Ticker\Ticker;

$list_index = Index::all()->toArray();

foreach ($list_index as $index) {
    $list_composition = IndexComposition::where('index_id', $index['id'])->get();

    $index = array_merge($index, [
        'open' => '0.00',
        'high' => '0.00',
        'close' => '0.00',
        'low' => '0.00',
        'change' => '0.00',
        'change_abs' => '0.00',
    ]);

    foreach ($list_composition as $composition) {
        $ticker = Ticker::where('name', $composition['name'])->first()->toArray();

        $index['open'] = bcadd(
            $index['open'],
            bcmul(
                number_format((float) $ticker['open'], 2),
                number_format((float) $composition['theoretical_qtd'], 2),
                2
            ),
            2
        );

        $index['high'] = bcadd(
            $index['high'],
            bcmul(
                number_format((float) $ticker['high'], 2),
                number_format((float) $composition['theoretical_qtd'], 2),
                2
            ),
            2
        );

        $index['close'] = bcadd(
            $index['close'],
            bcmul(
                number_format((float) $ticker['close'], 2),
                number_format((float) $composition['theoretical_qtd'], 2),
                2
            ),
            2
        );

        $index['low'] = bcadd(
            $index['low'],
            bcmul(
                number_format((float) $ticker['low'], 2),
                number_format((float) $composition['theoretical_qtd'], 2),
                2
            ),
            2
        );

        $index['change_abs'] = bcsub($index['close'], $index['open'], 2);
        $index['change'] = bcmul(bcdiv($index['change_abs'], $index['close'], 4), '100', 2);
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
