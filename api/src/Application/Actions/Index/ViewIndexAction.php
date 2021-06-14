<?php
declare(strict_types=1);

namespace App\Application\Actions\Index;

use Psr\Http\Message\ResponseInterface as Response;

class ViewIndexAction extends IndexAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $indexName = $this->resolveArg('name');
        $index = $this->index->where('name', $indexName)->get();

        $this->logger->info("Index of name `${indexName}` was viewed.");

        return $this->respondWithData($index);
    }
}
