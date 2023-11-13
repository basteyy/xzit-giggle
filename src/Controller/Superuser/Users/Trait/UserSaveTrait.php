<?php
/**
 * Xzit Giggle
 *
 * This file `UserSaveTrait.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 09.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Superuser\Users\Trait;

use basteyy\XzitGiggle\Controller\Traits\RequestTrait;
use basteyy\XzitGiggle\Controller\Traits\ResponseTrait;
use basteyy\XzitGiggle\Controller\Traits\Session\Flash\SessionFlashMessagesTrait;
use basteyy\XzitGiggle\Models\User;
use basteyy\XzitGiggle\Models\UserQuery;
use basteyy\XzitGiggle\Models\UserRoleQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;

trait UserSaveTrait
{

    use RequestTrait,
        SessionFlashMessagesTrait,
        ResponseTrait;

    private bool $saved_successfully;

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws PropelException
     */
    protected function saveUser(User              $user,
                                RequestInterface  $request): User
    {

        $this->setRequest($request);

        $errors = [];

        $username = $request->getParsedBody()['username'];
        $email = $request->getParsedBody()['email'];
        $user_role = $request->getParsedBody()['user_role'] ?? null;

        // Patch user data by default
        $user->setEmail($email);

        // The following things are not allowed for the current user
        if ($this->getUser()->getId() !== $user->getId()) {
            $user->setUsername($username);
            $user->setUserRoleId($user_role);
            $user->setActivated(isset($request->getParsedBody()['activated']));
            $user->setBlocked(isset($request->getParsedBody()['blocked']));

        if (!isset($username) || strlen(trim($username)) < 4) {
            $errors[] = __('Username must be at least 4 characters long');
        } elseif (!ctype_alnum($username)) {
            $errors[] = __('Username must only contain letters and numbers');
        } elseif (
            ($user->isNew() && UserQuery::create()->findOneByUsername($username)) ||
            (UserQuery::create()->filterById($user->getId(), Criteria::NOT_EQUAL)->findOneByUsername($username))
        ) {
            $errors[] = __('Username already exists');
        }
    }
    // Validate username

        // Validate E-Mail
        if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = __('E-Mail is not valid');
        } elseif (
            ($user->isNew() && UserQuery::create()->findOneByEmail($email)) ||
            (UserQuery::create()->filterById($user->getId(), Criteria::NOT_EQUAL)->findOneByEmail($email))) {
            $errors[] = __('E-Mail already exists');
        }

        // User Role (expecting user_role_id)
        if ($this->getUser()->getId() !== $user->getId() && !UserRoleQuery::create()->findOneById($user_role)) {
            $errors[] = __('User Role is not valid');
        }

        // Password check
        if (isset($request->getParsedBody()['set_password']) && (!isset($request->getParsedBody()['password']) || strlen($request->getParsedBody()['password']) < 8)) {
            $errors[] = __('Password must be at least 8 characters long');
        }

        $user->setHomeFolder($request->getParsedBody()['home_folder'] ?? null);
        if (!isset($request->getParsedBody()['home_folder']) || strlen(trim($request->getParsedBody()['home_folder'])) < 1) {
            $errors[] = __('Home folder must be set');
        }

        $user->setLogFolder($request->getParsedBody()['log_folder'] ?? null);
        if (!isset($request->getParsedBody()['log_folder']) || strlen(trim($request->getParsedBody()['log_folder'])) < 1) {
            $errors[] = __('Log folder must be set');
        }

        $user->setWebFolder($request->getParsedBody()['web_folder'] ?? null);
        if (!isset($request->getParsedBody()['web_folder']) || strlen(trim($request->getParsedBody()['web_folder'])) < 1) {
            $errors[] = __('Web folder must be set');
        }

        $user->setBash($request->getParsedBody()['bash'] ?? null);
        if (null === $user->getBash() || strlen(trim($user->getBash())) < 1) {
            $errors[] = __('Bash must be set');
        }

        if (count($errors) === 0) {

            if (isset($request->getParsedBody()['set_password'])) {
                $user->setPassword($request->getParsedBody()['password']);
            }

            $user->save();
            $this->addSuccessMessage(__('User "%s" successfully updated', $user->getUsername()));
            $this->saved_successfully = true;

            return $user;
        }

        $this->addInfoMessage(__('User "%s" not updated', $user->getUsername()));
        $this->addErrorMessage($errors);
        $this->saved_successfully = false;

        return $user;
    }
}