<?php
/**
 * Xzit Giggle
 *
 * This file `profil.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

use basteyy\XzitGiggle\Models\User;

$this->layout('layouts::default', [
    'title' => __('Dashboard')
]);

/** @var User $user */

?>
<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4">
        <div class=" image d-flex flex-column justify-content-center align-items-center">
            <h2 class="h5 mt-2">
                Yeah! It's me, <span class="fw-bold"><?= $user->getUsername() ?></span>
            </h2>

            <span class="fw-lighter">
                <?= $user->getUserRole()->getName() ?>
            </span>

            <hr />

            <p>
                <a class="btn btn-sm btn-primary" href="/@<?= $user->getUsername() ?>/message">
                    <i class="fas fa-envelope"></i> <?= __('Start private dialog') ?>
                </a>
            </p>

        </div>
    </div>
</div>