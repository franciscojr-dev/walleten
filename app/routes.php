<?php
declare(strict_types=1);

use App\Application\Actions\Ticker\ListTickersAction;
use App\Application\Actions\Ticker\ViewTickerAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->group('/tickers', function (Group $group) {
        $group->get('', ListTickersAction::class);
        $group->get('/{id}', ViewTickerAction::class);
    });
};
