<?php
/**
 * Xzit Giggle
 *
 * This file `DomainTrait.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 11.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\bin\Traits;

use basteyy\XzitGiggle\Models\Domain;
use basteyy\XzitGiggle\Models\DomainQuery;
use basteyy\XzitGiggle\Models\User;
use Propel\Runtime\Exception\PropelException;

trait DomainTrait
{
    use ShellTrait,
        SystemTrait;

    /**
     * @throws PropelException
     */
    protected function deleteDomainsFromUser(User $user,
                                             bool $reload_nginx = false,
                                             bool $reload_php = false) : void {
        $domains = DomainQuery::create()
            ->filterByUserId($user->getId())
            ->find();

        $writer = $this->io()->writer();

        $writer->comment(__('Start deleting domains from %s', $user->getUsername()), true);

        if (count($domains) === 0 ) {
            $writer->bold(__('No domains found for user %s', $user->getUsername()), true);
        }

        /** @var Domain $domain */
        foreach ($domains as $domain) {
            $writer->comment(__('Deleting domain %s', $domain->getDomain()), true);

            /** Remove symbolic file */
            $writer->comment(__('Removing symbolic link %s', $domain->getSymbolicNginxEnabledPath()), true);
            $this->runShellCmd(sprintf('rm -f %1$s',
                $domain->getSymbolicNginxEnabledPath()
            ));

            /** Remove real config file */
            $writer->comment(__('Removing nginx config file %s', $domain->getNginxConfigPath()), true);
            $this->runShellCmd(sprintf('rm -f %1$s',
                $domain->getNginxConfigPath()
            ));

            $domain->delete();
        }

        $writer->comment(__('Finished deleting domains from %s', $user->getUsername()), true);

        if ($reload_nginx) {
            $this->reloadNginx();
        }
    }
}