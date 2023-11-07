<?php
/**
 * Xzit Giggle
 *
 * This file `database.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Propel;

/** Check if propels log folder exists and create it, if not */
if (!is_dir($log = CACHE . '/propel')) {
    mkdir($log, CACHE_FOLDER_PERMISSIONS, true);
}

$serviceContainer = Propel::getServiceContainer();
$serviceContainer->checkVersion(2);
$serviceContainer->setAdapterClass('default', 'mysql');
$manager = new ConnectionManagerSingle('default');
$manager->setConfiguration([
    'dsn'      => 'mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'settings' => [
        'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4',
        'queries' => []
    ],

    'classname'   => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
    'model_paths' =>
        [
            0 => 'src',
            1 => 'vendor',
        ]
]);
$serviceContainer->setConnectionManager($manager);
$serviceContainer->setDefaultDatasource('default');
$serviceContainer->setLoggerConfiguration('defaultLogger', array(
    'type'  => 'stream',
    'path'  => $log . '/propel.log',
    'level' => 100,
));

if (!file_exists($databases = ROOT . '/src/Config/Propel/Generated-conf/loadDatabase.php')) {
    throw new RuntimeException('Please run `composer propel:build` first!');
}

include $databases;