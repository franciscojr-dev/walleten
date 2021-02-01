<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Routines\Periodic;

require __DIR__ . '/../bootstrap.php';

use App\Domain\Wallet\Wallet;
use App\Domain\WalletTicker\WalletTicker;

/*
$wallet = WalletTicker::where('wallet_id', 1)->get();

foreach ($wallet as $tmp) {
    foreach ($tmp->ticker as $tick) {
        printf(
            "TickerId %d - TickerName %s Amount %d\n",
            $tick->id, $tick->name, $tmp->amount
        );
    }
}
*/




/*
$wallet = Wallet::where('id', 1)->get();

foreach ($wallet as $tmp) {
    var_dump($tmp);
}
*/


/*
$wallet_id = 1;
$wallet = WalletTicker::where('wallet_id', $wallet_id)->get();
$wallt_status = [
    'total_avg' => '0.00',
    'total_balance' => '0.00',
    'total_stock' => '0.00',
    'total_fund' => '0.00',
    'profit' => '0.00',
    'variation' => '0.00',
    'variation_money' => '0.00',
];

foreach ($wallet as $tmp) {
    foreach ($tmp->ticker as $tick) {
        printf(
            "TickerId %d - TickerName %s Amount %d\n",
            $tick->id, $tick->name, $tmp->amount
        );

        $total_close = bcmul($tmp->amount, $tick->close, 2);
        $total_avg = bcmul($tmp->amount, $tmp->avg, 2);
        $wallt_status['total_balance'] = bcadd($wallt_status['total_balance'], $total_close, 2);
        $wallt_status['total_avg'] = bcadd($wallt_status['total_avg'], $total_avg, 2);
        
        $type = sprintf('total_%s', $tick->type);

        if (isset($wallt_status[$type])) {
            $wallt_status[$type] = bcadd($wallt_status[$type], $total_close, 2);
        }

        $change_abs = bcmul($tmp->amount, $tick->change_abs, 2);
        $wallt_status['variation'] = bcadd($wallt_status['variation'], $tick->change, 2);
        $wallt_status['variation_money'] = bcadd($wallt_status['variation_money'], $change_abs, 2);
    }
}

$wallt_status['profit'] = bcsub($wallt_status['total_balance'], $wallt_status['total_avg']);
$wallt_status['profit'] = bcdiv($wallt_status['profit'], $wallt_status['total_avg'], 6);
$wallt_status['profit'] = bcmul($wallt_status['profit'], '100', 2);

try {
    Wallet::updateOrCreate(
        ['id' => $wallet_id],
        $wallt_status
    );
} catch(\PDOException $e) {
    echo $e->getMessage();
    echo PHP_EOL;
    print_r($wallt_status);
}
*/