<?php
/**
 * Xzit Giggle
 *
 * This file `user_form.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

/** @var \basteyy\XzitGiggle\Models\User $user */

if (!isset($user)) {
    throw new \InvalidArgumentException('User must be set');
}

if ($this->getUser()->getId() === $user->getId()) {
    echo '<div class="alert alert-info my-3">' . __('This is your own account. You cannot change a few things.') . '</div>';
}

?>
<form method="post">
    <div class="my-3">
        <label for="username" class="form-label"><?= __('Username') ?></label>
        <input type="text" name="username" id="username"  <?= $this->getUser()->getId() === $user->getId() ? 'disabled="disabled"' : '' ?>
               required placeholder="<?= __('Username of the user') ?>"
               class="form-control" value="<?= $user->getUsername() ?? '' ?>">
    </div>
    <div class="my-3">
        <label for="email" class="form-label"><?= __('E-Mail') ?></label>
        <input type="email" name="email" id="email" required placeholder="<?= __('E-Mail of the user') ?>"
               class="form-control" value="<?= $user->getEmail() ?? '' ?>">
    </div>
    <div class="my-3">
        <label for="user_role" class="form-label"><?= __('User role') ?></label>
        <select name="user_role" id="user_role" class="form-select" required aria-label="<?= __('Select the user role') ?>" <?= $this->getUser()->getId() === $user->getId() ? 'disabled="disabled"' : '' ?>>
            <?php
            foreach (\basteyy\XzitGiggle\Models\UserRoleQuery::create()->find() as $user_role) {
                printf('<option %s value="%s">%s</option>', $user_role->getId() === $user->getUserRoleId() ? 'selected': '', $user_role->getId(), $user_role->getIdentifier());
            }
            ?>
        </select>
    </div>
    <div class="my-3 form-check">
        <input class="form-check-input" type="checkbox" value="1" <?= $this->getUser()->getId() === $user->getId() ? 'disabled="disabled"' : '' ?>
               id="activated" name="activated" <?= $user->getActivated() ? 'checked':'' ?>>
        <label class="form-check-label" for="activated">
            <?= __('Activated') ?> - <?= __('If this is not checked, the user will not be able to log in. System resources will be created with the next server sync.') ?>
        </label>
    </div>
    <div class="my-3 form-check">
        <input class="form-check-input" type="checkbox" value="1" <?= $this->getUser()->getId() === $user->getId() ? 'disabled="disabled"' : '' ?>
               id="blocked" name="blocked" <?= $user->getBlocked() ? 'checked':'' ?>>
        <label class="form-check-label" for="blocked">
            <?= __('Blocked') ?> - <?= __('User will be blocked. Account is created, he can login, but no resources are used') ?>
        </label>
    </div>
    <div class="my-3 form-check">
        <input data-password-field-toggle class="form-check-input" type="checkbox" value="1" id="set_password" name="set_password">
        <label class="form-check-label" for="set_password">
            <?= __('Set a password') ?> - <?= __('Otherwise the user needs to use "reset password" to login') ?>
        </label>
    </div>
    <div class="my-3 d-none" data-password-field>
        <label for="password" class="form-label"><?= __('Password') ?></label>
        <input type="password" name="password" id="password" placeholder="<?= __('Password of the user') ?>"
               class="form-control">
    </div>


    <h2 class="h3 my-3 mt-md-5"><?= __('Webhosting relevant details') ?></h2>
    <p class="lead lh-lg">
        The following settings are essential for the webhosting of the user. If you are not sure what to do, leave the default values.
    </p>

    <div class="my-3">
        <label class="form-label" for="home_folder">home_folder</label>
        <input type="text" name="home_folder" id="home_folder" required class="form-control"
               value="<?= $user->getHomeFolder() ?? ''?>" aria-describedby="home_folder_help">
        <div class="p-2 form-text" id="home_folder_help">
            Setting for users <code>`home_folder`</code>
        </div>
    </div>
    <div class="my-3">
        <label class="form-label" for="log_folder">log_folder</label>
        <input type="text" name="log_folder" id="log_folder" required class="form-control"
               value="<?= $user->getLogFolder() ?? ''?>" aria-describedby="log_folder_help">
        <div class="p-2 form-text" id="log_folder_help">
            Setting for users <code>`log_folder`</code>
        </div>
    </div>
    <div class="my-3">
        <label class="form-label" for="web_folder">web_folder</label>
        <input type="text" name="web_folder" id="web_folder" required class="form-control"
               value="<?= $user->getWebFolder() ?? ''?>" aria-describedby="web_folder_help">
        <div class="p-2 form-text" id="web_folder_help">
            Setting for users <code>`web_folder`</code>
        </div>
    </div>
    <div class="my-3">
        <label class="form-label" for="bash">bash</label>
        <input type="text" name="bash" id="bash" required class="form-control"
               value="<?= $user->getBash() ?? ''?>" aria-describedby="bash_help">
        <div class="p-2 form-text" id="bash_help">
            Setting for users <code>`bash`</code>
        </div>
    </div>
    <div class="my-3">
        <label class="form-label" for="php_fpm_pool">php_fpm_pool</label>
        <input type="text" name="php_fpm_pool" id="php_fpm_pool" required class="form-control"
               value="<?= $user->getPhpFpmPool() ?? ''?>" aria-describedby="php_fpm_pool_help">
        <div class="p-2 form-text" id="php_fpm_pool_help">
            Setting for users <code>`php_fpm_pool`</code>
        </div>
    </div>
    <div class="my-3">
        <label class="form-label" for="php_fpm_socket">php_fpm_socket</label>
        <input type="text" name="php_fpm_socket" id="php_fpm_socket" required class="form-control"
               value="<?= $user->getPhpFpmSocket() ?? ''?>"
                                                                                                                                            aria-describedby="php_fpm_socket_help">
        <div class="p-2 form-text" id="php_fpm_socket_help">
            Setting for users <code>`php_fpm_socket`</code>
        </div>
    </div>
    <div class="my-3">
        <label class="form-label" for="php_fpm_port">php_fpm_port</label>
        <input type="text" name="php_fpm_port" id="php_fpm_port" required class="form-control"
               value="<?= $user->getPhpFpmPort() ?? ''?>" aria-describedby="php_fpm_port_help">
        <div class="p-2 form-text" id="php_fpm_port_help">
            Setting for users <code>`php_fpm_port`</code>
        </div>
    </div>


    <div class="my-3 text-end">
        <button class="btn btn-primary" type="submit"><i class="bi bi-person-add"></i> <?= __('Save') ?></button>
    </div>
