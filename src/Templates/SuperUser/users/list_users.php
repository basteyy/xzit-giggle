<?php
/**
 * Xzit Giggle
 *
 * This file `list_users.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

use basteyy\XzitGiggle\Models\UserQuery;

$this->layout('layouts::default', [
    'title' => __('Superuser Dashboard')
]);

?>
<main class="container-xxl">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/"><?= __('Dashboard') ?></a></li>
            <li class="breadcrumb-item"><a href="/su/dashboard/"><?= __('Superuser Dashboard') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= __('Users') ?></li>
        </ol>
    </nav>


    <a class="btn btn-sm btn-secondary float-end" href="/su/users/add">
        <i class="bi bi-person-add"></i> <?= __('Add a User') ?>
    </a>

    <h1>Manage Users</h1>

    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <th>User-ID</th>
            <th>User-Role</th>
            <th>Username</th>
            <th>E-Mail</th>
            <th>Last Login Details</th>
            <th>Activated</th>
            <th>Blocked</th>
        </tr>
        </thead>
        <tbody>
        <?php
        /** @var \basteyy\XzitGiggle\Models\User $user */
        foreach (UserQuery::create()->find() as $user) {

            if ($user->getIsDeleteCandidate()) {
                continue;
            }

            ?>
            <tr>
                <td><?= $user->getId() ?></td>
                <td><?= $user->getUserRole()->getIdentifier() ?></td>
                <td>
                    <strong class="d-block mb-2"><?= $user->getUsername() ?></strong>
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-sm btn-secondary" href="/su/users/view?u=<?= $user->getUsername() ?>">View</a>
                        <a class="btn btn-sm btn-secondary" href="/su/users/edit?u=<?= $user->getUsername() ?>">Edit</a>
                        <a class="btn btn-sm btn-secondary" href="/@<?= $user->getUsername() ?>" target="_blank">Public Profil</a>
                        <a class="btn btn-sm btn-danger" href="/su/users/delete?u=<?= $user->getUsername() ?>">Delete</a>
                    </div>
                </td>
                <td>
                    <abbr data-mail="<?= $user->getEmail() ?>"
                          title="CLick to show">...@<?= substr($user->getEmail(), strpos($user->getEmail(), '@') + 1) ?></abbr>
                </td>
                <td><?= $user->getLastLoginNice() ?></td>
                <td><?= $user->getActivated() ? '<i class="bi bi-check-circle text-success"></i>' : '<i class="bi bi-x-circle text-danger"></i>' ?></td>
                <td><?= $user->getBlocked() ? '<i class="bi bi-check-circle text-success"></i>' : '<i class="bi bi-x-circle text-danger"></i>' ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>


</main>

<script>
    document.querySelectorAll('abbr[data-mail]').forEach((el) => {
        el.addEventListener('click', (e) => {
            let old = e.target.innerHTML;
            e.preventDefault();
            e.target.innerHTML = e.target.dataset.mail;
            setTimeout(() => {
                e.target.innerHTML = old;
            }, 5000);
        })
    });
    document.querySelectorAll('abbr[data-ip]').forEach((el) => {
        el.addEventListener('click', (e) => {
            let old = e.target.innerHTML;
            e.preventDefault();
            e.target.innerHTML = e.target.dataset.ip;
            setTimeout(() => {
                e.target.innerHTML = old;
            }, 5000);
        })
    });
</script>