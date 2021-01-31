<?php
declare(strict_types=1);

namespace App\Application\Actions\Wallet;

use Psr\Http\Message\ResponseInterface as Response;

class ViewWalletAction extends WalletAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $walletId = $this->resolveArg('id');
        $wallet = $this->wallet->where('id', $walletId)->get();

        $this->logger->info("Wallet of id `${walletId}` was viewed.");

        return $this->respondWithData($wallet);
    }
}
