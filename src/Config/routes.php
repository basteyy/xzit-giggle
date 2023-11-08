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

    /** Routes for superuser */
    $app->group('/su/', function (\Slim\Routing\RouteCollectorProxy $app) {

        $app->get('', function (\Psr\Http\Message\ResponseInterface $response) {
            $response = $response->withHeader('Location', '/su/dashboard/');
            return $response->withStatus(302);
        });

        $app->get('dashboard/', \basteyy\XzitGiggle\Controller\Superuser\Dashboard\SUDashboardController::class);

        /** User Management */
        $app->group('users/', function (\Slim\Routing\RouteCollectorProxy $app) {
            $app->get('', \basteyy\XzitGiggle\Controller\Superuser\Users\ListUsersController::class);
            $app->map(['GET', 'POST'],'add/', \basteyy\XzitGiggle\Controller\Superuser\Users\AddUserController::class);
            $app->map(['GET', 'POST'],'view/', \basteyy\XzitGiggle\Controller\Superuser\Users\ViewUserController::class);
            $app->map(['GET', 'POST'],'edit/', \basteyy\XzitGiggle\Controller\Superuser\Users\EditUserController::class);
            $app->map(['GET', 'POST'],'delete/', \basteyy\XzitGiggle\Controller\Superuser\Users\DeleteUserController::class);
        });

        /** Domains Management */
        $app->group('domains/', function (\Slim\Routing\RouteCollectorProxy $app) {
            $app->get('', \basteyy\XzitGiggle\Controller\Superuser\Domains\ListDomainsController::class);
            $app->map(['GET', 'POST'],'add/', \basteyy\XzitGiggle\Controller\Superuser\Domains\AddDomainController::class);
            $app->map(['GET', 'POST'],'view/', \basteyy\XzitGiggle\Controller\Superuser\Domains\ViewDomainController::class);
            $app->map(['GET', 'POST'],'edit/', \basteyy\XzitGiggle\Controller\Superuser\Domains\EditDomainController::class);
            $app->map(['GET', 'POST'],'delete/', \basteyy\XzitGiggle\Controller\Superuser\Domains\DeleteDomainController::class);
        });

        /** Domains Management */
        $app->group('databases/', function (\Slim\Routing\RouteCollectorProxy $app) {
            $app->get('', \basteyy\XzitGiggle\Controller\Superuser\Databases\ListDatabasesController::class);
            $app->map(['GET', 'POST'],'add/', \basteyy\XzitGiggle\Controller\Superuser\Databases\AddDatabaseController::class);
            $app->map(['GET', 'POST'],'view/', \basteyy\XzitGiggle\Controller\Superuser\Databases\ViewDatabaseController::class);
            $app->map(['GET', 'POST'],'edit/', \basteyy\XzitGiggle\Controller\Superuser\Databases\EditDatabaseController::class);
            $app->map(['GET', 'POST'],'delete/', \basteyy\XzitGiggle\Controller\Superuser\Databases\DeleteDatabaseController::class);
        });

    })->add(\basteyy\XzitGiggle\Middleware\Session\SuperUsersOnlyMiddleware::class);


    /** Routes for logged-in users */
    $app->group('', function (\Slim\Routing\RouteCollectorProxy $app) {
        $app->get('/dashboard/', \basteyy\XzitGiggle\Controller\Dashboard\DashboardControllerUser::class);
        $app->get('/logout/', \basteyy\XzitGiggle\Controller\Login\LogoutControllerUser::class);

        /** Domains */
        $app->group('/domains/', function(\Slim\Routing\RouteCollectorProxy $app) {
            $app->get('', \basteyy\XzitGiggle\Controller\Domains\ListDomainsControllerUser::class);
            $app->map(['GET', 'POST'], 'add/', \basteyy\XzitGiggle\Controller\Domains\AddDomainControllerUser::class);
            $app->map(['GET', 'POST'], 'view/', \basteyy\XzitGiggle\Controller\Domains\ViewDomainControllerUser::class);
            $app->map(['GET', 'POST'], 'edit/', \basteyy\XzitGiggle\Controller\Domains\EditDomainControllerUser::class);
        });

    })->add(\basteyy\XzitGiggle\Middleware\Session\UsersOnlyMiddleware::class);
};