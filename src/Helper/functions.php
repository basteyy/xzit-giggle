<?php
/**
 * Xzit Giggle
 * 
 * This file `functions.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

/**
 * Function takes `$dsn` and returns `true` if the connection to the database is working and `$schema` exists.
 * @param string $dsn
 * @param string $username
 * @param string $password
 * @param string $schema
 * @param bool $return_connection
 * @return PDO
 */
function isWorkingDatabaseConnection(string $dsn,               // Database DSN (Data Source Name)
                                     string $username,          // Database User
                                     string $password,          // Database Password
                                     string $schema,            // Database Schema
                                     bool   $return_connection = false): PDO|bool
{
    try {
        $pdo = new PDO($dsn, $username, $password, ['charset' => 'utf8mb4']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->query('USE ' . $schema);

        if ($return_connection) {
            return $pdo;
        }

        return true;
    } catch (PDOException $e) {
        return false;
    }
}


/**
 * Function checks if the setup indicator file exists and return state.
 * @todo Find a better way to check if the setup is done.
 * @return bool
 */
function isSetUp() : bool {
    return file_exists(SETUP_INDICATOR_FILE);
}

function setSetUp() : void {
    if (isSetUp()) {
        throw new \http\Exception\RuntimeException('Setup already done. Dont touch the setup again.');
    }
    file_put_contents(SETUP_INDICATOR_FILE, date('Y-m-d H:i:s'));
}