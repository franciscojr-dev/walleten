<?php
declare(strict_types=1);

namespace App\Application\Actions\Index;

use Psr\Http\Message\ResponseInterface as Response;

class ListIndexsAction extends IndexAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $indexs = $this->index->all();

        $this->logger->info("Indexs list was viewed.");

        return $this->respondWithData($indexs);
    }
}
