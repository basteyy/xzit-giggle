<?php
/**
 * Xzit Giggle
 *
 * This file `404.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

$this->layout('layouts::extern', ['title' => 'Oops 404 - ' . __('Page not found')]);
?>
<div class="d-flex align-items-center justify-content-center" style="height: 50vh;">
    <div class="text-center">
        <h1 class="display-1 fw-bold">404</h1>
        <p class="fs-3"> <span class="text-danger">Opps!</span> Page not found.</p>
        <p class="lead">
            The page you’re looking for doesn’t exist.
        </p>
        <a href="/" class="btn btn-primary">Go Home</a>
    </div>
</div>