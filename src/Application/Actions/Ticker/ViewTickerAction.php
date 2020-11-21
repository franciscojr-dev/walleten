<?php
declare(strict_types=1);

namespace App\Application\Actions\Ticker;

use Psr\Http\Message\ResponseInterface as Response;

class ViewTickerAction extends TickerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $tickerId = (int) $this->resolveArg('id');
        $ticker = $this->ticker->find($tickerId);

        $this->logger->info("Ticker of id `${tickerId}` was viewed.");

        return $this->respondWithData($ticker);
    }
}
