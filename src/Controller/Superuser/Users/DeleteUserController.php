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
use basteyy\XzitGiggle\Models\UserQuery;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class DeleteUserController extends SuperuserBaseUserController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
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

        if ($user->getId() === $this->getUser()->getId()) {
           $this->addErrorMessage(__('You cannot delete yourself.'));
           return $this->redirect(
               target: '/su/users',
               response: $response
           );
        }

        if ($this->isPost()) {
            if ($request->getParsedBody()['confirmation'] === 'delete:' . $user->getUsername()) {
                $user->softUserDelete();
                $this->addSuccessMessage(__('User deleted!'));
                return $this->redirect(
                    target: '/su/users',
                    response: $response
                );
            } else {
                $this->addErrorMessage(__('Confirmation failed!'));
            }
        }

        return $this->render(
            template: 'SU::users/delete_user',
            data: [
                'user' => $user
            ],
            response: $response
        );
    }
}