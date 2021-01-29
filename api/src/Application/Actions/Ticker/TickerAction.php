<?php
declare(strict_types=1);

namespace App\Application\Actions\Ticker;

use App\Application\Actions\Action;
use App\Domain\Ticker\Ticker;
use Psr\Log\LoggerInterface;

abstract class TickerAction extends Action
{
    /**
     * @var ticker
     */
    protected $ticker;

    /**
     * @param LoggerInterface $logger
     * @param Ticker $ticker
     */
    public function __construct(LoggerInterface $logger, Ticker $ticker)
    {
        parent::__construct($logger);
        $this->ticker = $ticker;
    }
}
