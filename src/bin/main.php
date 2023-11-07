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

define('ROOT', dirname(__DIR__, 2));

/** Autoloader */
require_once ROOT . '/vendor/autoload.php';

/** Load .env */
$dotenv = \Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->load();

/** Load cli */
$app = new Application('Xzit Giggle - The CLI Tool', '1.0.0');

$app->add(new \basteyy\XzitGiggle\bin\Server\SyncServerConfig(), 'server:sync');


$app->logo('   _  __      _ __     _______             __   
  | |/ /___  (_) /_   / ____(_)___ _____ _/ /__ 
  |   /_  / / / __/  / / __/ / __ `/ __ `/ / _ \
 /   | / /_/ / /_   / /_/ / / /_/ / /_/ / /  __/
/_/|_|/___/_/\__/   \____/_/\__, /\__, /_/\___/ 
                           /____//____/         
');

$app->handle($_SERVER['argv']);