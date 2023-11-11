<?php
/**
 * Xzit Giggle
 *
 * This file `SyncAll.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 11.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\bin;

use Ahc\Cli\Input\Command;
use basteyy\XzitGiggle\bin\Traits\DomainTrait;
use basteyy\XzitGiggle\bin\Traits\ShellTrait;
use basteyy\XzitGiggle\bin\Traits\SystemTrait;
use basteyy\XzitGiggle\bin\Traits\UsersTrait;
use basteyy\XzitGiggle\Helper\Config;
use Propel\Runtime\Exception\PropelException;

class SyncAll extends Command
{
    use ShellTrait,
        UsersTrait,
        DomainTrait,
        SystemTrait;

    public function __construct()
    {
        parent::__construct('sync-all', 'Run all tasks');
        $this
            ->usage('<bold>Usage:</end> <green>giggle sync-all</end>')
            ->option('-e --no-execute', 'No executing in shell', 'boolval', true)->on(
                fn() => $this->setToFile()
            );
    }

    public function interact(\Ahc\Cli\IO\Interactor $io) : void
    {
    }

    /**
     * @throws PropelException
     */
    public function execute(): void
    {
        $writer = $this->writer();

        $writer->comment(__('Run all tasks ...'), true);

        /** update the datetime of cron exectution in config */
        Config::set('sync-all.last_execution', date('Y-m-d H:i:s'));

        /** users */
        $this->addUsers();
        $this->deleteUsers();
        $this->updateUsers();

        /** domains */
        $this->addDomains();
        #$this->delteDomains();
        #$this->updateDomains();

        /** databases */
        #$this->addDatabases();
        #$this->deletedatabases();
        #$this->updateDatabases();

        /** Restart the services */
        $this->restartNginx();
        $this->restartPhp();
        $this->flushDatabase();
    }
}