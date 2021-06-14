<?php
declare(strict_types=1);

namespace App\Domain\WalletTicker;

use App\Domain\DomainException\DomainRecordNotFoundException;

class WalletTickerNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The wallet you requested does not exist.';
}
