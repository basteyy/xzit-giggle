<?php
/**
 * Xzit Giggle
 * 
 * This file `propel.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

/** Root defined? */
if (!defined('ROOT')) {
    define('ROOT', __DIR__);
}

/** .env? */
if (!file_exists($env = ROOT . '/.env')) {
    die('Please create a .env file in the root directory (' . $env . '). You can use the .env.example file as a template.');
}

/** Autoloader */
if (!file_exists($autoload = __DIR__ . '/vendor/autoload.php')) {
    die('Please run composer install');
}

include $autoload;

/** Load .env */
(Dotenv\Dotenv::createImmutable(ROOT))->safeLoad();

/** Check if propels log folder exists and create it, if not */
if (!is_dir($log = CACHE . '/propel')) {
    mkdir($log, CACHE_FOLDER_PERMISSIONS, true);
}

/** Check if database data exists */
if (!isset($_ENV['DB_HOST']) || !isset($_ENV['DB_PORT']) || !isset($_ENV['DB_NAME']) || !isset($_ENV['DB_USER']) || !isset($_ENV['DB_PASSWORD'])) {
    die('Please check your .env file. You need to set DB_HOST, DB_PORT, DB_NAME, DB_USER and DB_PASSWORD.');
}

return [
    'propel' => [
        'runtime'   => [
            'log' => [
                'defaultLogger' => [
                    'type'  => 'stream',
                    'path'  => $log . '/propel.log',
                    'level' => 100
                ]
            ]
        ],
        'paths'     => [
            'schemaDir'    => ROOT . '/src/Config/Propel/Schema',
            'migrationDir' => ROOT . '/src/Config/Propel/Generated-migrations',
            'sqlDir'       => ROOT . '/src/Config/Propel/Generated-sql',
            'phpConfDir'   => ROOT . '/src/Config/Propel/Generated-conf',
            'phpDir'       => ROOT . '/src/Models',
        ],
        'database'  => [
            'connections' => [
                'default' => [
                    'adapter'  => 'mysql',
                    'dsn'      => 'mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'],
                    'user'     => $_ENV['DB_USER'],
                    'password' => $_ENV['DB_PASSWORD'],
                    'settings' => [
                        'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4',
                    ]
                ]
            ]
        ],
        'generator' => [
            'defaultConnection'    => 'default',
            'connections'          => ['default'],
            'namespaceAutoPackage' => false,
            'targetPackage'        => ROOT . '/src/Models/',
        ]
    ]
];
