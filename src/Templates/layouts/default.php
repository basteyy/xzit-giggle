<?php
/**
 * Xzit Giggle
 * 
 * This file `layout.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

?><!doctype html>
<html lang="de" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Hallo' ?></title>
<link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>

    <?= $this->fetch('layouts::partials/navigation') ?>
</header>
<main class="container-lg mt-5 pt-5">
    <?= $this->fetch('layouts::partials/flash_messages') ?>
    <?= $this->section('content') ?>
</main>


<?= $this->fetch('layouts::partials/footer') ?>
<link href="/css/bootstrap-icons.min.css" rel="stylesheet">
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>