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

    /**
     * Restart maria db server
     * @return void
     */
    protected function restartDatabase() : void {
        $this->writer()->comment(__('Restarting database ...'), true);
        $this->runShellCmd('systemctl restart mariadb');
        $this->writer()->comment(__('Database restarted'), true);
    }

    protected function flushDatabase() : void {
        $this->writer()->comment(__('Flushing database ...'), true);
        /** login as root and perform reload privileges */
        $this->runShellCmd('mysql -u root -e "FLUSH PRIVILEGES;"');
        $this->writer()->comment(__('Database flushed'), true);
    }

    protected function reloadPhp(float $version = null) : void {
        if (!$version) {
            foreach (PHP_VERSIONS as $version) {
                $this->reloadPhp($version);
            }
        } else {
            $this->writer()->comment(__('Reloading php %s ...', $version), true);
            $this->runShellCmd('systemctl reload '. sprintf('php%1$s-fpm', $version));
            $this->writer()->comment(__('Php reloaded'), true);
        }
    }

    protected function restartPhp(float $version = null) : void {
        if (!$version) {
            foreach (PHP_VERSIONS as $version) {
                $this->reloadPhp($version);
            }
        } else {
            $this->writer()->comment(__('Restart php %s ...', $version), true);
            $this->runShellCmd('systemctl reload '. sprintf('php%1$s-fpm', $version));
            $this->writer()->comment(__('Php restarted'), true);
        }
    }

    protected function reloadNginx() : void {
        $this->writer()->comment(__('Reloading nginx ...'), true);
        $this->runShellCmd('systemctl reload nginx');
        $this->writer()->comment(__('Nginx reloaded'), true);
    }

    protected function restartNginx() : void {
        $this->writer()->comment(__('Restarting nginx ...'), true);
        $this->runShellCmd('systemctl restart nginx');
        $this->writer()->comment(__('Nginx restarted'), true);
    }
}