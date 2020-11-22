<?php
declare(strict_types=1);

namespace App\Domain\Index;

use App\Domain\DomainException\DomainRecordNotFoundException;

class IndexNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The index you requested does not exist.';
}
