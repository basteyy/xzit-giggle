<?php

namespace basteyy\XzitGiggle\Models;

use basteyy\XzitGiggle\Helper\Enums\UserRole;
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
        return parent::setUsername(strtolower(preg_replace('/[^a-zA-Z0-9_]/', '', $v)));
    }

    /**
     * @param bool $save_fallback_value
     * @return string
     * @throws PropelException
     */
    public function getHomeFolder(bool $save_fallback_value = false) : string
    {
        $value = parent::getHomeFolder();

        if (null === $value || strlen($value) < 1) {
            $value = rtrim(Config::get('user_home_path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->getUsername();
            $this->setHomeFolder($value);

            if ($save_fallback_value) {
                $this->save();
            }
        }

        return $value;
    }

    public function getWebFolder(bool $save_fallback_value = false) : string {
        $value = parent::getWebFolder();

        if (null === $value || strlen($value) < 1) {
            $value = rtrim(Config::get('webroot_path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->getUsername();
            $this->setHomeFolder($value);

            if ($save_fallback_value) {
                $this->save();
            }
        }

        return $value;
    }

    /**
     * @throws PropelException
     */
    public function getLogFolder(bool $save_fallback_value = false) : string {
        $value = parent::getLogFolder();

        if (null === $value || strlen($value) < 1) {
            $value = rtrim($this->getHomeFolder($save_fallback_value), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'logs';
            $this->setLogFolder($value);

            if ($save_fallback_value) {
                $this->save();
            }
        }

        return $value;
    }

    /**
     * @throws PropelException
     */
    public function getBash(bool $save_fallback_value = false) : string {
        $value = parent::getBash();

        if (null === $value || strlen($value) < 1) {
            $value = Config::get('users_bash');
            $this->setBash($value);

            if ($save_fallback_value) {
                $this->save();
            }
        }

        return $value;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function applyDefaultValues() : void {

        $user = (null === $this->getUsername()) ? 'user_' . getRandomString(4, 'abcdefghijklmnoprstuvwxyz'): $this->getUsername();

        $this->setUsername($user);
    }

    /**
     * Return true, if the user is superuser (admin)
     * @return bool
     * @throws PropelException
     */
    public function isAdmin(): bool
    {
        return $this->getUserRole()->getIdentifier() === UserRole::SUPER_USER->value;
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
     * @todo Implement logging of password changes, implement email notification?
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
