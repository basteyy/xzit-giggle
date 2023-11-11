<?php
/**
 * Xzit Giggle
 *
 * This file `SyncUsers.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 11.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\bin\Users;

use Ahc\Cli\Exception\RuntimeException;
use Ahc\Cli\Input\Command;
use Ahc\Cli\IO\Interactor;
use basteyy\XzitGiggle\bin\Traits\ShellTrait;
use basteyy\XzitGiggle\bin\Traits\UsersTrait;

class SyncUsers extends Command
{
    use ShellTrait,
        UsersTrait;

    public function __construct()
    {
        parent::__construct('users:sync', 'Run all users commands to synchronize the users from the database to the system completely');
        $this
            ->usage('<bold>Usage:</end> <green>giggle users:sync</end>')
            ->option('-e --no-execute', 'No executing in shell', 'boolval', true)->on(
                fn() => $this->setToFile()
            );
    }

    /**
     * @param Interactor $io
     * @return void
     */
    public function interact(Interactor $io): void
    {
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $writer = $this->writer();

        /** Run Add Users */
        $writer->comment('Call `users:add` ...', true);
        $this->addUsers();
        $writer->comment('`users:add` completed', true);

        /** Run Delete Users */
        $writer->comment('Call `users:delete` ...', true);
        $this->deleteUsers();
        $writer->comment('`users:delete` completed', true);

        /** Run Update Users */
        $writer->comment('Call `users:update` ...', true);
        $this->updateUsers();
        $writer->comment('`users:update` completed', true);
    }
}