<?php
declare(strict_types=1);

namespace App\Domain\WalletTicker;

use Illuminate\Database\Eloquent\Model as Eloquent;

class WalletTicker extends Eloquent
{
    protected $table = 'wallet_ticker';
    protected $fillable = [
        'ticker_id',
        'wallet_id',
        'amount',
        'avg',
    ];
    protected $hidden = ['wallet_id'];
}
