<?php
/**
 * Xzit Giggle
 *
 * This file `SyncNewUsers.php` is part of the `xzit-giggle` project.
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
use Ahc\Cli\Helper\Shell;
use Ahc\Cli\Input\Command;
use Ahc\Cli\Output\Writer;
use basteyy\XzitGiggle\bin\Traits\ShellTrait;
use basteyy\XzitGiggle\bin\Traits\UsersTrait;
use basteyy\XzitGiggle\Models\UserQuery;
use DateTime;
use function basteyy\Stringer\getRandomAlphaString;

class AddUsers extends Command
{
    use ShellTrait,
        UsersTrait;

    /**
     * Add a new command to the application. Define command and description.
     */
    public function __construct()
    {
        parent::__construct('users:add', 'Add new users (not processed and only activated) to the system');
        $this->usage('<bold>Usage:</end> <green>giggle users:add</end>')
            ->option('-e --no-execute', 'No executing in shell', 'boolval', true)->on(
                fn() => $this->setToFile()
            );;
    }

    public function interact(\Ahc\Cli\IO\Interactor $io) : void
    {
    }

    public function execute(): void
    {
        $this->addUsers();
    }

}
