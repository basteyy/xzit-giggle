<?php
/**
 * Xzit Giggle
 *
 * This file `list_domains.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 09.11.2023
 */
declare(strict_types=1);

/** @var \basteyy\XzitGiggle\Models\Domain $domain */

$this->layout('layouts::default', [
    'title' => __('Domains'),
]);

?>
<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/" title="<?= __('Go to your dashboard') ?>"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/su/dashboard/"><?= __('Superuser Dashboard') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('Domains') ?></li>
        </ol>
    </nav>

    <h1><?= __('Domains') ?></h1>

    <table class="text-center table table-responsive table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-1 ">ID</th>
            <th class="col-3">User</th>
            <th class="col-3">Domain</th>
            <th class="col-2">Created at</th>
            <th class="col-1 ">Processed</th>
            <th class="col-1 ">Active</th>
            <th class="col-1 ">Blocked</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach (\basteyy\XzitGiggle\Models\DomainQuery::create()->find() as $domain) {
            ?>
        <tr>
            <td class=""><?= $domain->getId() ?></td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a href="/@<?= $domain->getUser()->getUsername() ?>" class="btn btn-primary btn-sm" title="<?= __('View public profile') ?>">
                        <i class="bi bi-person-circle"></i> <span class="visually-hidden"><?= __('View public profile') ?></span>
                    </a>
                    <a href="/su/users/view?u=<?= $domain->getUser()->getUsername() ?>" class="btn btn-primary btn-sm" title="<?= __('View user') ?>">
                        <i class="bi bi-person-vcard"></i> <span class="visually-hidden"><?= __('View user') ?></span>
                    </a>
                    <a href="/su/users/edit?u=<?= $domain->getUser()->getUsername() ?>" class="btn btn-primary btn-sm" title="<?= __('Edit user') ?>">
                        <i class="bi bi-person-gear"></i> <span class="visually-hidden"><?= __('Edit user') ?></span>
                    </a>
                </div>
                <span class="fw-bolder lh-lg mx-2"><?= $domain->getUser()->getUsername() ?> (#<?= $domain->getUserId() ?>)</span>
                <span class="badge bg-secondary"><?= $domain->getUser()->getUserRole()->getName() ?></span>
            </td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a href="<?= $domain->getDomain() ?>" class="btn btn-primary btn-sm" title="<?= __('Visit url') ?>" target="_blank" referrerpolicy="no-referrer">
                        <i class="bi bi-box-arrow-up-right"></i> <span class="visually-hidden"><?= __('Visit url') ?></span>
                    </a>
                    <a href="/su/domains/view?u=<?= $domain->getDomain() ?>" class="btn btn-primary btn-sm" title="<?= __('View Domain Details') ?>">
                        <i class="bi bi-postcard"></i> <span class="visually-hidden"><?= __('View Domain Details') ?></span>
                    </a>
                    <a href="/su/domains/edit?u=<?= $domain->getDomain() ?>" class="btn btn-primary btn-sm" title="<?= __('Edit Domains') ?>">
                        <i class="bi bi-house-gear"></i> <span class="visually-hidden"><?= __('Edit Domains') ?></span>
                    </a>
                </div>
                <span class="fw-bolder lh-lg mx-2"><?= $domain->getDomain() ?></span>
            </td>
            <td class=""><?= $domain->getRegistered(DEFAULT_DATETIME_FORMAT) ?></td>
            <td class=""><?= $domain->getProcessed() ? __('Yes') : __('No') ?></td>
            <td class=""><?= $domain->getActivated() ? __('Yes') : __('No') ?></td>
            <td class=""><?= $domain->getBlocked() ? __('Yes') : __('No') ?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</main>