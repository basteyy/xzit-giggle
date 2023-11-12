<?php
/**
 * Xzit Giggle
 *
 * This file `ChangePasswordController.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 12.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\User\Settings;

use basteyy\XzitGiggle\Controller\BaseUserController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ChangePasswordController  extends BaseUserController
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

        if ($this->isPost()) {
            $errors = [];

            /** Check current password first */
            if (!$this->getUser()->checkPassword($request->getParsedBody()['current_password'])) {
                $errors[] = __('Your current password is wrong');
            }

            /** Validate password (min 8 signs) */
            if (strlen($request->getParsedBody()['password']) < 8) {
                $errors[] = __('Your password must be at least 8 characters long');
            }

            /** Repeated correctly */
            if ($request->getParsedBody()['password'] !== $request->getParsedBody()['password_repeat']) {
                $errors[] = __('Your passwords do not match');
            }

            if (count($errors) === 0) {

                $this->getUser()->setPassword($request->getParsedBody()['password']);
                $this->getUser()->save();

                $this->addSuccessMessage(__('Your password has been changed successfully'));

                return $this->redirect(
                    target: '/settings/',
                    response: $response
                );
            }
            $this->addWarningMessage(__('Your password could not be changed'));
            $this->addErrorMessage($errors);

            return $this->reload(response: $response);
        }


        return $this->render(
            template: 'users::settings/user_change_password',
            response: $response,
        );
    }
}