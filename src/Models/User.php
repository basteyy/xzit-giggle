<?php

namespace basteyy\XzitGiggle\Models;

use basteyy\XzitGiggle\Models\Base\User as BaseUser;
use basteyy\XzitGiggle\Helper\Config as Config;
use Exception;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use function basteyy\Stringer\getRandomAlphaString;
use function basteyy\Stringer\getRandomString;
use function basteyy\Stringer\getStringHashSum;
use function basteyy\Stringer\Times\getNiceTimeAgo;

/**
 * Skeleton subclass for representing a row from the 'xg_users' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class User extends BaseUser
{
    public function setUsername($v) : User
    {
        return parent::setUsername(strtolower($v));
    }

    public function applyDefaultValues() : void {

        $user = (null === $this->getUsername()) ? 'user_' . getRandomString(4, 'abcdefghijklmnoprstuvwxyz'): $this->getUsername();

        $this->setUsername($user);

        if (null === $this->getHomeFolder() || strlen($this->getHomeFolder()) < 1) {
            $this->setHomeFolder(rtrim(Config::get('user_home_path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $user);
        }
        if (null === $this->getLogFolder() || strlen($this->getLogFolder()) < 1) {
            $this->setLogFolder(rtrim(Config::get('user_home_path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $user . DIRECTORY_SEPARATOR . 'logs');
        }
        if (null === $this->getWebFolder() || strlen($this->getWebFolder()) < 1) {
            $this->setWebFolder(rtrim(Config::get('webroot_path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $user);
        }
        if (null === $this->getBash() || strlen($this->getBash()) < 1) {
            $this->setBash(Config::get('users_bash'));
        }
        if (null === $this->getPhpFpmPool() || strlen($this->getPhpFpmPool()) < 1) {
            $this->setPhpFpmPool($user . '-php');
        }
        if (null === $this->getPhpFpmSocket() || strlen($this->getPhpFpmSocket()) < 1) {
            $this->setPhpFpmSocket(rtrim(Config::get('php_fpm_socket_path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $user . '.sock');
        }
        if (null === $this->getPhpFpmPort() || strlen($this->getPhpFpmPort()) < 1) {
            $this->setPhpFpmPort(Config::get('php_fpm_socket_port'));
        }
    }

    /**
     * Return true, if the user is superuser (admin)
     * @return bool
     * @throws PropelException
     */
    public function isAdmin(): bool
    {
        return $this->getUserRole()->getIdentifier() === 'superuser';
    }

    /**
     * Return the path to the users log directory
     * @return string
     */
    public function getLogRoot(): string
    {
        return rtrim(Config::get('user_home_path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->getUsername() . DIRECTORY_SEPARATOR . 'logs' .
            DIRECTORY_SEPARATOR;
    }

    /**
     * Return the path to the users webroot directory
     * @return string
     */
    public function getWebRoot(): string
    {
        return rtrim(Config::get('webroot_path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->getUsername() . DIRECTORY_SEPARATOR;
    }

    /**
     * Check a password against the stored hash
     * @param string $password
     * @return bool
     */
    public function checkPassword(string $password): bool
    {
        return password_verify($password, $this->getPasswordHash());
    }

    /**
     * Hash and set the password
     * @param string $password
     * @return void
     * @see USED_PASSWORD_HASHING_ALGO
     */
    public function setPassword(string $password): void
    {
        $this->setPasswordHash(password_hash($password, USED_PASSWORD_HASHING_ALGO));
    }

    /**
     * Return the path to the users php-fpm socket
     * @return string
     */
    public function getFpmSock(): string
    {
        return '/run/php/php8.4-fpm-' . $this->getUsername() . '.sock';
    }

    /**
     * Return all active dialogs of the user, ordered by last message
     * @return Collection<Dialog>
     */
    public function getActiveDialogs(): Collection
    {
        return DialogQuery::create()
            ->filterByActive(true)
            ->useDialogUsersQuery()
            ->filterByUserId($this->getId())
            ->groupByDialogId()
            ->endUse()
            ->orderByLastMessage(Criteria::DESC)
            ->find();
    }

    /**
     * @throws PropelException
     * @throws Exception
     */
    public function getLastLoginNice(): string
    {
        if (null === $this->getLastLogin()) {
            return __('Never logged in');
        }

        return '<abbr title="' . $this->getLastLogin(DEFAULT_DATETIME_FORMAT) . '">' . getNiceTimeAgo($this->getLastLogin()) . '</abbr> from <abbr data-ip="'.$this->getLastLoginIp().'" title="'
            .$this->getLastLoginIp().'">ip</abbr>';
    }

    /**
     * @return void
     * @todo Implement clean ups for the user
     */
    public function hardUserDelete() : void {
        $this->delete();
    }

    public function softUserDelete(): void
    {
        $this->setIsDeleteCandidate(true);
        $this->setBlocked(true);
        $this->setActivated(false);

        $this->setEmail(getStringHashSum($this->getEmail()));
        $this->setPasswordHash(getRandomAlphaString(256));
        $this->setLastLoginIp(null);
        $this->setLastLogin(null);

        $this->save();

        // Delete all messages
        DialogMessageQuery::create()
            ->filterByUserId($this->getId())
            ->delete();

        // Dialog User
        DialogUserQuery::create()
            ->filterByUserId($this->getId())
            ->delete();


    }

}
