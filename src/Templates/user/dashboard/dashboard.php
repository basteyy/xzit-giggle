<?php
/**
 * Xzit Giggle
 *
 * This file `dashboard.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

$this->layout('layouts::default', [
    'title' => __('Dashboard')
]);

?>
<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><?= __('Dashboard') ?></li>
        </ol>
    </nav>


    <h1>Hi <?= $this->getUser()->getUsername() ?></h1>


    <p class="lead lh-lg mb-3 mb-md-5">
        <?= __('What do you want to do?') ?>
    </p>

</main>
