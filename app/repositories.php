<?php
declare(strict_types=1);

use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use App\Infrastructure\Persistence\Ticker\InDatabaseTickerRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        //TickerRepository::class => \DI\autowire(InDatabaseTickerRepository::class),
    ]);
};
