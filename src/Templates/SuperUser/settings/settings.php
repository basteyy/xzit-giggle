<?php
/**
 * Xzit Giggle
 *
 * This file `settings.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 11.11.2023
 */
declare(strict_types=1);

$this->layout('layouts::default', [
    'title' => __('Settings'),
]);

?>
<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/" title="<?= __('Go to your dashboard') ?>"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/su/dashboard/"><?= __('Superuser Dashboard') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('Settings') ?></li>
        </ol>
    </nav>

    <h1><?= __('Settings') ?></h1>
    <p class="lead lh-lg my-3">
        The following settings are global settings and take effect for all users immediately. If you want to adjust for yourself, please go to your
        <a class="btn btn-light btn-sm" title="<?= __('Change your personal settings') ?>"
                href="/settings/"><i class="bi bi-gear"></i> settings</a>.
    </p>

    <hr class="my-3 my-md-5" />

    <form method="post">

        <h2 class="my-3 my-md-5">Users</h2>

        <div class="my-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" <?= \basteyy\XzitGiggle\Helper\Config::get('allow_user_login') ? 'checked':'' ?>
                   id="allow_user_login" name="allow_user_login" value="1">
            <label class="form-check-label" for="allow_user_login">Allow users to login (or only superusers?)</label>
        </div>

        <div class="my-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" <?= \basteyy\XzitGiggle\Helper\Config::get('allow_user_change_email') ? 'checked':'' ?>
                   id="allow_user_change_email" name="allow_user_change_email" value="1">
            <label class="form-check-label" for="allow_user_change_email">Allow users to change their e-mail?</label>
        </div>

        <h2 class="my-3 my-md-5">Domains</h2>
        <div class="my-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" <?= \basteyy\XzitGiggle\Helper\Config::get('allow_users_domain_adding') ? 'checked':'' ?>
                   id="allow_users_domain_adding" name="allow_users_domain_adding" value="1">
            <label class="form-check-label" for="allow_users_domain_adding">Allow users to add domains by themselves?</label>
        </div>

        <h2 class="my-3 my-md-5">Databases</h2>
        <div class="my-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" <?= \basteyy\XzitGiggle\Helper\Config::get('allow_users_database_adding') ? 'checked':'' ?>
                   id="allow_users_database_adding" name="allow_users_database_adding" value="1">
            <label class="form-check-label" for="allow_users_database_adding">Allow users to add databases by themselves?</label>
        </div>

        <h2 class="my-3 my-md-5">Other</h2>


        <div class="my-3 text-end">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-floppy"></i> <?= __('Save') ?>
            </button>
        </div>
    </form>

</main>