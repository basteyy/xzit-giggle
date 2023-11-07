<?php
/**
 * Xzit Giggle
 * 
 * This file `routes.php` is part of the `Xzit Giggle` project.
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
    $app->map(['GET', 'POST'], '/', \basteyy\XzitGiggle\Controller\Login\LoginController::class);

    /** Routes for logged in users */
    $app->group('', function (\Slim\Routing\RouteCollectorProxy $app) {
        $app->get('/dashboard/', \basteyy\XzitGiggle\Controller\Dashboard\DashboardController::class);
        $app->get('/logout/', \basteyy\XzitGiggle\Controller\Login\LogoutController::class);

        /** Domains */
        $app->group('/domains/', function(\Slim\Routing\RouteCollectorProxy $app) {
            $app->get('', \basteyy\XzitGiggle\Controller\Domains\ListDomainsController::class);
            $app->map(['GET', 'POST'], 'add/', \basteyy\XzitGiggle\Controller\Domains\AddDomainController::class);
            $app->map(['GET', 'POST'], 'view/', \basteyy\XzitGiggle\Controller\Domains\ViewDomainController::class);
            $app->map(['GET', 'POST'], 'edit/', \basteyy\XzitGiggle\Controller\Domains\EditDomainController::class);
        });

    })->add(\basteyy\XzitGiggle\Middleware\Session\UsersOnlyMiddleware::class);

};