<?php
/**
 * Xzit Giggle
 *
 * This file `user_change_password.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 12.11.2023
 */
declare(strict_types=1);

use basteyy\XzitGiggle\Models\User;

$this->layout('layouts::default', [
    'title' => __('Your password')
]);

/** @var User $user */
$user = $this->getUser();

?>

<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/" title="<?= __('Go to your dashboard') ?>"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/settings/" title="<?= __('Change your settings') ?>"><?= __('Settings') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('Change Password') ?></li>
        </ol>
    </nav>

    <h1><?= __('Change Password') ?></h1>

    <p class="lead lh-lg">
        <?= __('Change your password, which you use to login here.') ?>
    </p>

    <hr class="my-3 my-md-5"/>

    <form method="post">
        <div class="row">
            <div class="col-12 col-md-6 my-3">
                <label for="password" class="form-label"><?= __('New Password') ?></label>
                <div class="row">
                    <div class="col-9">
                        <input
                                type="password" class="form-control" id="password"
                                name="password" value=""
                                required aria-describedby="password_info">
                    </div>
                    <div class="col-3">
                        <button data-generate-password class="btn btn-secondary"><?= __('Generate password') ?></button>
                    </div>
                </div>
                <div id="password_info" class="p-2 form-text">
                    <?= __('Insert your new password. Make sure you only use it for this website.') ?>
                </div>
            </div>
            <div class="col-12 col-md-6 my-3">
                <label for="password_repeat" class="form-label"><?= __('Repeat the new Password') ?></label>
                <input
                    type="password" class="form-control" id="password_repeat"
                    name="password_repeat" value=""
                    required aria-describedby="password_repeat_info">
                <div id="password_repeat_info" class="p-2 form-text">
                    <?= __('Repeat your new password.') ?>
                </div></div>
            <div class="col-12 my-3">
                <label for="current_password" class="form-label"><?= __('Conform with your current password') ?></label>
                <input
                        type="password" class="form-control" id="current_password"
                        name="current_password" value=""
                        required aria-describedby="current_password_info">
                <div id="current_password_info" class="p-2 form-text">
                    <?= __('To confirm, insert your current password.') ?>
                </div>
            </div>
            <div class="col-12 my-3 text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-pass"></i> <?= __('Update') ?>
                </button>
            </div>
        </div>
    </form>
</main>
<script src="/js/password_generator/dist/password_generator.min.js"></script>
<script>
    const passwordGenerator = new PasswordGenerator('input[id=password]');
    document.querySelector('button[data-generate-password]').addEventListener('click', function (e) {
        e.preventDefault()
        passwordGenerator.generate();
    });

</script>