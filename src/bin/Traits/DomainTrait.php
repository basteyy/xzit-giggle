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
    protected function addDomains(bool $reload_nginx = false) : void {
        $io = $this->io();
        $writer = $this->writer();

        $writer->comment(__('Start adding domains ...'), true);

        /** Tmp folder exists? */
        if (!is_dir($tmp = ROOT . '/.cache/tmp/')) {
            mkdir($tmp, 0777, true);
        }

        $domains = DomainQuery::create()
            ->filterByProcessed(false)
            ->find();

        foreach ($domains as $domain) {

            $user = $domain->getUser();

            $writer->comment(__('Adding domain %s (user %s)', $domain->getDomain(), $user->getUsername()), true);

            if ($user->isBlocked()) {
                $writer->comment(__('User %s is blocked. Skipping domain %s', $user->getUsername(), $domain->getDomain()), true);
                continue;
            }

            if (!$user->isActivated()) {
                $writer->comment(__('User %s is not activated. Skipping domain %s', $user->getUsername(), $domain->getDomain()), true);
                continue;
            }

            /** Create nginx config */
            $writer->comment(__('Creating nginx config file %s', $domain->getNginxConfigPath()), true);
            $config = $domain->getServerConfig();
            $cache_path = $tmp . $domain->getDomain() . '.conf';
            file_put_contents($cache_path, $config);
            $this->runShellCmd(sprintf('cp %1$s %2$s',
                $cache_path,
                $domain->getNginxConfigPath()
            ));
            unlink($cache_path);

            /** Create the symbolic link */
            $writer->comment(__('Creating symbolic link %s', $domain->getSymbolicNginxEnabledPath()), true);
            $this->runShellCmd(sprintf('ln -s %1$s %2$s',
                $domain->getNginxConfigPath(),
                $domain->getSymbolicNginxEnabledPath()
            ));

            /** Run certbot (certbot --nginx -d domain.de,www.domain.de */
            /** @todo Implement it */

            /** Set domain as processed */
            $domain->setProcessed(true);
            $domain->setProcessedAt(new \DateTime());
            $domain->save();
        }

        $writer->comment(__('Adding domains done'), true);

        if ($reload_nginx) {
            $this->reloadNginx();
        }
    }

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