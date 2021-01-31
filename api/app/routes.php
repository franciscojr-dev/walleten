<?php
declare(strict_types=1);

use App\Application\Actions\Index\{ListIndexsAction};
use App\Application\Actions\Index\ViewIndexAction;
use App\Application\Actions\Ticker\ListTickersAction;
use App\Application\Actions\Ticker\ViewTickerAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\Wallet\ViewWalletAction;
use App\Application\Actions\WalletTicker\ViewWalletTickerAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->group('/indexs', function (Group $group) {
        $group->get('', ListIndexsAction::class);
        $group->get('/{name}', ViewIndexAction::class);
    });

    $app->group('/tickers', function (Group $group) {
        $group->get('', ListTickersAction::class);
        $group->get('/{name}', ViewTickerAction::class);
    });
    
    $app->group('/user', function (Group $group) {
        $group->get('/{id}', ViewUserAction::class);
    });
    
    $app->group('/wallet', function (Group $group) {
        $group->get('/{id}', ViewWalletAction::class);
        $group->get('/tickers/{id}', ViewWalletTickerAction::class);
    });
};
