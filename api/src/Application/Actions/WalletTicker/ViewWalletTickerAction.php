<?php
declare(strict_types=1);

namespace App\Application\Actions\WalletTicker;

use Psr\Http\Message\ResponseInterface as Response;

class ViewWalletTickerAction extends WalletTickerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $walletId = $this->resolveArg('id');
        $walletTicker = $this->walletTicker->where('wallet_id', $walletId)->get();

        $this->logger->info("Wallet of id `${walletId}` was viewed.");

        return $this->respondWithData($walletTicker);
    }
}
