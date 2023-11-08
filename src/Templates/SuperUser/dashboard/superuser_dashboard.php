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
            <li class="breadcrumb-item"><a href="/dashboard/"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('Superuser Dashboard') ?></li>
        </ol>
    </nav>



    <h1>Hi mighty <?= $this->getUser()->getUsername() ?></h1>


    <h2>Domain Info</h2>

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


</main>

