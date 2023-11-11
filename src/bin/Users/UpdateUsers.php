<?php
/**
 * Xzit Giggle
 *
 * This file `UpdateUsers.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 11.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\bin\Users;

use Ahc\Cli\Input\Command;
use basteyy\XzitGiggle\bin\Traits\ShellTrait;
use basteyy\XzitGiggle\bin\Traits\UsersTrait;

class UpdateUsers extends Command
{
    use ShellTrait,
        UsersTrait;

    /**
     * Add a new command to the application. Define command and description.
     */
    public function __construct()
    {
        parent::__construct('users:update', 'Remove users from the system and delete fromd database');

        $this
            ->usage('<bold>Usage:</end> <green>giggle users:update</end>')
            ->option('-e --no-execute', 'No executing in shell', 'boolval', true)->on(
                fn() => $this->setToFile()
            );
    }

    public function execute(): void
    {
        $this->updateUsers();
    }
}