<?php
/**
 * Xzit Giggle
 *
 * This file `flash_messages.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 06.11.2023
 */
declare(strict_types=1);

/** @var \Odan\Session\FlashInterface $messages */
$messages = $this->getFlashMessages();

foreach ($messages->all() as $type => $messages) {
    printf('<div class="alert alert-%1$s" role="alert">%2$s</div>', $type, implode('<br>', $messages));
}
