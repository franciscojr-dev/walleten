<?php
declare(strict_types=1);

namespace App\Domain\Wallet;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Wallet extends Eloquent
{
    protected $table = 'wallet';
    protected $fillable = [
        'description',
        'primary',
        'user_id',
        'total_avg',
        'total_balance',
        'total_stock',
        'total_fund',
        'profit',
        'variation',
        'variation_money',
    ];
    protected $hidden = ['user_id'];
}
