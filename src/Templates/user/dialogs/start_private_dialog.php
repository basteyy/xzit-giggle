<?php
/**
 * Xzit Giggle
 *
 * This file `start_private_dialog.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

use basteyy\XzitGiggle\Models\User;

/** @var User $user */

$this->layout('layouts::default', [
    'title' => __('Start a new chat with %s', $user->getUsername())
]);


?>
<div class="card">
    <div class="card-body text-center p-3 p-md-5">
        <p class="lead lh-lg">
            <?= __('You are about to start a new chat with <a class="fw-bold" href="/@%1$s">%1$ s</a>', $user->getUsername()) ?><br />
        </p>

        <form method="post">
            <button type="submit" class="btn btn-primary">
                <?= __('Start chat') ?>
            </button>
        </form>
    </div>
</div>
