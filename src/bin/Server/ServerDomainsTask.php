<?php
/**
 * Xzit Giggle
 *
 * This file `ServerDomainsTask.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 09.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\bin\Server;

use Ahc\Cli\Output\Writer;

class ServerDomainsTask extends \Ahc\Cli\Input\Command {
    /**
     * Add a new command to the application. Define command and description.
     */
    public function __construct()
    {
        parent::__construct('', 'Manage domains on the server');
        $this->usage('<bold>Usage:</end> <green>giggle server:domains</end>');
    }

    /**
     * Main function of the command. This function will be executed when the command is called.
     * @return void
     */
    public function execute(): void
    {
        /** @var Writer $bash */
        $bash = $this->app()->io();
        $bash->warn('Domain action');
    }
}