<?php
/**
 * Xzit Giggle
 * 
 * This file `setup_routes.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

if (!isset($app)) {
    throw new \Exception('No $app defined');
}

/** @var \Slim\App $app */
return function(\Slim\App $app) {
    $app->get('/', basteyy\XzitGiggle\Controller\Setup\SetupWelcomeController::class);
    $app->map(['GET', 'POST'],'/setup/database/', basteyy\XzitGiggle\Controller\Setup\SetupDatabaseController::class);
    $app->map(['GET', 'POST'],'/setup/superuser/', basteyy\XzitGiggle\Controller\Setup\SetupSuperUserController::class);
    $app->map(['GET', 'POST'],'/setup/options/', basteyy\XzitGiggle\Controller\Setup\SetupOptionsController::class);
    $app->map(['GET', 'POST'],'/setup/install/', basteyy\XzitGiggle\Controller\Setup\SetupInstallController::class);
};