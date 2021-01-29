<?php
declare(strict_types=1);

use DI\ContainerBuilder;

$path = __DIR__ . str_repeat('/../', 4);

require $path.'vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$settings = require $path.'app/settings.php';
$settings($containerBuilder);

$dependencies = require $path.'app/dependencies.php';
$dependencies($containerBuilder);

$container = $containerBuilder->build();
$container->get('db');
