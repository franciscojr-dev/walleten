<?php
declare(strict_types=1);

namespace App\Domain\Ticker;

use App\Domain\DomainException\DomainRecordNotFoundException;

class TickerNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The ticker you requested does not exist.';
}
