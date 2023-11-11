<?php
/**
 * Xzit Giggle
 *
 * This file `main.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

use Ahc\Cli\Application;
use Ahc\Cli\Exception\RuntimeException;
use Dotenv\Dotenv;

define('ROOT', dirname(__DIR__, 2));

/** Autoloader */
require_once ROOT . '/vendor/autoload.php';

/** Load .env */
$dotenv = Dotenv::createImmutable(ROOT);
$dotenv->load();

/**  */

if (!file_exists($database = ROOT . '/src/Config/database.php')) {
    throw new RuntimeException(sprintf('The database config file (%s) is missing!', $database));
}

include $database;

/** Load cli */
$app = new Application('Xzit Giggle - The CLI Tool', '1.0.0');

$app
    ->command('about', 'A few more information about this tool')
    ->action(function() use($app) {
        $app->io()->writer()->greenBgWhite('Xzit Giggle - The CLI Tool', true);
        $app->io()->writer()->info('This tool is a CLI tool for the Xzit Giggle project. Its the bridge between the frontend settings/work and the backend system settings. That menas, this cli will create system users, manage the domains and some other stuff. You need to setup a crontab (as root/sudo) to the major command `giggle sync`. See the <em>--help</em>> for more.', true);
    });

$app->add(new \basteyy\XzitGiggle\bin\SyncAll());

$app->group('users', function ($app) {
    $app->add(new \basteyy\XzitGiggle\bin\Users\SyncUsers());
    $app->add(new \basteyy\XzitGiggle\bin\Users\AddUsers());
    $app->add(new \basteyy\XzitGiggle\bin\Users\UpdateUsers());
    $app->add(new \basteyy\XzitGiggle\bin\Users\DeleteUsers());
});



$app->logo('   _  __      _ __     _______             __   
  | |/ /___  (_) /_   / ____(_)___ _____ _/ /__ 
  |   /_  / / / __/  / / __/ / __ `/ __ `/ / _ \
 /   | / /_/ / /_   / /_/ / / /_/ / /_/ / /  __/
/_/|_|/___/_/\__/   \____/_/\__, /\__, /_/\___/ 
                           /____//____/         
');

$app->handle($_SERVER['argv']);