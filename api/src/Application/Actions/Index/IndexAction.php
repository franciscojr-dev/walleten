<?php
declare(strict_types=1);

namespace App\Application\Actions\Index;

use App\Application\Actions\Action;
use App\Domain\Index\Index;
use Psr\Log\LoggerInterface;

abstract class IndexAction extends Action
{
    /**
     * @var index
     */
    protected $index;

    /**
     * @param LoggerInterface $logger
     * @param Index $index
     */
    public function __construct(LoggerInterface $logger, Index $index)
    {
        parent::__construct($logger);
        $this->index = $index;
    }
}
