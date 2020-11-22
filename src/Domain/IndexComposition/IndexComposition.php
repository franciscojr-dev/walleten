<?php
declare(strict_types=1);

namespace App\Domain\IndexComposition;

use Illuminate\Database\Eloquent\Model as Eloquent;

class IndexComposition extends Eloquent
{
    protected $table = 'index_composition';
    protected $fillable = [
        'index_id',
        'name',
        'theoretical_qtd',
        'percentage',
    ];
}
