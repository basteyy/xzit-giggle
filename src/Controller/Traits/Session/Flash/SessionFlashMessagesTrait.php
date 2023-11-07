<?php
/**
 * Xzit Giggle
 *
 * This file `SessionFlashMessagesTrait.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 06.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Traits\Session\Flash;

use basteyy\XzitGiggle\Controller\Traits\Session\SessionTrait;
use basteyy\XzitGiggle\Helper\Enums\FlashMessageTypeEnum;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait SessionFlashMessagesTrait
{

    use SessionTrait;

    /** @var string $flashSessionKey */
    private string $flashSessionKey = 'flashMessages';

    public function getSuccessMessages(): array
    {
        return $this->getMessages(FlashMessageTypeEnum::SUCCESS);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getMessages(?FlashMessageTypeEnum $type = null): array
    {
        if ($type === null) {
            return $this->getSession()->getFlash()->all();
        } else {
            return $this->getSession()->getFlash()->get($type->value);
        }
    }

    /**
     * @param string $key
     * @return void
     */
    public function setFlashMessagesSessionKey(string $key): void
    {
        $this->flashSessionKey = $key;
    }

    /**
     * @return string
     */
    public function getFlashMessagesSessionKey(): string
    {
        return $this->flashSessionKey;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getErrorMessages(): array
    {
        return $this->getMessages(FlashMessageTypeEnum::ERROR);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getWarningMessages(): array
    {
        return $this->getMessages(FlashMessageTypeEnum::WARNING);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getInfoMessages(): array
    {
        return $this->getMessages(FlashMessageTypeEnum::INFO);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAllMessages(): array
    {
        return $this->getMessages();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addSuccessMessage(string|array $message): void
    {
        $this->addMessage(FlashMessageTypeEnum::SUCCESS, $message);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addMessage(FlashMessageTypeEnum $messageType, string|array $message): void
    {
        if (is_array($message)) {
            foreach ($message as $msg) {
                $this->addMessage($messageType, $msg);
            }

            return;
        }

        $this->getSession()->getFlash()->add($messageType->value, $message);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addErrorMessage(string|array $message): void
    {
        $this->addMessage(FlashMessageTypeEnum::ERROR, $message);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addWarningMessage(string|array $message): void
    {
        $this->addMessage(FlashMessageTypeEnum::WARNING, $message);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addInfoMessage(string|array $message): void
    {
        $this->addMessage(FlashMessageTypeEnum::INFO, $message);
    }

}