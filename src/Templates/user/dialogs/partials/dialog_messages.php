<?php
/**
 * Xzit Giggle
 *
 * This file `dialog_messages.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

/** @var \basteyy\XzitGiggle\Models\Dialog $dialog */

if ($dialog === null) {
    return;
}

echo '<span class="small">Dialog ID #' . $dialog->getId() . '</span>';

$messages = \basteyy\XzitGiggle\Models\DialogMessageQuery::create()
    ->filterByDialogId($dialog->getId());

$messages = $messages->orderById('ASC')->find();

foreach ($messages as $message) {
    echo $this->fetch('users::dialogs/partials/dialog_message', [
        'message' => $message
    ]);
}