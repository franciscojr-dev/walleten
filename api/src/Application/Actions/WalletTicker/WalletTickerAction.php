<?php
declare(strict_types=1);

namespace App\Application\Actions\WalletTicker;

use App\Application\Actions\Action;
use App\Domain\WalletTicker\WalletTicker;
use Psr\Log\LoggerInterface;

abstract class WalletTickerAction extends Action
{
    /**
     * @var walletTicker
     */
    protected $walletTicker;

    /**
     * @param LoggerInterface $logger
     * @param WalletTicker $walletTicker
     */
    public function __construct(LoggerInterface $logger, WalletTicker $walletTicker)
    {
        parent::__construct($logger);
        $this->walletTicker = $walletTicker;
    }
}
