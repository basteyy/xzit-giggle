<?php
/**
 * Xzit Giggle
 *
 * This file `SettingsController.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 11.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Superuser\Settings;

use basteyy\XzitGiggle\Controller\Superuser\Settings\Traits\SettingsTrait;
use basteyy\XzitGiggle\Controller\Superuser\SuperuserBaseUserController;
use basteyy\XzitGiggle\Helper\Config;
use Propel\Runtime\Exception\PropelException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class SettingsController extends SuperuserBaseUserController
{
    use SettingsTrait;

    /**
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws PropelException
     */
    public function __invoke(RequestInterface  $request,
                             ResponseInterface $response): ResponseInterface
    {
        $this->setRequest($request);

        if ($this->isPost()) {
            /** User */
            Config::set('allow_user_login',  isset($request->getParsedBody()['allow_user_login']));
            Config::set('allow_user_change_email',  isset($request->getParsedBody()['allow_user_change_email']));

            /** Domains */
            Config::set('allow_users_domain_adding',  isset($request->getParsedBody()['allow_users_domain_adding']));

            /** Databases */
            Config::set('allow_users_database_adding',  isset($request->getParsedBody()['allow_users_database_adding']));

            /** Confirm message and reload current page */
            $this->addSuccessMessage(__('Settings saved successfully'));
            return $this->reload(
                response: $response
            );
        }

        return $this->render(
            template: 'SU::settings/settings',
            data: [
            ],
            response: $response
        );
    }
}