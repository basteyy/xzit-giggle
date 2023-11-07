<?php
/**
 * Xzit Giggle
 *
 * This file `superuser.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 06.11.2023
 */
declare(strict_types=1);

$this->layout('layouts::setup', ['title' => 'Superuser']);

?>

<div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
    <div class="progress-bar" style="width: 50%"></div>
</div>


<nav aria-label="breadcrumb" class="mt-2 mt-md-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Welcome</a></li>
        <li class="breadcrumb-item"><a href="/setup/database/">Database</a></li>
        <li class="breadcrumb-item active" aria-current="page">Superuser</li>
    </ol>
</nav>

<h1>Superuser</h1>

<p class="lead lh-lg">
    Not really a superuser, but the first user. This user has all rights and can do everything. You can create more users later. This user doesnt have to be named "admin" or
    "root". You can choose any name you want. And also its not necessary, that this superuser has an corresponding system user. He will just manage the system on the web interface.
</p>

<form method="post" action="/setup/superuser/">
    <div class="row">
        <div class="col-12 col-md-6">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $superuser_data['username'] ?? '' ?>"
                   placeholder="admin" required aria-describedby="usernameHelp">
            <button class="btn btn-sm btn-secondary mt-2" type="button" onclick="generateUsername(true)">Generate random username</button>
            <div id="usernameHelp" class="form-text p-2">
                You will use the username for login into the system only. Nobody on the system will see your chosen username. Username may only contain letters, numbers,
                underscores and dashes.
            </div>
        </div>
        <div class="col-12 col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password"
                   placeholder="password" required aria-describedby="passwordHelp">
            <button class="btn btn-sm btn-secondary mt-2" type="button" onclick="generatePassword()">Generate password</button>
            <div id="passwordHelp" class="form-text p-2">
                Here it comes to security. Please choose a strong password. You can use the generated password or choose your own. You can change the password later.
            </div>
        </div>
    </div>

    <div class="my-2 my-md-4">
        <button type="submit" class="btn btn-sm btn-success">Next</button>
    </div>
</form>

<script>
    // create a random user name based on some nice words
    let attributes = 'fast,super,sexy,awesome,quick,little,angry',
        substantives = 'root,user,hero,admin,superus,girl,boy',
        changeInterval = null,
        passwordTimeout = null;

    // Username has a value? If not suggest one
    if (document.getElementById('username').value === '') {
        generateUsername();
    }

    // Stop on focus the field
    document.getElementById('username').addEventListener('focus', function () {
        clearInterval(changeInterval);
    });

    // Select all on click in username-field
    document.getElementById('username').addEventListener('click', function () {
        this.select();
    });

    function generatePassword() {

        // Clear timeout if exists
        if (passwordTimeout !== null) {
            clearTimeout(passwordTimeout);
        }

        let blockLength = 5,
            blocks = 3,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!§$%&/()=?*+#-_.:,;<>|",
            retVal = "";

        for (let block = 0, n = blocks; block < n; ++block) {

            if (block > 0) {
                retVal += ' ';
            }

            for (let i = 0, n = charset.length; i < blockLength; ++i) {
                retVal += charset.charAt(Math.floor(Math.random() * n));
            }
        }

        document.getElementById('password').value = retVal;

        // Make field fpr 5 secons text and turn it back
        document.getElementById('password').type = 'text';
        passwordTimeout = setTimeout(function () {
            document.getElementById('password').type = 'password';
        }, 5000);
    }

    function generateUsername(stop = false) {

        if (stop) {
            clearInterval(changeInterval);
        }

        let attribute = attributes.split(',')[Math.floor(Math.random() * attributes.split(',').length)],
            substantive = substantives.split(',')[Math.floor(Math.random() * substantives.split(',').length)];

        document.getElementById('username').value = attribute + ('-,_,+'.split(',')[Math.floor(Math.random() * 3)]) + substantive + ('-,_,+'.split(',')[Math.floor(Math.random() * 3)]) + Math.floor(Math.random() * 1000);
    }

    // Username only a-z, A-Z, 0-9, _ and - allowed
    document.getElementById('username').addEventListener('keyup', function () {
        this.value = this.value.replace(/[^a-zA-Z0-9+_-]/g, '');
    });

</script>