<?php
/**
 * Xzit Giggle
 *
 * This file `list_domains.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

$this->layout('layouts::default', [
    'title' => __('List Domains')
]);

?>

<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('List Domains') ?></li>
        </ol>
    </nav>

    <h1><?= __('List all domains') ?></h1>

    <div class="my-3 my-md-5 row">

    <?php

    /** @var \basteyy\XzitGiggle\Models\User $user */
    $user = $this->getUser();

    if (count($user->getDomainss()) === 0 ) {
        printf('<div class="alert alert-warning my-3 my-md-5">%s</div>', __('You have no domains connected to your account'));
    } else {
        foreach ($user->getDomainss() as $domains) {
            ?>
    <div class="card" style="max-width: 18rem;">
        <div class="card-body">
            <a class="d-block position-relative" href="/domains/view?d=<?= $domains->getDomain() ?>">
                <h5 class="card-title"><?= $domains->getDomain() ?></h5>
                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-<?= $domains->getActivated() ? 'success' : 'warning' ?> border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
              </span>
            </a>
            <a href="/domains/edit?d=<?= $domains->getDomain() ?>" class="card-link"><?= __('Edit') ?></a>
            <a href="https://<?= $domains->getDomain() ?>" target="_blank" class="card-link"><?= __('Visist') ?></a>
        </div>
    </div>
    <?php
        }
    }

    ?>


    </div>


    <p class="my-3 my-md-5">
        <a href="/domains/add/" title="<?= __('Add a new domain') ?>" class="btn btn-primary">
            <?= __('Add a new domain') ?>
        </a>
    </p>


</main>