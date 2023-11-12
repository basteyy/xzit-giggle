<?php
/**
 * Xzit Giggle
 *
 * This file `UserSettingController.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 09.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\User\Settings;

use basteyy\XzitGiggle\Controller\BaseUserController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class UserSettingController  extends BaseUserController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface  $request,
                             ResponseInterface $response): ResponseInterface
    {
        $this->setRequest($request);



        return $this->render(
            template: 'users::settings/user_settings',
            response: $response,
        );
    }

}