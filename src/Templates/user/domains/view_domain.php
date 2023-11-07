<?php
/**
 * Xzit Giggle
 *
 * This file `view_domain.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

/** @var \basteyy\XzitGiggle\Models\Domain $domain */

$this->layout('layouts::default', [
    'title' => __('View domain %s', $domain->getDomain())
]);

?>

<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/domains/"><?= __('List Domains') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('View domain %s', $domain->getDomain()) ?></li>
        </ol>
    </nav>

    <div class="float-end">
        <a class="btn btn-primary" href="<?= $this->url('/domains/edit?d=' . $domain->getDomain()) ?>"
           title="<?= __('Edit this Domain') ?>">
            <i class="bi bi-pencil"></i> <?= __('Edit') ?>
        </a>
    </div>

    <h1><?= __('View domain %s', $domain->getDomain()) ?></h1>

    <p class="lead lh-lg">
        You are viewing the domain <strong><?= $domain->getDomain() ?></strong>.
    </p>

    <table class="table table-striped table-responsive">
        <tr>
            <td class="col-4 col-md-5"><?= __('TLD') ?></td>
            <td class="col-8 col-md-7"><?= $domain->getTld() ?></td>
        </tr>
        <tr>
            <td class="col-4 col-md-5"><?= __('Domainname') ?></td>
            <td class="col-8 col-md-7"><?= $domain->getDomain() ?></td>
        </tr>
        <tr>
            <td class="col-4 col-md-5"><?= __('Status') ?></td>
            <td class="col-8 col-md-7"><?= $domain->getActivated() ? __('Active') : __('Inactive') ?></td>
        </tr>
        <tr>
            <td class="col-4 col-md-5"><?= __('Registered') ?></td>
            <td class="col-8 col-md-7"><?= $domain->getRegistered(DEFAULT_DATETIME_FORMAT) ?></td>
        </tr>
        <tr>
            <td class="col-4 col-md-5"><?= __('www-Alias active?') ?></td>
            <td class="col-8 col-md-7"><?= $domain->getWwwAlias() ? __('yes') : __('no') ?></td>
        </tr>
        <tr>
            <td class="col-4 col-md-5"><?= __('IPv4') ?></td>
            <td class="col-8 col-md-7"><?= \basteyy\XzitGiggle\Models\IpAddressQuery::create()->findOneById($domain->getIpv4())->getAddress() ?></td>
        </tr>
        <tr>
            <td class="col-4 col-md-5"><?= __('IPv6') ?></td>
            <td class="col-8 col-md-7"><?= $domain->getIpv6() ? \basteyy\XzitGiggle\Models\IpAddressQuery::create()->findOneById($domain->getIpv6())->getAddress() : __('not active') ?></td>
        </tr>
        <tr>
            <td class="col-4 col-md-5"><?= __('Mounting Point') ?></td>
            <td class="col-8 col-md-7"><?= $domain->getUser()->getWebRoot() . $domain->getMountingPoint() ?></td>
        </tr>
        <tr>
            <td class="col-4 col-md-5"><?= __('SSL') ?></td>
            <td class="col-8 col-md-7"><?= $domain->getLetsEncrypt() ? __('Activated') : __('Deactivated') ?></td>
        </tr>
        <tr>
            <td class="col-4 col-md-5"><?= __('Sever Config') ?></td>
            <td class="col-8 col-md-7"><pre><code><?= $domain->getServerConfig() ?></code></pre></td>
        </tr>
    </table>

</main>