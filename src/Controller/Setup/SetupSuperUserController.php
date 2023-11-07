<?php
/**
 * Xzit Giggle
 *
 * This file `${FILE_NAME}` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 06.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Setup;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SetupSuperUserController extends BaseSetupController
{
    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(
        RequestInterface  $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        $this->setRequest($request);

        if(isSetUp()) {
            $this->addErrorMessage('Setup already done. Dont touch the setup again.');
            return $response->withHeader('Location', '/')->withStatus(302);
        }

        if (!$this->isDatabaseSetUp()) {
            $this->addErrorMessage('Please setup database first.');
            return $response->withHeader('Location', '/setup/database')->withStatus(302);
        }

        $superuser_data = [
            'username' => $this->isSuperUserSetUp() ? $this->getUserName() : '',
            'password' => ''
        ];

        if ($this->isPost()) {

            $username = $request->getParsedBody()['username'];
            $password = $request->getParsedBody()['password'];
            $errors = [];

            if (strlen($username) < 4) {
                $errors[] = 'Username must be at least 4 characters long.';
            }

            if (strlen($username) > 255) {
                $errors[] = 'Username must be less than 255 characters long.';
            }

            if (strlen($password) < 8) {
                $errors[] = 'Password must be at least 8 characters long.';
            }

            // Allow only a-z, A-Z, 0-9, _ and - in username
            if (!preg_match('/^[a-zA-Z0-9+_-]+$/', $username)) {
                $errors[] = 'Username may only contain letters, numbers, underscores and dashes.';
            }

            if (count($errors) === 0) {
                $this->saveSuperUserData($username, $password);
                $this->addInfoMessage('Superuser created. Go one friend.');
                return $response->withHeader('Location', '/setup/options')->withStatus(302);
            }

            $errors[] = 'Superuser creation failed. Please check your credentials. Try again.';

            $this->addErrorMessage($errors);
        }

        return $this->render(
            template: 'setup::superuser/superuser',
            data: [
                'superuser_data' => $superuser_data
            ],
            response: $response
        );

    }
}