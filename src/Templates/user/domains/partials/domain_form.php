<?php
/**
 * Xzit Giggle
 *
 * This file `domain_form.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);


/** @var \basteyy\XzitGiggle\Models\Domain $domain */
?>
<form method="post">
    <div class="my-3">
        <label for="domain" class="form-label"><?= __('Domain') ?></label>
        <input type="text" class="form-control" id="domain" name="domain" placeholder="example.org"
               required aria-describedby="domainInfo" value="<?= $domain->getDomain() ?? '' ?>">
        <div id="domainInfo" class="p-2 form-text">
            <?= __('For example <code>example.org</code> or as a subdomain <code>sub.example.org</code>') ?>
        </div>
    </div>

    <!-- IP -->
    <div class="row">
        <div class="col-12 col-md-6">
            <h2 class="h4"><?= __('IPv4 Address') ?></h2>
            <?= $this->fetch('users::domains/partials/ipv4', ['domain' => $domain]) ?>
        </div>
        <div class="col-12 col-md-6">
            <h2 class="h4"><?= __('IPv6 Address') ?></h2>
            <?= $this->fetch('users::domains/partials/ipv6', ['domain' => $domain]) ?>
        </div>
    </div>

    <!-- Mounting Point -->
    <div class="my-3">
        <label for="mounting_point" class="form-label"><?= __('Mounting Point') ?></label>
        <div class="input-group">
            <div class="input-group-text"><?= $this->getUser()->getWebRoot() ?></div>
            <input type="text" class="form-control" id="mounting_point" name="mounting_point" placeholder="example.org/"
                   required aria-describedby="mounting_point_info" value="<?= $domain->getMountingPoint() ?? '' ?>">
        </div>

        <div id="mounting_point_info" class="p-2 form-text">
            <?= __('Inside your webroot folder, you can define, where the domain should be mounted. Common option is to use the domainname as a foldername') ?>
        </div>
    </div>

    <div class="my-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" name="www_alias" id="www_alias">
            <label class="form-check-label" for="www_alias">
                <?= __('Add www alias') ?> (<?= __('example.org and www.example.org') ?>)
            </label>
        </div>
    </div>

    <div class="my-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" name="lets_encrypt" id="lets_encrypt">
            <label class="form-check-label" for="lets_encrypt">
                <?= __('SSL via Lets Encrypt') ?>
            </label>
        </div>
    </div>

    <button class="my-3 btn btn-primary" type="submit"><?= __('Add') ?></button>
</form>
