<?php
/**
 * Xzit Giggle
 * 
 * This file `constants.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__, 2));
}

const PHP_TAB = "\t";

/** Cache Folder */
const CACHE = ROOT . '/.cache';

/** Default Permission for new folders */
const CACHE_FILE_PERMISSIONS = 0640;

/** Folder Permission for new created cache folder */
const CACHE_FOLDER_PERMISSIONS = 0750;

const BUILD_FOLDER = ROOT . '/.build';

/** Set-up indicator-file */
const SETUP_INDICATOR_FILE = ROOT . '/.setup';

/** Required PHP-Version */
const REQUIRED_PHP_VERSION = '8.3.0';

/**  */
const USER_SESSION_IDENTIFIER = 'user';

/** Default format of DateTime Objects */
const DEFAULT_DATETIME_FORMAT = 'Y-m-d H:i:s';

/** The default algorithmic which is used to hash user password */
const USED_PASSWORD_HASHING_ALGO = PASSWORD_ARGON2ID;