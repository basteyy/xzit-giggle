<?php
/**
 * Xzit Giggle
 *
 * This file `add_domain.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

$this->layout('layouts::default', [
    'title' => __('Add a domain')
]);

/** @var \basteyy\XzitGiggle\Models\Domains $domain */

?>

<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/domains/"><?= __('List Domains') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('List Domains') ?></li>
        </ol>
    </nav>

    <h1><?= __('Add a domain') ?></h1>

    <p class="lead lh-lg">
        <?= __('Add a domain and create a website or whatever you want.') ?>
    </p>

    <?= $this->fetch('user/domains/partials/domain_form', [
            'domain' => $domain ?? new \basteyy\XzitGiggle\Models\Domains()
    ]) ?>

</main>