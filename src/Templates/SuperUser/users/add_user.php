<?php
/**
 * Xzit Giggle
 *
 * This file `add_user.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

/** @var \basteyy\XzitGiggle\Models\User $user */

if (!isset($user)) {
    $user = new \basteyy\XzitGiggle\Models\User();
}

$this->layout('layouts::default', [
    'title' => __('Superuser Dashboard')
]);

?>
<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/su/dashboard/"><?= __('Superuser Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/su/users/"><?= __('Users') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('Add a user') ?></li>
        </ol>
    </nav>

    <h1><?= __('Add a user') ?></h1>

    <?= $this->fetch('SU::users/partials/user_form', [
            'user' => $user
            ]) ?>
</main>