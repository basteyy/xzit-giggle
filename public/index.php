<?php
/**
 * Xzit Giggle
 * 
 * This file `index.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

if (!file_exists($kernel = dirname(__DIR__ ) . '/src/kernel.php')) {
    die('Kernel not found');
}

require_once $kernel;