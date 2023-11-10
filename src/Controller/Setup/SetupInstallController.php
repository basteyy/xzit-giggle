<?php
/**
 * Xzit Giggle
 *
 * This file `${FILE_NAME}` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 06.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Setup;

use basteyy\XzitGiggle\Helper\Enums\UserRole;
use Exception;
use PDO;
use PDOException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Slim\Psr7\Request;
use function basteyy\Stringer\getRandomAlphaNumericString;
use function basteyy\Stringer\getRandomString;

class SetupInstallController extends BaseSetupController
{
    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(
        RequestInterface  $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        /** @var Request $request */

        $this->setRequest($request);

        if (isSetUp()) {
            $this->addErrorMessage('Setup already done. Dont touch the setup again.');
            return $response->withHeader('Location', '/')->withStatus(302);
        }

        if (!($connection = $this->isDatabaseSetUp(true))) {
            $this->addErrorMessage('Please setup database first.');
            return $response->withHeader('Location', '/setup/database')->withStatus(302);
        }

        if (!$this->isSuperUserSetUp()) {
            $this->addErrorMessage('Please setup superuser first.');
            return $response->withHeader('Location', '/setup/superuser')->withStatus(302);
        }

        if (!$this->isIpSetup()) {
            $this->addErrorMessage('Please setup ip addresses first.');
            return $response->withHeader('Location', '/setup/options')->withStatus(302);
        }

        if (!$this->isOptionsSetup()) {
            $this->addErrorMessage('Please setup options first.');
            return $response->withHeader('Location', '/setup/options')->withStatus(302);
        }

        if (!file_exists($sql = ROOT . '/src/Config/Propel/Generated-sql/default.sql')) {
            throw new RuntimeException('Default SQL file not found.');
        }

        // $connection beinhaltet die aktive Verbindung

        $user = $this->getSuperUserData(
            password: true
        );

        if (!isset($user['username'])) {
            throw new RuntimeException('Username not set.');
        }

        if (!isset($user['password'])) {
            throw new RuntimeException('Password not set.');
        }

        try {
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /** Get the sql from file */
            $connection->exec(file_get_contents($sql));

            /** Insert all ip addresses */
            foreach ($this->getIpV4() as $ip) {
                $connection->exec(
                    'INSERT INTO `xg_ip` (`address`, `ipv4`, `ipv6`, `can_assign`, `exclusive`) VALUES (' .
                    $connection->quote($ip) . ', ' .
                    $connection->quote('1') . ', ' .
                    $connection->quote('0') . ', ' .
                    $connection->quote('1') . ', ' .
                    $connection->quote('0') . ');'
                );
            }

            foreach ($this->getIpV6() as $ip) {
                $connection->exec(
                    'INSERT INTO `xg_ip` (`address`, `ipv4`, `ipv6`, `can_assign`, `exclusive`) VALUES (' .
                    $connection->quote($ip) . ', ' .
                    $connection->quote('0') . ', ' .
                    $connection->quote('1') . ', ' .
                    $connection->quote('1') . ', ' .
                    $connection->quote('0') . ');'
                );
            }

            /** Insert roles superuser and user into xg_user_roles */
            $user_roles = [
                UserRole::SUPER_USER->value => UserRole::SUPER_USER->value,
                UserRole::USER->value       => UserRole::USER->value,
            ];

            foreach ($user_roles as $name => $identifier) {
                $connection->exec(
                    'INSERT INTO `xg_user_roles` (`name`, `identifier`) VALUES (' .
                    $connection->quote($name) . ', ' .
                    $connection->quote($identifier) . ');'
                );
            }

            /** Insert first user */
            $connection->exec(
                'INSERT INTO `xg_users` (`email`, `username`, `user_role_id`, `secret_key`, `password_hash`, `activated`, `blocked`) VALUES (' .
                $connection->quote($user['username'] . '@localhost') . ', ' .
                $connection->quote($user['username']) . ', ' .
                '(SELECT `id` FROM `xg_user_roles` WHERE `identifier` = ' . $connection->quote(UserRole::SUPER_USER->value) . '), ' .
                $connection->quote(getRandomAlphaNumericString()) . ', ' .
                $connection->quote($user['password']) . ', ' .
                $connection->quote('1') . ', ' .
                $connection->quote('0') . ');'
            );

            /**
             * Insert settings from setup dialog and some default settings
             * */
            $default_settings = [
                'webroot_path'                => $this->getOptions()['webroot_path'],
                'user_home_path'              => $this->getOptions()['user_home_path'],
                'users_bash'                  => $this->getOptions()['users_bash'],
                'php_fpm_socket_path'         => '/var/run/php-fpm/',
                'php_fpm_socket_port'         => '9000',
                'allow_user_login'            => (string)isset($this->getOptions()['allow_user_login']),
                'allow_users_domain_adding'   => (string)isset($this->getOptions()['allow_users_domain_adding']),
                'allow_users_database_adding' => (string)true
            ];

            foreach ($default_settings as $item => $setting) {
                $connection->exec(
                    'INSERT INTO `xg_config` (`key`, `default`, `value`) VALUES (' .
                    $connection->quote($item) . ', ' .
                    $connection->quote($setting) . ', ' .
                    $connection->quote($setting) . ');'
                );
            }

            setSetUp();

            /** Clear all data from session */
            $this->cleanSetupSessionData();

            $this->addSuccessMessage('Setup done. You can now login.');
            return $response->withHeader('Location', '/')->withStatus(302);

        } catch (PDOException $e) {
            varDebug("Failed: " . $e->getMessage());
        } catch (Exception $e) {
            varDebug("Something else: " . $e->getMessage());
        }
    }
}
