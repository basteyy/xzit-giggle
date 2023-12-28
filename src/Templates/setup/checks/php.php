<?php
/**
 * Xzit Giggle
 * 
 * This file `php.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

/** check if php version is 8.3 and above */
if (version_compare(PHP_VERSION, REQUIRED_PHP_VERSION, '<')) {
    ?>
<div class="alert alert-danger">
    PHP <?= REQUIRED_PHP_VERSION ?> is required. Please update your PHP version. You use <?= PHP_VERSION ?>.
</div>
<?php
} else {
    ?>

<div class="alert alert-success">
    PHP <?= REQUIRED_PHP_VERSION ?> is installed. You use <?= PHP_VERSION ?>.
</div>
    <script>check++;</script>
<?php
}
