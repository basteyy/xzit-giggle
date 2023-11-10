<?php
/**
 * Xzit Giggle
 *
 * This file `dialog_message_form.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

/** @var Dialog $dialog */
/** @var DialogMessage $message */

use basteyy\XzitGiggle\Models\Dialog;
use basteyy\XzitGiggle\Models\DialogMessage;

?>

<div class="my-3 my-md-5">
    <form method="post">
        <div class="my-3">
            <label for="message" class="form-label"><?= __('Message') ?></label>
            <textarea id="message" name="message" required class="form-control" rows="3" minlength="3"><?= $message?->getMessage() ?? '' ?></textarea>
        </div>
        <div class="my-3 text-end">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-messenger"></i> <?= __('Send') ?>
            </button>
        </div>
    </form>
</div>

<script>
    // double enter sends form
    let last_key = null;

    document.getElementById('message').addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && last_key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            this.form.submit();
        }

        last_key = e.key;
    });

    // Focus on the load
    document.getElementById('message').focus();

</script>