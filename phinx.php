<?php
declare(strict_types=1);

use DI\ContainerBuilder;

require __DIR__ . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$settings = require __DIR__ . '/app/settings.php';
$settings($containerBuilder);

$container = $containerBuilder->build();

$config_db = $container->get('settings')['db'];

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'production',
        'production' => [
            'adapter' => $config_db['driver'],
            'host' => $config_db['host'],
            'name' => $config_db['database'],
            'user' => $config_db['username'],
            'pass' => $config_db['password'],
            'port' => '3306',
            'charset' => $config_db['charset'],
            'collation' => $config_db['collation'],
        ],
    ],
    'version_order' => 'creation'
];
