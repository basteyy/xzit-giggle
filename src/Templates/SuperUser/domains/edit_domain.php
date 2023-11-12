<?php
/**
 * Xzit Giggle
 *
 * This file `edit_domain.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 09.11.2023
 */
declare(strict_types=1);

/** @var \basteyy\XzitGiggle\Models\Domain $domain */

$this->layout('layouts::default', [
    'title' => __('Edit Domain'),
]);

?>
<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/" title="<?= __('Go to your dashboard') ?>"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/su/dashboard/"><?= __('Superuser Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/su/domains/"><?= __('Domains') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('Edit Domain') ?> <?= $domain->getDomain() ?></li>
        </ol>
    </nav>

    <h1><?= __('Edit Domain') ?></h1>

    <?= $this->fetch('SU::domains/partials/domain_form', [
        'domain' => $domain
    ]) ?>
</main>