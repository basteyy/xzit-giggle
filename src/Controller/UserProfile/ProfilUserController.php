<?php
/**
 * Xzit Giggle
 *
 * This file `ProfilUserController.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\UserProfile;

use basteyy\XzitGiggle\Controller\BaseUserController;
use basteyy\XzitGiggle\Models\UserQuery;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ProfilUserController extends BaseUserController
{
    /**
     * @param Request $request
     * @param Response $response
     * @param string $username
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(RequestInterface  $request,
                             ResponseInterface $response,
                             string            $username): ResponseInterface
    {
        $this->setRequest($request);

        $user = UserQuery::create()
            ->findOneByUsername($username);

        if (!$user) {
            return $this->render404(
                response: $response
            );
        }

        return $this->render(
            template: 'users::profil/profil',
            data: [
                'user' => $user
            ],
            response: $response,
        );
    }
}