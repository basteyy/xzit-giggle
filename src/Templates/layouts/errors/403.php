<?php
/**
 * Xzit Giggle
 *
 * This file `403.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 10.11.2023
 */
declare(strict_types=1);

$this->layout('layouts/extern', ['title' => 'Oops 403 - ' . __('Forbidden')]);
?>
<div class="d-flex align-items-center justify-content-center" style="height: 50vh;">
    <div class="text-center">
        <h1 class="display-1 fw-bold">403</h1>
        <p class="fs-3"> <span class="text-danger">Opps!</span> <?= __('Forbidden') ?>.</p>
        <p class="lead">
            <?= __('You are not allowed to access this page.') ?><br /><?= __('Please contact the administrator if you think this is an error.') ?>
        </p>
        <a href="/?from=<?= urlencode(json_encode([
            'url' => $_SERVER['REQUEST_URI'],
            'method' => $_SERVER['REQUEST_METHOD']
        ])) ?>" title="<?= __('To home page') ?>" class="btn btn-outline-light"><?= __('Go home') ?></a>
    </div>
</div>