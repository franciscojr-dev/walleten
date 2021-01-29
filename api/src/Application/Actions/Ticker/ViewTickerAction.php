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
        $tickerName = $this->resolveArg('name');
        $ticker = $this->ticker->where('name', $tickerName)->get();

        $this->logger->info("Ticker of name `${tickerName}` was viewed.");

        return $this->respondWithData($ticker);
    }
}
