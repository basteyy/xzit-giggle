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

    <div class="row">
        <div class="col-6 col-md-4">
            <div class="bg-body-tertiary  border p-3 rounded-3">
                <h2 class="h4"><?= __('Add a domain') ?></h2>
                <p class="lh-lg">
                    <?= __('Add a new domain to your account') ?>
                </p>
                <a href="/domains/add" class="btn btn-primary"><?= __('Add a domain') ?></a>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="bg-body-tertiary  border p-3 rounded-3">
                <h2 class="h4"><?= __('Manage your domains') ?></h2>
                <p class="lh-lg">
                    <?= __('List all domains, which are connected to your webhosting and manage them') ?>
                </p>
                <a href="/domains/" class="btn btn-primary"><?= __('Manage domains') ?></a>
            </div>
        </div>
    </div>

    <hr class="my-3 my-md-5" />

    <p class="text-end">
        <?= __('All done?') ?> <a href="/logout"><?= __('Logout') ?></a>
    </p>

</main>
