<?php
/**
 * Xzit Giggle
 *
 * This file `navigation.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            Xzit Giggle
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a
                            class="nav-link" aria-current="page" title="<?= __('Go to Dashboard') ?>"
                            href="/dashboard/"><?= __('Dashboard') ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= __('Domains') ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (\basteyy\XzitGiggle\Helper\Config::get('allow_users_domain_adding')) { ?>
                            <li><a class="dropdown-item" href="/domains/add/"><?= __('Add a Domain') ?></a></li>
                        <?php } ?>
                        <li><a class="dropdown-item" href="/domains/"><?= __('List all Domains') ?></a></li>
                    </ul>
                </li>
            </ul>

            <?php
            if ($this->getUser()->isAdmin()) {
                ?>
                <ul class="navbar-nav ms-auto me-0 mb-2 mb-lg-0">
                    <li class="nav-item dropdown dropstart">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= __('Superuser') ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/su/dashboard/"><i class="bi bi-controller"></i> <?= __('Dashboard') ?></a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-header"><?= __('Services') ?></li>
                            <li><a class="dropdown-item" href="/su/users/"><i class="bi bi-person-gear"></i> <?= __('Users') ?></a></li>
                            <li><a class="dropdown-item" href="/su/domains/"><i class="bi bi-globe"></i> <?= __('Domains') ?></a></li>
                            <li><a class="dropdown-item" href="/su/databases/"><i class="bi bi-database-gear"></i> <?= __('Databases') ?></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/su/settings/"><i class="bi bi-gear"></i> <?= __('Settings  ') ?></a></li>
                        </ul>
                    </li>
                </ul>
            <?php
            } ?>

            <div class="text-end ms-md-3 btn-group">

                <a href="/@<?= $this->getUser()->getUsername() ?>" title="<?= __('Your Profile') ?>"
                   class="btn btn-sm btn-outline-light">Hi <strong><?= $this->getUser()->getUsername() ?></strong></a>
                <a href="/settings/" title="<?= __('Change your personal settings') ?>"
                   class="btn btn-sm btn-outline-light"><i class="bi bi-gear"></i> <span class="visually-hidden"><?= __('Settings')
                        ?></span> </a>

                <a href="/logout/" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-lock"></i> <span class="visually-hidden"><?= __('Logout') ?></span>
                </a>
            </div>

            <!--<form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>-->
        </div>
    </div>
</nav>
