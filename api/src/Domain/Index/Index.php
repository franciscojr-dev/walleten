<?php
declare(strict_types=1);

namespace App\Domain\Index;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Index extends Eloquent
{
    protected $table = 'index';
    protected $fillable = [
        'name',
        'open',
        'high',
        'close',
        'low',
        'change',
        'change_abs',
    ];
}
