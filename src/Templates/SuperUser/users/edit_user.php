<?php
/**
 * Xzit Giggle
 *
 * This file `edit_user.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 09.11.2023
 */
declare(strict_types=1);

/** @var \basteyy\XzitGiggle\Models\User $user */

$this->layout('layouts::default', [
    'title' => __('Edit User Details')
]);

?>
<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/su/dashboard/"><?= __('Superuser Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/su/users/"><?= __('Users') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('Edit %s (#%s)', $user->getUsername(), $user->getId()) ?></li>
        </ol>
    </nav>

    <h1><?= __('View %s (#%s)', $user->getUsername(), $user->getId()) ?></h1>

    <?= $this->fetch('SU::users/partials/user_form', [
        'user' => $user
    ]) ?>
</main>