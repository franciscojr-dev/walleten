<?php
declare(strict_types=1);

namespace App\Application\Actions\Ticker;

use Psr\Http\Message\ResponseInterface as Response;

class ListTickersAction extends TickerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $tickers = $this->ticker->all();

        $this->logger->info("Tickers list was viewed.");

        return $this->respondWithData($tickers);
    }
}
