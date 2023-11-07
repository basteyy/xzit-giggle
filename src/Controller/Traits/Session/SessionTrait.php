<?php
/**
 * Xzit Giggle
 * 
 * This file `SessionTrait.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Traits\Session;

use basteyy\XzitGiggle\Controller\Traits\ContainerTrait;
use http\Exception\RuntimeException;
use Odan\Session\SessionInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait SessionTrait
{

    use ContainerTrait;

    /** @var SessionInterface $session */
    protected SessionInterface $session;

    /**
     * If overwrite is set to false, the value will be added to the value
     * @param string $key
     * @param mixed $value
     * @param bool $overwrite
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function pushToSession(
        string $key,
        mixed  $value,
        bool   $overwrite = true): void
    {
        if (!$overwrite && $this->getFromSession($key) !== null) {
            $value = array_merge($this->getFromSession($key), $value);
        }

        $this->getSession()->set($key, $value);
    }

    /**
     * Returns the value from the session
     * @param string $key
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getFromSession(string $key)
    {
        return $this->getSession()->get($key);
    }

    /**
     * @return SessionInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getSession(): SessionInterface
    {
        if (!isset($this->session)) {
            if (!$this->getContainer()->has(SessionInterface::class)) {
                throw new RuntimeException('SessionInterface not found in container. Did you forget to add the SessionProvider to the container?');
            }

            $this->setSession($this->getContainer()->get(SessionInterface::class));
        }

        return $this->session;
    }

    /**
     * @param SessionInterface $session
     * @return void
     */
    protected function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    protected function removeFromSession(string $key): void
    {
        $this->getSession()->delete($key);
    }

    protected function clearSession(): void
    {
        $this->getSession()->clear();
    }
}