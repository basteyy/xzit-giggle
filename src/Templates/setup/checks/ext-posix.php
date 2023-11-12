<?php
/**
 * Xzit Giggle
 *
 * This file `ext-posix.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 12.11.2023
 */
declare(strict_types=1);

/** check if posix extension is installed */
if (!extension_loaded('posix')) {
    ?>
    <div class="alert alert-danger">
        The PHP extension <code>posix</code> is not installed. Please install it.
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-success">
        The PHP extension <code>posix</code> is installed.
    </div>
    <script>check++;</script>
    <?php
}


