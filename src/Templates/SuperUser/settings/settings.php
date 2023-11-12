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

        <h2 class="my-3 mt-md-5">Mail</h2>

        <p class="lead lh-lg">
            Giggle isn't a mail server, but you can use it to send mails. For this you need to configure the following settings.
        </p>

        <div class="my-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" <?= \basteyy\XzitGiggle\Helper\Config::get('emails_activated') ? 'checked':'' ?>
                   id="emails_activated" name="emails_activated" value="1" aria-describedby="emails_activated_help">
            <label class="form-check-label" for="emails_activated">Activate the sending e-mails</label>
            <div class="form-text p-2" id="emails_activated_help">
                Only when this is activated, e-mails will be sent.
                That means without this setting, user arnt able to request a new password or get informed about important
                things.
                Its highly recommended to activate this setting.
            </div>
        </div>

        <div class="my-3">
            <label for="emails_driver" class="form-label"><?= __('Driver') ?></label>
            <select id="emails_driver" name="emails_driver" aria-describedby="emails_driver_help" class="form-select">
                <option value="smtp" <?= \basteyy\XzitGiggle\Helper\Config::get('emails_driver') === 'smtp' ? 'selected':'' ?>>SMTP</option>
                <option value="mail" <?= \basteyy\XzitGiggle\Helper\Config::get('emails_driver') === 'mail' ? 'selected':'' ?>>Mail</option>
            </select>
            <div class="p-2 form-text" id="emails_driver_help">
                The driver is the way how the e-mails are sent. You can choose between different drivers.
                <ul>
                    <li><strong>SMTP</strong> - Send the e-mails over a SMTP server</li>
                    <li><strong>Mail</strong> - Send the e-mails over the PHP mail() function</li>
                </ul>
            </div>
        </div>

        <h2 class="my-3 mt-md-5">Users</h2>

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

        <h2 class="my-3 mt-md-5">Domains</h2>
        <div class="my-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" <?= \basteyy\XzitGiggle\Helper\Config::get('allow_users_domain_adding') ? 'checked':'' ?>
                   id="allow_users_domain_adding" name="allow_users_domain_adding" value="1">
            <label class="form-check-label" for="allow_users_domain_adding">Allow users to add domains by themselves?</label>
        </div>

        <h2 class="my-3 mt-md-5">Databases</h2>
        <div class="my-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" <?= \basteyy\XzitGiggle\Helper\Config::get('allow_users_database_adding') ? 'checked':'' ?>
                   id="allow_users_database_adding" name="allow_users_database_adding" value="1">
            <label class="form-check-label" for="allow_users_database_adding">Allow users to add databases by themselves?</label>
        </div>

        <h2 class="my-3 mt-md-5">Other</h2>


        <div class="my-3 text-end">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-floppy"></i> <?= __('Save') ?>
            </button>
        </div>
    </form>

</main>