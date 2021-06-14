<?php
declare(strict_types=1);

namespace App\Domain\IndexComposition;

use App\Domain\DomainException\DomainRecordNotFoundException;

class IndexCompositionNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The index composition you requested does not exist.';
}
