<?php
/**
 * Xzit Giggle
 *
 * This file `env.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 11.11.2023
 */
declare(strict_types=1);

if (file_exists($env = ROOT .'/.env')) {
    ?>
    <div class="alert alert-danger">
        The file <code>.env</code> already exists. Please delete it first. <br>
        Perform <code data-mark>rm <?= $env ?></code>
    </div>
    <script>
        document.querySelector('code[data-mark]').addEventListener('click', function (elm) {
            // Select the text in code tag
            let range = document.createRange(),
                block = document.querySelector('code[data-mark]');
            range.selectNode(this);
            window.getSelection().addRange(range);

            // Copy text to clipboard
            navigator.clipboard.writeText(this.innerHTML);

            // add message
            this.innerHTML = 'Copied to clipboard';

            // reset after 5 secs
            setTimeout(function () {
                block.innerHTML = 'rm <?= $env ?>';
            }, (200 * 5));
        });
    </script>
    <?php
} else {
    ?>

    <div class="alert alert-success">
        The file <code>.env</code> does not exist.
    </div>
    <script>check++;</script>
    <?php
}
