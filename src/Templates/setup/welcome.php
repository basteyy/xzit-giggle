<?php
/**
 * Xzit Giggle
 * 
 * This file `welcome.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

$this->layout('layouts::setup', ['title' => 'Set-up']);

?>

<h1>Welcome to Xzit Giggle</h1>

<p class="lead lh-lg">
    Xzit Giggle is a simple and lightweight webhosting control panel. It comes with just basic functions and is easy to use. Its not for big projects, but for small ones. In
    case webhosting is just your side hustle, Xzit Giggle could be the right choice for you.
</p>

<h2 class="my-3 my-md-5 h3">Systemchecks</h2>

<div class="alert alert-warning">
    Because nginx is cool, xzit giggle is not compatible with apache. You need to use nginx. Sorry for not being sorry.
</div>

<script>let check = 0;</script>

<?= $this->fetch('setup::checks/php') ?>
<?= $this->fetch('setup::checks/env') ?>
<?= $this->fetch('setup::checks/proc_open') ?>
<?= $this->fetch('setup::checks/ext-pdo') ?>
<?= $this->fetch('setup::checks/ext-json') ?>
<?= $this->fetch('setup::checks/ext-posix') ?>

<a class="btn btn-sm"></a>

<script>
    if (check === 6) {
        document.querySelector('.btn').classList.add('btn-success');
        document.querySelector('.btn').classList.remove('btn-danger');
        document.querySelector('.btn').innerText = 'Continue';
        document.querySelector('.btn').href = '/setup/database';
    } else {
        document.querySelector('.btn').classList.add('btn-danger');
        document.querySelector('.btn').classList.remove('btn-success');
        document.querySelector('.btn').innerText = 'Retry';
        document.querySelector('.btn').href = '/?retry=' + Math.floor(Date.now() / 1000);
    }
</script>
<div class="mt-3 mt-md-5 row fw-lighter">
    <div class="col-12 col-md-6">
        <h2 class="my-3 h3">Help</h2>
        <p>
            If you need help, you can visit the <a href="https://xzit.de/giggle" target="_blank" rel="noopener noreferrer">website</a> or the <a href="https://xzit.de/giggle/docs"
                                                                                                                                                 target="_blank" rel="noopener noreferrer">documentation</a>.
            If you have any questions, you can ask them on <a href="https://github.com/basteyy/xzit-giggle"
                                                              target="_blank" rel="noopener noreferrer">github.com/basteyy/xzit-giggle</a>.
        </p>
    </div>
    <div class="col-12 col-md-6">
        <h2 class="my-3 h3">License</h2>
        <p>
            Xzit Giggle is licensed under the <a href="https://creativecommons.org/publicdomain/zero/1.0/" target="_blank" rel="noopener noreferrer">CC0 1.0 Universal</a> license.
            This means you can do whatever you want with it. You can use it for commercial projects, you can modify it, you can sell it, you can do whatever you want with it. You don't
            even have to give credits to the original author. But you can if you want to.
        </p>
    </div>
</div>

