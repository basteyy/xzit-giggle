<?php
/**
 * Xzit Giggle
 * 
 * This file `database.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

$this->layout('layouts::setup', ['title' => 'Database']);

?>

<div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
    <div class="progress-bar" style="width: 25%"></div>
</div>


<nav aria-label="breadcrumb" class="mt-2 mt-md-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Welcome</a></li>
        <li class="breadcrumb-item active" aria-current="page">Database</li>
    </ol>
</nav>

<h1>Database</h1>

<p class="lead lh-lg">
    Userdata, Posts, Comments and more are stored in a database. So we need to setup a database connection. Please fill out the form below.
</p>

<form method="post" action="/setup/database">
    <div class="row">
        <div class="col-7 col-md-4">
            <div class="my-2 my-md-4">
                <label for="host" class="form-label">Host</label>
                <input type="text" class="form-control" id="host" name="host" value="<?= $database_data['host'] ?? '' ?>"
                       placeholder="localhost" required aria-describedby="hostHelp">
                <div id="hostHelp" class="form-text p-2">
                    The host is the address of your database. If you are not sure, try <code>localhost</code>.
                </div>
            </div>
        </div>

        <div class="col-5 col-md-2">
            <div class="my-2 my-md-4">
                <label for="port" class="form-label">Port</label>
                <input type="number" class="form-control" id="port" name="port" placeholder="3306" value="<?= $database_data['port'] ?? '' ?>"
                       required aria-describedby="portHelp">
                <div id="portHelp" class="form-text p-2">
                    The port is the port of your database. If you are not sure, try <code>3306</code>.
                </div>
            </div>
        </div>


        <div class="col-7 col-md-4">
            <div class="my-2 my-md-4">
                <label for="database" class="form-label">Database</label>
                <input type="text" class="form-control" id="database" name="database" value="<?= $database_data['database'] ?? '' ?>"
                       placeholder="giggle" required aria-describedby="databaseHelp">
                <div id="databaseHelp" class="form-text p-2">
                    With database we mean the schema name. Make sure the schema exists and the user has access to it.
                </div>
            </div>
        </div>

        <div class="col-5 col-md-2">
            <div class="my-2 my-md-4">
                <label for="charset" class="form-label">Charset</label>
                <select class="form-select" id="charset" name="charset" required>
                    <option <?= isset($database_data['charset']) && $database_data['charset'] === 'utf8mb4' ? 'selected ' : '' ?>value="utf8mb4">utf8mb4</option>
                    <option <?= isset($database_data['charset']) && $database_data['charset'] === 'utf8' ? 'selected ' : '' ?>value="utf8">utf8</option>
                    <option <?= isset($database_data['charset']) && $database_data['charset'] === 'latin1' ? 'selected ' : '' ?>value="latin1">latin1</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="my-2 my-md-4">
                <label for="user" class="form-label">User</label>
                <input type="text" class="form-control" id="user" name="user" placeholder="root"  value="<?= $database_data['user'] ?? '' ?>"
                       required>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-2 my-md-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="password"  value="<?= $database_data['password'] ?? '' ?>"
                       required>
            </div>
        </div>
    </div>

    <div class="my-2 my-md-4">
        <button type="submit" class="btn btn-sm btn-success">Next</button>
    </div>
</form>
