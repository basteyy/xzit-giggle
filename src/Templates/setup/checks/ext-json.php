<?php
/**
 * Xzit Giggle
 * 
 * This file `ext-json.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 06.11.2023
 */
declare(strict_types=1);

/** check if json extension is installed */
if (!extension_loaded('json')) {
    ?>
    <div class="alert alert-danger">
        The PHP extension `json` is not installed. Please install it.
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-success">
        The PHP extension `json` is installed.
    </div>
    <script>check++;</script>
    <?php
}