</form>


<script>
    const passwordField = document.querySelector('[data-password-field]'),
            password = document.querySelector('input[name="password"]'),
          passwordFieldToggle = document.querySelector('[data-password-field-toggle]');

    passwordFieldToggle.addEventListener('change', function () {
        if (this.checked) {
            passwordField.classList.remove('d-none');
            // make password required
            password.setAttribute('required', 'required');
        } else {
            passwordField.classList.add('d-none');
            // unrequire password
            password.removeAttribute('required');
        }
    });

    if (passwordFieldToggle.checked) {
        passwordField.classList.remove('d-none');
    }

    let old_username = document.querySelector('#username').value,
        username = document.querySelector('#username'),
        home_folder = document.querySelector('#home_folder'),
        log_folder = document.querySelector('#log_folder'),
        web_folder = document.querySelector('#web_folder'),
        php_fpm_pool = document.querySelector('#php_fpm_pool'),
        php_fpm_socket = document.querySelector('#php_fpm_socket');

    // Replace `old_username` with new username, when `username` changes
    username.addEventListener('change', function () {
        home_folder.value = home_folder.value.replace(old_username, this.value);
        log_folder.value = log_folder.value.replace(old_username, this.value);
        web_folder.value = web_folder.value.replace(old_username, this.value);
        php_fpm_pool.value = php_fpm_pool.value.replace(old_username, this.value);
        php_fpm_socket.value = php_fpm_socket.value.replace(old_username, this.value);

        old_username = this.value;
    });



</script>