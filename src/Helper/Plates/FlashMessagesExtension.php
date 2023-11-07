<?php
/**
 * Xzit Giggle
 *
 * This file `FlashMessagesExtension.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 06.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Helper\Plates;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use League\Plates\Template\Template;
use Odan\Session\FlashInterface;

class FlashMessagesExtension implements ExtensionInterface
{
    public Template $template;

    private string $functionName = 'getFlashMessages';

    private FlashInterface $flash;

    /**
     * @param FlashInterface $flash
     * @param string|null $functionName
     */
    public function __construct(FlashInterface $flash, ?string $functionName = null)
    {
        $this->flash = $flash;
        $this->functionName = $functionName ?? $this->functionName;
    }

    /**
     * @param Engine $engine
     * @return void
     */
    public function register(Engine $engine): void
    {
        $engine->registerFunction($this->functionName, [$this, 'getFlashMessages']);
    }

    /**
     * @return FlashInterface
     */
    public function getFlashMessages() : FlashInterface {
        return $this->flash;
    }
}