<?php

namespace basteyy\XzitGiggle\Models;

use basteyy\XzitGiggle\Models\Base\User as BaseUser;

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
    public function isAdmin() : bool {
        return $this->getUserRole()->getIdentifier() === 'superuser';
    }

    public function getLogRoot() : string {
        return rtrim(\basteyy\XzitGiggle\Helper\Config::get('user_home_path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->getUsername() . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR;
    }
    public function getWebRoot() : string{
        return rtrim(\basteyy\XzitGiggle\Helper\Config::get('webroot_path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->getUsername() . DIRECTORY_SEPARATOR;
    }
    public function checkPassword(string $password): bool
    {
        return password_verify($password, $this->getPasswordHash());
    }
    public function getFpmSock()
    {
        return '/run/php/php8.4-fpm-' . $this->getUsername() . '.sock';
    }
}
