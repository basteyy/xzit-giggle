<?php
/**
 * Xzit Giggle
 *
 * This file `SystemTrait.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 11.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\bin\Traits;

trait SystemTrait
{
    use ShellTrait;

    protected function reloadPhp(float $version = null) : void {

        if (!$version) {
            $versions = [7.4, 8.0, 8.1, 8.2, 8.3];
            foreach ($versions as $version) {
                $this->reloadPhp($version);
            }
        } else {
            $this->writer()->comment(__('Reloading php %s ...', $version), true);
            $this->runShellCmd('systemctl reload '. sprintf('php%1$s-fpm', $version));
            $this->writer()->comment('Php reloaded', true);
        }

    }

    protected function restartPhp() : void {
        $this->writer()->comment('Restarting php ...', true);
        $this->runShellCmd('systemctl restart php');
        $this->writer()->comment('Php restarted', true);
    }

    protected function reloadNginx() : void {
        $this->writer()->comment('Reloading nginx ...', true);
        $this->runShellCmd('systemctl reload nginx');
        $this->writer()->comment('Nginx reloaded', true);
    }

    protected function restartNginx() : void {
        $this->writer()->comment('Restarting nginx ...', true);
        $this->runShellCmd('systemctl restart nginx');
        $this->writer()->comment('Nginx restarted', true);
    }
}