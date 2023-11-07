<?php
/**
 * Xzit Giggle
 *
 * This file `options.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 06.11.2023
 */
declare(strict_types=1);

$this->layout('layouts::setup', ['title' => 'Options']);

?>

<div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
    <div class="progress-bar" style="width: 75%"></div>
</div>


<nav aria-label="breadcrumb" class="mt-2 mt-md-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Welcome</a></li>
        <li class="breadcrumb-item"><a href="/setup/database/">Database</a></li>
        <li class="breadcrumb-item"><a href="/setup/superuser/">Superuser</a></li>
        <li class="breadcrumb-item active" aria-current="page">Options</li>
    </ol>
</nav>

<h1>Options</h1>

<p class="lead lh-lg">
    Important additional settings for your webhosting.
</p>

<form method="post" action="/setup/options/" class="my-3 my-md-5">
    <h2 class="h4 my-2">IP Addresses</h2>

    <p class="lead lh-lg">
        Hopefully you know what an IP is. For mounting domains on this server, you need to define at least one IPv4 Address. The server will listen with the
        <code>server_name domainname</code> in that ip (<code>listen 127.0.0.1:80;</code>).
    </p>

    <div class="my-3">
        <label for="ipv4_addresses" class="form-label">IPv4 Addresses</label>
        <textarea type="text" class="form-control" id="ipv4_addresses" name="ipv4_addresses" placeholder="127.0.0.1" required
                  aria-describedby="v4_help"><?= $ipv4_addresses ?? '' ?></textarea>
        <div id="v4_help" class="p-2 form-text">
            You need to define at leas one IPv4 Address. You can add more than one IPv4 Address by separating them by new lines. Detailed access/usage of the addresses can be configured later.
        </div>
    </div>

    <div class="my-3">
        <label for="ipv6_addresses" class="form-label">IPv6 Addresses</label>
        <textarea type="text" class="form-control" id="ipv6_addresses" name="ipv6_addresses" placeholder=""
                  aria-describedby="v6_help"><?= $ipv6_addresses ?? '' ?></textarea>
        <div id="v6_help" class="p-2 form-text">
            You can add more than one IPv6 Address by separating them by new lines. Detailed access/usage of the addresses can be configured later. If you don't have any IPv6 Addresses, you can leave this field empty.
        </div>
    </div>

    <h2 class="h4 my-3 mt-md-5">Paths and folders</h2>
    <div class="my-3">
        <label for="webroot_path" class="form-label">Webroot path</label>
        <input type="text" id="webroot_path" name="webroot_path" class="form-control" placeholder="/var/www/virtual/"
               aria-describedby="webroot_path_help" value="<?= $webroot_path ?? '/var/www/virtual/' ?>">
        <div id="webroot_path_help" class="p-2 form-text">
            The root folder for all webroot folders from the users (<code>/var/www/virtual/username/</code>)
        </div>
    </div>

    <div class="my-3">
        <label for="user_home_path" class="form-label">User home path</label>
        <input type="text" id="user_home_path" name="user_home_path" class="form-control" placeholder="/home/"
               aria-describedby="user_home_path_help" value="<?= $user_home_path ?? '/home/' ?>">
        <div id="user_home_path_help" class="p-2 form-text">
            The root folder for all user home folders (<code>/home/username/</code>)
        </div>
    </div>

    <div class="my-3">
        <label for="users_bash" class="form-label">Users bash</label>
        <input type="text" id="users_bash" name="users_bash" class="form-control" placeholder="/bin/bash"
               aria-describedby="users_bash_help" value="<?= $users_bash ?? '/bin/bash' ?>">
        <div id="users_bash_help" class="p-2 form-text">
            The bash for all users (<code>/bin/bash</code>). You can use <code>/bin/false</code> to disable shell access for all users. But since FTP is not supported, this is not recommended.
        </div>
    </div>


    <h2 class="h4 my-3 mt-md-5">Other options</h2>

    <div class="my-3 form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="allow_user_login" name="allow_user_login" value="1">
        <label class="form-check-label" for="allow_user_login">Allow users to login (or only superusers?)</label>
    </div>

    <div class="my-3 form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="allow_users_domain_adding" name="allow_users_domain_adding" value="1">
        <label class="form-check-label" for="allow_users_domain_adding">Allow users to add domains by themselves?</label>
    </div>

    <div class="my-2 my-md-4">
        <button type="submit" class="btn btn-sm btn-success">Next</button>
    </div>
</form>