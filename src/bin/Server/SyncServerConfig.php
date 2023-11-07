<?php
/**
 * Xzit Giggle
 *
 * This file `ServerConfig.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\bin\Server;

use Ahc\Cli\Application;
use Ahc\Cli\Output\Writer;

class SyncServerConfig extends \Ahc\Cli\Input\Command {


    public function __construct()
    {
        parent::__construct('Synchronization Server Config', 'Synchronization Server Config for all domains');

        $this->usage('<bold>Usage:</end> <green>giggle server:sync</end>');
    }


    public function execute(): void
    {
        /** @var Writer $bash */
        $bash = $this->app()->io();

        $bash->warn('Synchronization Server Config is starting...');


    }

}