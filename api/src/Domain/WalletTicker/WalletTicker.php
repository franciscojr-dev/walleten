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

    public function ticker()
    {
        return $this->belongsToMany(
            'App\Domain\Ticker\Ticker',
            'App\Domain\WalletTicker\WalletTicker', 
            'id', 
            'ticker_id'
        )
        ->as('position')
        ->withPivot('amount', 'avg');
    }
}
