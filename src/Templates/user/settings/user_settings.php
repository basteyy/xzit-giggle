<?php
/**
 * Xzit Giggle
 *
 * This file `user_settings.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 12.11.2023
 */
declare(strict_types=1);

use basteyy\XzitGiggle\Helper\Config;
use basteyy\XzitGiggle\Models\User;

$this->layout('layouts::default', [
    'title' => __('Your settings')
]);

/** @var User $user */
$user = $this->getUser();

?>

<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/" title="<?= __('Go to your dashboard') ?>"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('Settings') ?></li>
        </ol>
    </nav>

    <h1><?= __('Settings') ?></h1>

    <p class="lead lh-lg">
        <?= __('Here you can change a few settings related to your account.') ?>
    </p>

    <hr class="my-3 my-md-5"/>

    <form method="post">

        <h2 class="my-3 my-md-5"><?= __('Account Settings') ?></h2>

        <div class="my-3">
            <label for="email" class="form-label"><?= __('Your E-Mail') ?></label>
            <input type="email" class="form-control <?= !Config::get('allow_user_change_email') ? 'disabled' : ''?>" id="email"
                   name="email" value="<?= $user->getEmail() ?>"
                    required aria-describedby="email_info" <?= !Config::get('allow_user_change_email') ? 'readonly' : ''?>>
            <div id="email_info" class="p-2 form-text">
            <?= Config::get('allow_user_change_email') ?
                __('In case you want to change your E-Mail, you need to confirm the new address by clicking a link which will be sent to the new address.') :
                __('Contact your admin for changing your E-Mail') ?>
            </div>
        </div>


        <div class="my-3">
            <p>
                <?= __('You can change your password here: <a href="%s">change password</a>', '/settings/password/') ?>
            </p>
        </div>

        <div class="my-3 text-end">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-person-slash"></i> <?= __('Update') ?>
            </button>
        </div>
    </form>


</main>