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

use basteyy\XzitGiggle\Controller\Dashboard\DashboardControllerUser;
use basteyy\XzitGiggle\Controller\Dialog\StartPrivateDialogController;
use basteyy\XzitGiggle\Controller\Dialog\UserDialogController;
use basteyy\XzitGiggle\Controller\Domains\AddDomainControllerUser;
use basteyy\XzitGiggle\Controller\Domains\EditDomainControllerUser;
use basteyy\XzitGiggle\Controller\Domains\ListDomainsControllerUser;
use basteyy\XzitGiggle\Controller\Domains\ViewDomainControllerUser;
use basteyy\XzitGiggle\Controller\Login\LoginController;
use basteyy\XzitGiggle\Controller\Login\LogoutControllerUser;
use basteyy\XzitGiggle\Controller\Superuser\Dashboard\SUDashboardController;
use basteyy\XzitGiggle\Controller\Superuser\Databases\AddDatabaseController;
use basteyy\XzitGiggle\Controller\Superuser\Databases\DeleteDatabaseController;
use basteyy\XzitGiggle\Controller\Superuser\Databases\EditDatabaseController;
use basteyy\XzitGiggle\Controller\Superuser\Databases\ListDatabasesController;
use basteyy\XzitGiggle\Controller\Superuser\Databases\ViewDatabaseController;
use basteyy\XzitGiggle\Controller\Superuser\Domains\AddDomainController;
use basteyy\XzitGiggle\Controller\Superuser\Domains\DeleteDomainController;
use basteyy\XzitGiggle\Controller\Superuser\Domains\EditDomainController;
use basteyy\XzitGiggle\Controller\Superuser\Domains\ListDomainsController;
use basteyy\XzitGiggle\Controller\Superuser\Domains\ViewDomainController;
use basteyy\XzitGiggle\Controller\Superuser\Settings\SettingsController;
use basteyy\XzitGiggle\Controller\Superuser\Users\AddUserController;
use basteyy\XzitGiggle\Controller\Superuser\Users\DeleteUserController;
use basteyy\XzitGiggle\Controller\Superuser\Users\EditUserController;
use basteyy\XzitGiggle\Controller\Superuser\Users\ListUsersController;
use basteyy\XzitGiggle\Controller\Superuser\Users\ViewUserController;
use basteyy\XzitGiggle\Controller\User\Settings\UserSettingController;
use basteyy\XzitGiggle\Controller\UserProfile\ProfilUserController;
use basteyy\XzitGiggle\Middleware\Session\SuperUsersOnlyMiddleware;
use basteyy\XzitGiggle\Middleware\Session\UsersOnlyMiddleware;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

if (!isset($app)) {
    throw new Exception('No $app defined');
}

/** @var App $app */
return function (App $app) {
    $app->map(['GET', 'POST'], '/', LoginController::class);

    /** Routes for superuser */
    $app->group('/su/', function (RouteCollectorProxy $app) {

        $app->get('', function (ResponseInterface $response) {
            $response = $response->withHeader('Location', '/su/dashboard/');
            return $response->withStatus(302);
        });

        $app->get('dashboard/', SUDashboardController::class);

        /** Settings */
        $app->group('settings/', function (RouteCollectorProxy $app) {
            $app->map(['GET', 'POST'], '', SettingsController::class);
        });

        /** User Management */
        $app->group('users/', function (RouteCollectorProxy $app) {
            $app->get('', ListUsersController::class);
            $app->map(['GET', 'POST'], 'add/', AddUserController::class);
            $app->map(['GET', 'POST'], 'view/', ViewUserController::class);
            $app->map(['GET', 'POST'], 'edit/', EditUserController::class);
            $app->map(['GET', 'POST'], 'delete/', DeleteUserController::class);
        });

        /** Domains Management */
        $app->group('domains/', function (RouteCollectorProxy $app) {
            $app->get('', ListDomainsController::class);
            $app->map(['GET', 'POST'], 'add/', AddDomainController::class);
            $app->map(['GET', 'POST'], 'view/', ViewDomainController::class);
            $app->map(['GET', 'POST'], 'edit/', EditDomainController::class);
            $app->map(['GET', 'POST'], 'delete/', DeleteDomainController::class);
        });

        /** Domains Management */
        $app->group('databases/', function (RouteCollectorProxy $app) {
            $app->get('', ListDatabasesController::class);
            $app->map(['GET', 'POST'], 'add/', AddDatabaseController::class);
            $app->map(['GET', 'POST'], 'view/', ViewDatabaseController::class);
            $app->map(['GET', 'POST'], 'edit/', EditDatabaseController::class);
            $app->map(['GET', 'POST'], 'delete/', DeleteDatabaseController::class);
        });

    })->add(SuperUsersOnlyMiddleware::class);


    /** Routes for logged-in users */
    $app->group('', function (RouteCollectorProxy $app) {
        $app->get('/dashboard/', DashboardControllerUser::class);
        $app->get('/logout/', LogoutControllerUser::class);

        $app->group('/settings', function (RouteCollectorProxy $app) {
            $app->map(['GET', 'POST'], '/', UserSettingController::class);
            $app->map(['GET', 'POST'], '/password/', \basteyy\XzitGiggle\Controller\User\Settings\ChangePasswordController::class);
        });

        $app->get('/@{username:[A-z0-9]+}/', ProfilUserController::class);
        $app->map(['GET', 'POST'], '/@{username:[A-z0-9]+}/dialogs/', UserDialogController::class);
        $app->map(['GET', 'POST'], '/@{username:[A-z0-9]+}/message/', StartPrivateDialogController::class);

        /** Domains */
        $app->group('/domains/', function (RouteCollectorProxy $app) {
            $app->get('', ListDomainsControllerUser::class);
            $app->map(['GET', 'POST'], 'add/', AddDomainControllerUser::class);
            $app->map(['GET', 'POST'], 'view/', ViewDomainControllerUser::class);
            $app->map(['GET', 'POST'], 'edit/', EditDomainControllerUser::class);
        });

    })->add(UsersOnlyMiddleware::class);
};