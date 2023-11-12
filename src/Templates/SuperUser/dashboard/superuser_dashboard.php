<?php
/**
 * Xzit Giggle
 *
 * This file `superuser_dashboard.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

$this->layout('layouts::default', [
    'title' => __('Superuser Dashboard')
]);

?>
<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/" title="<?= __('Go to your dashboard') ?>"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('Superuser Dashboard') ?></li>
        </ol>
    </nav>



    <h1>Hi mighty <?= $this->getUser()->getUsername() ?></h1>

    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <h2>Setup</h2>
            <table class="table table-responsive table-striped">
                <tr>
                    <td class="col-6">Installed on</td>
                    <td><?= file_get_contents(ROOT .'/.setup') ?></td>
                </tr>
                <tr>
                    <td class="col-6">Installed by Username</td>
                    <td><?= (\basteyy\XzitGiggle\Models\UserQuery::create()->findOneById(1))->getUsername() ?? 'USer deleted' ?></td>
                </tr>
            </table>
            <h3>Cron</h3>
            <table class="table table-responsive table-striped">
                <tr>
                    <td class="col-6"><code data-copy>giggle sync-all</code></td>
                    <td><?= \basteyy\XzitGiggle\Helper\Config::get('sync-all.last_execution') ?? __('Never') ?></td>
                </tr>
            </table>

            <div class="alert alert-info">
                You should run the commands here: <code><?= ROOT ?></code>. Perhaps you need to use <code>sudo</code> and <code>php</code>: <br />
                <code data-copy>sudo php <?= ROOT ?>/giggle sync-all</code>.
            </div>

        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <h2>PHP-Info</h2>
            <table class="table table-responsive table-striped">
                <tr>
                    <td>PHP Version</td>
                    <td><?= phpversion() ?></td>
                </tr>
                <tr>
                    <td>PHP Memory Limit</td>
                    <td><?= ini_get('memory_limit') ?></td>
                </tr>
                <tr>
                    <td>PHP Max Execution Time</td>
                    <td><?= ini_get('max_execution_time') ?></td>
                </tr>
                <tr>
                    <td>PHP Max Input Time</td>
                    <td><?= ini_get('max_input_time') ?></td>
                </tr>
                <tr>
                    <td>PHP Post Max Size</td>
                    <td><?= ini_get('post_max_size') ?></td>
                </tr>
                <tr>
                    <td>PHP Upload Max Filesize</td>
                    <td><?= ini_get('upload_max_filesize') ?></td>
                </tr>
            </table>
            <?= $this->fetch('setup::checks/php') ?>
            <?= $this->fetch('setup::checks/env') ?>
            <?= $this->fetch('setup::checks/proc_open') ?>
            <?= $this->fetch('setup::checks/ext-pdo') ?>
            <?= $this->fetch('setup::checks/ext-json') ?>
            <?= $this->fetch('setup::checks/ext-posix') ?>
        </div>
        <div class="col-12 col-md-6 col-lg-4"><h2>Domain Info</h2>

            <?php
            $domains = \basteyy\XzitGiggle\Models\DomainQuery::create();
            ?>

            <table class="table table-responsive table-striped">
                <tr>
                    <td>Domains in Database</td>
                    <td><?= $domains->count() ?></td>
                </tr>
                <tr>
                    <td>Domains not processed</td>
                    <td><?= $domains
                            ->filterByProcessed(false)->count() ?>
                    </td>
                </tr>
                <tr>
                    <td>Users</td>
                    <td><?= \basteyy\XzitGiggle\Models\UserQuery::create()->count() ?></td>
                </tr>
            </table>
        </div>
        <div class="col-12 col-md-6 col-lg-4"></div>
    </div>
</main>

<script>
    // Dom Ready
    document.addEventListener("DOMContentLoaded", function () {
        // copy on click on [data-copy] element innerText
        document.querySelectorAll('[data-copy]').forEach((el) => {
            el.addEventListener('click', () => {
                navigator.clipboard.writeText(el.innerText);

                // InnerText change to "Copied" and changed back after 1s
                const oldText = el.innerText;
                el.innerText = 'Copied';
                setTimeout(() => {
                    el.innerText = oldText;
                }, 1000);


            });

            // Add bootstrap 5.3 tooltip to element
            el.setAttribute('data-bs-toggle', 'tooltip');
            el.setAttribute('data-bs-title', 'Copy to clipboard');
        });

        // init all tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

