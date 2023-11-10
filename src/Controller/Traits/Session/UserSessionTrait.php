<?php
/**
 * Xzit Giggle
 *
 * This file `UserSessionTrait.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Traits\Session;

use basteyy\XzitGiggle\Models\User;
use basteyy\XzitGiggle\Models\UserQuery;
use DateTime;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait UserSessionTrait
{
    use SessionTrait;

    /** @var string $userSessionKey */
    private string $userSessionKey = USER_SESSION_IDENTIFIER;

    /** @var int $sessionTimeout The ttl is independent of used implementation of SessionInterface */
    private int $sessionTimeout = 3600;

    private bool $refreshTimeout = true;
    private bool $timeoutRefreshed = false;

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    protected function isLoggedIn(bool $update_ttl = true,
                                  bool $check_validation = false): bool
    {

        if (!$this->getSession()->has($this->userSessionKey)) {
            return false;
        }

        $data = $this->getUserData();

        /** Check ttl */
        if ($data['begin']->getTimestamp() + $this->sessionTimeout < time()) {
            $this->logOutUser();
            return false;
        }

        /**
         * @todo Implement a imitator for only one user (ip?) per session?
         */
        if ($check_validation) {
            if (!$user = UserQuery::create()->findOneByUsername($data['username'])) {
                return false;
            }
        }

        if ($update_ttl) {
            $this->refreshTimeout($data);
        }

        return true;
    }

    private function refreshTimeout(array $data) {

        if (!$this->timeoutRefreshed) {
            $this->getSession()->set($this->userSessionKey, [
                'username' => $data['username'],
                'id'       => $data['id'],
                'begin'    => $data['begin'],
                'end'      => new DateTime('+' . $this->sessionTimeout . ' seconds')
            ]);

            $this->timeoutRefreshed = true;
        }

    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getUserData(): null|array
    {
        $data = $this->getSession()->get($this->userSessionKey);

        if (!$data) {
            return null;
        }

        if ($this->refreshTimeout && !$this->timeoutRefreshed) {
            $this->refreshTimeout($data);
        }

        return $data;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function logOutUser(): void
    {
        $this->getSession()->delete($this->userSessionKey);
    }

    protected function getUser(): User
    {
        return UserQuery::create()->findOneById($this->getUserData()['id']);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Exception
     */
    protected function logInUser(User $user): void
    {
        $this->getSession()->set($this->userSessionKey, [
            'username' => $user->getUsername(),
            'id'       => $user->getId(),
            'begin'    => new DateTime(),
            'end'      => new DateTime('+' . $this->sessionTimeout . ' seconds')
        ]);
    }

}