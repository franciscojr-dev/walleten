<?php
declare(strict_types=1);

namespace App\Domain\Ticker;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Ticker extends Eloquent
{
    protected $table = 'ticker';
    protected $fillable = ['ticker','type','close'];
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];
}
