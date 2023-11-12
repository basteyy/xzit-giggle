<?php
/**
 * Xzit Giggle
 *
 * This file `delete_user.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 10.11.2023
 */
declare(strict_types=1);

/** @var User $user */

use basteyy\XzitGiggle\Models\User;

$this->layout('layouts::default', [
    'title' => __('Delete User')
]);

?>
<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/" title="<?= __('Go to your dashboard') ?>"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/su/dashboard/"><?= __('Superuser Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/su/users/"><?= __('Users') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('Delete %s (#%s)', $user->getUsername(), $user->getId()) ?></li>
        </ol>
    </nav>

    <h1><?= __('Delete %s (#%s)', $user->getUsername(), $user->getId()) ?></h1>

    <p class=" lead">
        Here you can delete the user. Deleting means, that all data related to that user will be deleted. This includes:
    </p>

    <ul class="list-group-numbered lead">
        <li class="list-group-item">Data from Xzit Giggle Database (username, password hash, email, messages)</li>
        <li class="list-group-item">All Domain-Configurations</li>
        <li class="list-group-item">All Domain-Data</li>
        <li class="list-group-item">All Database-Configurations</li>
        <li class="list-group-item">All Database-Data</li>
    </ul>

    <p class=" lead">
        Consider deactivating od blocking the user instead of deleting it. Instand the user will not be able to login anymore. The data will be deleted with the next cleanup.
    </p>

    <div class="alert alert-warning">
        <form method="post" id="delete_form">

            <div class="my-3">
                <label class="form-label" for="confirmation"><?= __('Confirm while typing <code>delete:%s</code> into the field', $user->getUsername()) ?></label>
                <input class="form-control border-danger" type="text" name="confirmation" id="confirmation" required>
            </div>

            <div class="my-3 d-none">
                <button disabled type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-exclamation-circle"></i> <?= __('Delete User') ?>
                </button>
            </div>
        </form>
    </div>

    <script>
        const
            delete_form = document.getElementById('delete_form'),
            confirm_string = 'delete:<?= $user->getUsername() ?>',
            confirmation = document.getElementById('confirmation'),
            submit = document.querySelector('button[type="submit"]'),
            submitDiv = submit.parentNode;

        confirmation.addEventListener('keyup', function (e) {
            if (e.target.value === confirm_string) {
                submitDiv.classList.remove('d-none');
                submit.removeAttribute('disabled');
            } else {
                submitDiv.classList.add('d-none');
                submit.setAttribute('disabled', 'disabled');
            }
        });

        delete_form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (confirmation.value === confirm_string) {
                delete_form.submit();
            }
        });

    </script>

</main>