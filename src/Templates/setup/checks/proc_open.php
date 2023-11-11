<?php
/**
 * Xzit Giggle
 *
 * This file `proc_open.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 11.11.2023
 */
declare(strict_types=1);

/** check if proc_open is enabled */
if (function_exists('proc_open') && is_callable('proc_open')) {
    ?>
    <div class="alert alert-success">
        The function <code>proc_open</code> is enabled.
    </div>
    <script>check++;</script>
    <?php
} else {
    ?>
    <div class="alert alert-danger">
        The function <code>proc_open</code> is disabled. Please enable it.
    </div>
    <?php
}