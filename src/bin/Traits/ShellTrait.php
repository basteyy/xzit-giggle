<?php
/**
 * Xzit Giggle
 *
 * This file `ShellTrait.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 11.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\bin\Traits;

use Ahc\Cli\Helper\Shell;

trait ShellTrait {

    /** @var bool $cmd_to_file Primary for dev purposed or debugging */
    private bool $cmd_to_file = true;

    protected function setToFile() : void {
        $this->cmd_to_file = true;
    }

    protected function setToConsole() : void {
        $this->cmd_to_file = false;
    }

    protected function getLogFilePath() : string {
        return ROOT . '/.cache/shell_log.txt';
    }

    protected function runShellCmd(string $cmd, bool $verbose = false): int
    {
        if ($this->cmd_to_file) {

            $logFile = $this->getLogFilePath();

            if (file_exists($logFile)) {
                $cmd = PHP_EOL . $cmd;
            }

            file_put_contents($this->getLogFilePath(), $cmd, FILE_APPEND);

            /** The owner of ROOT must be also owner of log file */
            chown($logFile, posix_getpwuid(fileowner(ROOT))['name']);

            return 0;
        } else {
            $shell = new Shell($cmd);
            $shell->execute();
            return $shell->getExitCode();
        }
    }
}