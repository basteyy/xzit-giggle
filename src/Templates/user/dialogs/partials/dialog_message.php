<?php
/**
 * Xzit Giggle
 *
 * This file `dialog_message.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

use League\CommonMark\GithubFlavoredMarkdownConverter;

/** @var \basteyy\XzitGiggle\Models\DialogMessage $message */

$converter = new GithubFlavoredMarkdownConverter([
    'html_input' => 'strip',
    'allow_unsafe_links' => false,
]);

$messageText = $converter->convert($message->getMessage());



if ($this->getUser()->getId() === $message->getUserId()) {
    // Message from the user

    ?>

    <div class="row">
        <div class="col-2"></div>
        <div class="col-10">
                <span class="small d-block text-end m-2">
                    You at <?= $message->getCreatedAt(DEFAULT_DATETIME_FORMAT) ?>
                </span>
            <div class="card bg-primary rounded-4" style="border-top-right-radius: 0 !important;">
                <div class="card-body">
                    <?= $messageText  ?>
                </div>
            </div>
        </div>
    </div>

<?php

} else {
    // Message from the other user

    ?>

    <div class="row">
        <div class="col-10">
                <span class="small d-block text-start m-2">
                    You at <?= $message->getCreatedAt(DEFAULT_DATETIME_FORMAT) ?>
                </span>
            <div class="card bg-primary rounded-4" style="border-top-right-radius: 0 !important;">
                <div class="card-body">
                    <?= $messageText ?>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>

    <?php
}

?>

