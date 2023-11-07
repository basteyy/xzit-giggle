<?php
/**
 * Xzit Giggle
 * 
 * This file `kernel.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

/**
 * This is the kernel.php - the magic starts here. This file is the entrypoint for the application.
 */

use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;

/** Jep, nobody wants to know that kind of information later */
define('START_TIME', microtime(true));
define('START_MEMORY', memory_get_usage());

/** Root */
define("ROOT", dirname(__DIR__));

/** Debug var */

if (!defined('DEBUG')) {
    define('DEBUG', true);
}

if (DEBUG) {
    ini_set('display_errors', "1");
    ini_set('display_startup_errors', "1");
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', "0");
    ini_set('display_startup_errors', "0");
    error_reporting(0);
}

/** Autoloader */
if (!file_exists($autoloader = ROOT . '/vendor/autoload.php')) {
    die('Please run `composer install` first!');
}

include $autoloader;

/** Load .env */
(Dotenv\Dotenv::createImmutable(ROOT))->safeLoad();

/** Define locales */
date_default_timezone_set($_ENV['TIMEZONE'] ?? 'Europe/Berlin');
mb_internal_encoding($_ENV['ENCODING'] ?? 'UTF-8');
setlocale(LC_TIME, $_ENV['LC_TIME'] ?? 'de_DE', $_ENV['LC_TIME_ENCODING'] ?? 'de_DE.UTF-8');

/** Load the config */
$config = require ROOT . '/src/Config/config.php';

/** Create the app */
$di = new \DI\Container();

/** Cache folder exists? */
if (!is_dir(CACHE)) {
    mkdir(CACHE, CACHE_FOLDER_PERMISSIONS, true);
}

$builder = new ContainerBuilder();

if (!DEBUG) {
    $builder->enableCompilation(CACHE . '/php-di.cache');
}

/** Load the definitions */
if (!file_exists($definitions = ROOT . '/src/Config/definitions.php')) {
    die('Please run `composer install` first!');
}

$builder->addDefinitions($definitions);

/** Build the container */
$container = $builder->build();

/** Create the app */
$app = Bridge::create($container);

/** Load the middlewares */
if (!file_exists($middlewares = ROOT . '/src/Config/middlewares.php')) {
    throw new Exception('Middlewares not found (' . $middlewares . ')');
}

(include $middlewares)($app);

/** Database in case setup finished */
if (isSetUp()) {
    /** Load the database */
    if (!file_exists($database = ROOT . '/src/Config/database.php')) {
        throw new Exception('Database not found (' . $database . ')');
    }

    include $database;
}

if (!file_exists($routes = ROOT . '/src/Config/' . (!isSetUp()? 'setup_' : '' ) . 'routes.php')) {
    throw new Exception('Routes not found (' . $routes . ')');
}

/** In non-DEBUG Mode, cache the routing data */
if (!DEBUG) {
    $routeCollector = $app->getRouteCollector();
    $routeCollector->setCacheFile(CACHE . '/' . basename($routes, '.php') . '.cache');
}

(include $routes)($app);

$app->run();