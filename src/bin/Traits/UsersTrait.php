<?php
/**
 * Xzit Giggle
 *
 * This file `UsersTrait.php` is part of the `xzit-giggle` project.
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
use Ahc\Cli\Output\Writer;
use basteyy\XzitGiggle\Models\UserQuery;
use DateTime;
use Propel\Runtime\Exception\PropelException;
use function basteyy\Stringer\getRandomAlphaString;

trait UsersTrait
{

    use ShellTrait,
        SystemTrait,
        DomainTrait;

    protected function addUsers(): void
    {
        $io = $this->io();
        $writer = $io->writer();

        $io->writer()->info('Start adding users to the system ...', true);

        $users = UserQuery::create()
            ->filterByProcessed(false)
            ->filterByActivated(true)
            ->find();

        //$progress = new ProgressBar($users->count());

        /** @var Writer $bash */
        $writer = $this->app()->io()->writer();

        $writer->info('Synchronize users from the database to the server started ...', true);

        foreach ($users as $user) {

            $username = $user->getUsername();

            if ($user->isDeleteCandidate()) {
                $writer->bold(sprintf('User `%s` is skipped. Reason: User is a deleting candidate', $username), true);
                continue;
            }

            $writer->comment('Synchronize user ' . $user->getUsername() . ' ... ', true);

            /** Check, if user exists in the system */
            $user_exists = $this->userExists($username);

            if ($user_exists) {
                $writer->boldRedBgWhite(sprintf('User `%s` is skipped. Reason: Already in the system ', $username), true);
                continue;
            }

            /** Create user */
            $writer->comment('Create user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('useradd -m -d %2$s -s %3$s %1$s',
                $user->getUsername(),
                $user->getHomeFolder(),
                $user->getBash()
            ));

            /** Set Password */
            $writer->comment('Set password for user ' . $username . ' ... ', true);
            $password = getRandomAlphaString(16);
            $this->runShellCmd(sprintf('echo \'%1$s:%2$s\' | sudo chpasswd',
                $user->getUsername(),
                $password
            ));

            /** create ssh folder */
            $writer->comment('Create ssh folder for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('sudo -u %1$s mkdir -p %2$s/.ssh',
                $user->getUsername(),
                $user->getHomeFolder()
            ));

            /** Create authorized_keys file */
            /** @todo Implement ssh key from user */
            $writer->comment('Create authorized_keys file for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('sudo -u %1$s touch %2$s/.ssh/authorized_keys',
                $user->getUsername(),
                $user->getHomeFolder()
            ));

            /** Chmod 700 to ssh folder */
            $writer->comment('Chmod 700 to ssh folder for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('sudo -u %1$s chmod 700 %2$s/.ssh',
                $user->getUsername(),
                $user->getHomeFolder()
            ));

            /** Chmod 600 to authorized_keys */
            $writer->comment('Chmod 600 to authorized_keys for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('sudo -u %1$s chmod 600 %2$s/.ssh/authorized_keys',
                $user->getUsername(),
                $user->getHomeFolder()
            ));

            /** create logs folder for php and nginx */
            $log_folder = $user->getLogFolder();
            $writer->comment('Create log folder for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('sudo -u %1$s mkdir -p %2$s',
                $user->getUsername(),
                $log_folder
            ));

            $writer->comment('Create nginx log folder for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('sudo -u %1$s mkdir -p %2$s/nginx',
                $user->getUsername(),
                $log_folder
            ));

            $writer->comment('Create php log folder for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('sudo -u %1$s mkdir -p %2$s/php',
                $user->getUsername(),
                $log_folder
            ));

            /** Create web folder */
            $web_folder = $user->getWebFolder();
            $writer->comment('Create web folder for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('mkdir -p %1$s',
                $web_folder
            ));

            /** Set user owner:owner to web folder and make it readable for user and group only */
            $writer->comment('Set user owner:owner to web folder and make it readable for user and group only for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('chown -R %1$s:%1$s %2$s',
                $user->getUsername(),
                $web_folder
            ));

            $writer->comment('Set chmod 750 to web folder for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('chmod -R 750 %1$s',
                $web_folder
            ));

            /** Symbolic link from ~/web to $web_folder */
            $writer->comment('Create symbolic link from ~/web to ' . $web_folder . ' for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('sudo -u %1$s ln -s %2$s %3$s/web',
                $user->getUsername(),
                $web_folder,
                $user->getHomeFolder()
            ));

            /** add www-data to users usergropup */
            $writer->comment('Add www-data to users usergropup for user ' . $username . ' ... ', true);
            $this->runShellCmd(sprintf('usermod -aG %1$s www-data',
                $user->getUsername()
            ));

            /** In case user is already blocked, deactivate password login and reset ssh keys */
            if ($user->isBlocked()) {
                /** Reset ssh keys */
                /** rename authorized_keys to authorized_keys.blocked */
                $writer->comment('Rename authorized_keys to authorized_keys.blocked for user ' . $username . ' ... ', true);
                $this->runShellCmd(sprintf('sudo -u %1$s mv %2$s/.ssh/authorized_keys %2$s/.ssh/authorized_keys.blocked',
                    $user->getUsername(),
                    $user->getHomeFolder()
                ));

                /** Logout user `sudo passwd -l username` */
                $writer->comment('Deactivate password login for user ' . $username . ' ... ', true);
                $this->runShellCmd(sprintf('passwd -l %1$s',
                    $user->getUsername()
                ));
            }

            /** Update user */
            $user->setProcessed(true);
            $user->setProcessedAt(new DateTime());
            $user->save();

            $writer->boldRedBgWhite('Password for user ' . $username . ' is: ' . $password, true);
            $writer->greenBgWhite('User created: ' . $username, true);

            $writer->comment('User ' . $username . ' syncronized', true);
        }
        $writer->write('End adding users to the system.', true);

        $this->reloadNginx();
        $this->reloadPhp();
    }

    /**
     * Check, if user exists in the system
     * @param string $username
     * @return bool
     */
    private function userExists(string $username): bool
    {
        return (((new Shell('id -u ' . $username))->execute())->getOutput() == 0);
    }

    /**
     * @throws PropelException
     */
    protected function deleteUsers(): void
    {
        $io = $this->io();
        $writer = $io->writer();

        $io->writer()->info('Start deleting users from the system ...', true);

        $users = UserQuery::create()
            ->filterByIsDeleteCandidate(true)
            ->find();

        foreach ($users as $user) {

            if (!$this->userExists($user->getUsername())) {
                $writer->boldRedBgWhite(sprintf('User `%s` is skipped. Reason: Not in the system ', $user->getUsername()), true);
                continue;
            }

            $writer->comment('Delete user ' . $user->getUsername() . ' ... ', true);

            /** remove www-data from user group */
            $this->runShellCmd(sprintf('gpasswd -d www-data %1$s',
                $user->getUsername()
            ));

            /** Remove all databases */
            /** @todo Implement database deleting?! */

            /** remove all domains from nginx */
            $this->deleteDomainsFromUser($user);

            /** Remove user and usergroup */
            $writer->comment(sprintf('Perform `userdel` on %s`', $user->getUsername()), true);
            $this->runShellCmd(sprintf('userdel -r %1$s',
                $user->getUsername()
            ));

            /** delete the home path */
            $writer->comment(sprintf('Perform `rm -rf` on %s`', $user->getHomeFolder()), true);
            $this->runShellCmd(sprintf('rm -rf %1$s',
                $user->getHomeFolder()
            ));

            /** Remove all domain data */
            $writer->comment(sprintf('Perform `rm -rf` on %s`', $user->getWebFolder()), true);
            $this->runShellCmd(sprintf('rm -rf %1$s',
                $user->getWebFolder()
            ));

        }

        $writer->write('End deleting users to the system.', true);
    }

    protected function updateUsers(): void
    {
        $io = $this->io();
        $writer = $io->writer();

        $io->writer()->info('Start updating users on the system ...', true);

        $users = UserQuery::create()
            ->filterByIsDeleteCandidate(false)
            ->find();

        $writer->write('End updating users on the system.', true);
    }
}