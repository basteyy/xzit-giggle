<?php
declare(strict_types=1);
/**
 * This file is part of xzit giggle
 *
 * Check out github.com/basteyy/xzit-giggle for more
 *
 */

namespace basteyy\XzitGiggle\Controller\Login;

use basteyy\XzitGiggle\Controller\BaseController;
use basteyy\XzitGiggle\Controller\Traits\Session\Flash\SessionFlashMessagesTrait;
use basteyy\XzitGiggle\Controller\Traits\Session\UserSessionTrait;
use basteyy\XzitGiggle\Models\UserQuery;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class LoginController extends BaseController
{
    use SessionFlashMessagesTrait,
        UserSessionTrait;

    public function __invoke(
        RequestInterface  $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        $this->setRequest($request);

        if ($this->isLoggedIn()) {
            $this->addWarningMessage(__('You are already logged in'));
            return $this->redirect('/dashboard/', $response);
        }

        if ($this->isPost()) {
            $username = $request->getParsedBody()['username'];
            $password = $request->getParsedBody()['password'];

            if (!$user = UserQuery::create()->findOneByUsername($username)) {
                $this->addWarningMessage(__('Please check your username'));
                return $this->reload($response);
            }

            if (!$user->checkPassword($password)) {
                $this->addWarningMessage(__('Please check your password'));
                return $this->reload($response);
            }

            $this->addSuccessMessage(__('Welcome back %s', $user->getUsername()));
            $this->logInUser($user);

            return $this->redirect(
                target: '/dashboard/',
                response: $response
            );

        }

        return $this->render(
            template: 'login/login',
            response: $response,
        );
    }
}