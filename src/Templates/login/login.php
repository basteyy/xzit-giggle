<?php
/**
 * Xzit Giggle
 * 
 * This file `login.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

$this->layout('layouts::extern', [
    'title' => 'Login'
]);

?>
<div style="max-width: 32rem;">
    <form method="post" action="<?= $this->url('/') ?>">
        <div class="mb-3">
            <label for="username" class="form-label"><?= __('Username') ?></label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><?= __('Password') ?></label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary"><?= __('Login') ?></button>
    </form>

    <hr class="my-3 my-md-5" />
    <p>
        <a href=""><?= __('Lost login credentials?') ?></a> | <a href=""><?= __('User Handbook') ?></a>
    </p>
</div>