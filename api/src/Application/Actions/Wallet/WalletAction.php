<?php
declare(strict_types=1);

namespace App\Application\Actions\Wallet;

use App\Application\Actions\Action;
use App\Domain\Wallet\Wallet;
use Psr\Log\LoggerInterface;

abstract class WalletAction extends Action
{
    /**
     * @var wallet
     */
    protected $wallet;

    /**
     * @param LoggerInterface $logger
     * @param Wallet $wallet
     */
    public function __construct(LoggerInterface $logger, Wallet $wallet)
    {
        parent::__construct($logger);
        $this->wallet = $wallet;
    }
}
