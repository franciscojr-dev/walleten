<?php
declare(strict_types=1);

namespace App\Domain\Ticker;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Ticker extends Eloquent
{
    protected $table = 'ticker';
    protected $fillable = [
        'name',
        'description',
        'type',
        'open',
        'high',
        'close',
        'low',
        'change',
        'change_abs',
    ];
}
