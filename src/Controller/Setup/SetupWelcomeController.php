<?php
/**
 * Xzit Giggle
 * 
 * This file `${FILE_NAME}` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Setup;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SetupWelcomeController extends BaseSetupController
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(
        RequestInterface  $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        if(isSetUp()) {
            $this->addErrorMessage('Setup already done. Dont touch the setup again.');
            return $response->withHeader('Location', '/')->withStatus(302);
        }

        return $this->render(
            template: 'setup::welcome',
            response: $response,
        );
    }
}