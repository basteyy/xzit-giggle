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
 * @since 08.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Superuser\Users;

use basteyy\XzitGiggle\Controller\Superuser\SuperuserBaseUserController;
use basteyy\XzitGiggle\Controller\Superuser\Users\Trait\UserSaveTrait;
use basteyy\XzitGiggle\Models\UserQuery;
use basteyy\XzitGiggle\Models\UserRoleQuery;
use Propel\Runtime\Exception\PropelException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class EditUserController extends SuperuserBaseUserController
{
    use UserSaveTrait;

    /**
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws PropelException
     */
    public function __invoke(RequestInterface  $request,
                             ResponseInterface $response): ResponseInterface
    {
        $user = UserQuery::create()->findOneByUsername($request->getQueryParams()['u'] ?? null);

        if (!$user) {
            $this->addErrorMessage(__('User not found!'));
            return $this->redirect(
                target: '/su/users',
                response: $response
            );
        }

        if ($this->isPost()) {
            $user = $this->saveUser($user, $request);
            if($this->saved_successfully) {
                return $this->redirect(
                    target: '/su/users/edit?u=' . $user->getUsername(),
                    response: $response
                );
            }
        }

        return $this->render(
            template: 'SU::users/edit_user',
            data: [
                'user' => $user
            ],
            response: $response
        );
    }
}