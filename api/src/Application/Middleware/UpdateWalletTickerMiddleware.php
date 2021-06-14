<?php
declare(strict_types=1);

namespace App\Application\Middleware;

use Slim\Routing\RouteContext;
use App\Domain\Wallet\Wallet;
use App\Domain\WalletTicker\WalletTicker;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class UpdateWalletTickerMiddleware implements Middleware
{
    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {   
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        $wallet_id = $route->getArgument('id');

        $wallet = WalletTicker::where('wallet_id', $wallet_id)->get();
        $wallt_status = [
            'total_avg' => '0.00',
            'total_balance' => '0.00',
            'total_stock' => '0.00',
            'total_fund' => '0.00',
            'profit' => '0.00',
            'variation' => '0.00',
            'variation_money' => '0.00',
        ];

        foreach ($wallet as $tmp) {
            foreach ($tmp->ticker as $tick) {
                $total_close = bcmul($tmp->amount, $tick->close, 2);
                $total_avg = bcmul($tmp->amount, $tmp->avg, 2);
                $wallt_status['total_balance'] = bcadd($wallt_status['total_balance'], $total_close, 2);
                $wallt_status['total_avg'] = bcadd($wallt_status['total_avg'], $total_avg, 2);
                
                $type = sprintf('total_%s', $tick->type);
                if (isset($wallt_status[$type])) {
                    $wallt_status[$type] = bcadd($wallt_status[$type], $total_close, 2);
                }

                $change_abs = bcmul($tmp->amount, $tick->change_abs, 4);
                $wallt_status['variation_money'] = bcadd($wallt_status['variation_money'], $change_abs, 2);
                $wallt_status['variation'] = bcdiv($wallt_status['variation_money'], $wallt_status['total_balance'], 6);
                $wallt_status['variation'] = bcmul($wallt_status['variation'], '100', 2);
            }
        }

        $wallt_status['profit'] = bcsub($wallt_status['total_balance'], $wallt_status['total_avg']);
        $wallt_status['profit'] = bcdiv($wallt_status['profit'], $wallt_status['total_avg'], 6);
        $wallt_status['profit'] = bcmul($wallt_status['profit'], '100', 2);
        
        Wallet::updateOrCreate(
            ['id' => $wallet_id],
            $wallt_status
        );

        return $handler->handle($request);
    }
}
