<?php
/**
 * Xzit Giggle
 *
 * This file `SetupSessionTrait.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Traits\Session;

use PDO;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use RuntimeException;

trait SetupSessionTrait
{
    use SessionTrait;

    /** @var string $databaseSessionKey */
    private string $databaseSessionKey = 'setup.database';

    /** @var string $superUserSessionKey */
    private string $superUserSessionKey = 'setup.superuser';

    /** @var string $ipv4AddressesSessionKey */
    private string $ipv4AddressesSessionKey = 'setup.ipv4_addresses';

    /** @var string $ipv6AddressesSessionKey */
    private string $ipv6AddressesSessionKey = 'setup.ipv6_addresses';

    /** @var string $optionsSessionKey */
    private string $optionsSessionKey = 'setup.options';

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function saveSuperUserData(string $username, string $password): void
    {
        $this->getSession()->set($this->superUserSessionKey, [
            'username' => $username,
            'password' => password_hash($password, USED_PASSWORD_HASHING_ALGO),
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getSuperUserData(bool $password = false): array
    {
        if (!$this->getSession()->has($this->superUserSessionKey)) {
            return [
                'username',
                'password',
            ];
        }

        return [
            'username' => $this->getSession()->get($this->superUserSessionKey)['username'],
            'password' => $password ? $this->getSession()->get($this->superUserSessionKey)['password'] : '',
        ];
    }

    /**
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getUserName(): string
    {
        return $this->getSession()->get($this->superUserSessionKey)['username'];
    }


    protected function setOptions(array $options): void
    {
        $this->getSession()->set($this->optionsSessionKey, $options);
    }

    protected function isOptionsSetup(): bool
    {
        $options = $this->getOptions();

        // Required once
        $required = [
            'webroot_path',
            'user_home_path',
            'users_bash'
        ];

        foreach ($required as $key) {
            if (!isset($options[$key])) {
                return false;
            }
        }

        return true;
    }

    protected function getOptions(): array
    {
        return $this->getSession()->get($this->optionsSessionKey) ?? [];
    }

    /**
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function cleanSetupSessionData(): void
    {
        if ($this->getSession()->has($this->databaseSessionKey)) {
            $this->getSession()->delete($this->databaseSessionKey);
        }

        if ($this->getSession()->has($this->superUserSessionKey)) {
            $this->getSession()->delete($this->superUserSessionKey);
        }

        if ($this->getSession()->has($this->ipv4AddressesSessionKey)) {
            $this->getSession()->delete($this->ipv4AddressesSessionKey);
        }

        if ($this->getSession()->has($this->ipv6AddressesSessionKey)) {
            $this->getSession()->delete($this->ipv6AddressesSessionKey);
        }

        if ($this->getSession()->has($this->optionsSessionKey)) {
            $this->getSession()->delete($this->optionsSessionKey);
        }
    }

    /**
     * @param array $addresses
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function setIpV4(array $addresses): void
    {
        $this->getSession()->set($this->ipv4AddressesSessionKey, $addresses);
    }

    /**
     * @param array $addresses
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function setIpV6(array $addresses): void
    {
        $this->getSession()->set($this->ipv6AddressesSessionKey, $addresses);
    }

    /**
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getIpV6(): array
    {
        return $this->getSession()->get($this->ipv6AddressesSessionKey) ?? [];
    }

    /**
     * @return bool
     */
    protected function isIpSetup(): bool
    {
        return count($this->getIpV4()) > 0;
    }

    /**
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getIpV4(): array
    {
        return $this->getSession()->get($this->ipv4AddressesSessionKey) ?? [];
    }

    /**
     * @return bool
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function isSuperUserSetUp(): bool
    {
        if (!$this->getSession()->has($this->superUserSessionKey)) {
            return false;
        }

        $data = $this->getSession()->get($this->superUserSessionKey);

        if (isset($data['username']) && isset($data['password'])) {
            return true;
        }

        return false;
    }

    /**
     * @param RequestInterface $request
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function saveDatabaseDataFromRequest(RequestInterface $request): void
    {

        if (!isset($request->getParsedBody()['host'])) {
            throw new RuntimeException('Host not set in request');
        }

        if (!isset($request->getParsedBody()['port'])) {
            throw new RuntimeException('Port not set in request');
        }

        if (!isset($request->getParsedBody()['user'])) {
            throw new RuntimeException('User not set in request');
        }

        if (!isset($request->getParsedBody()['password'])) {
            throw new RuntimeException('Password not set in request');
        }

        if (!isset($request->getParsedBody()['database'])) {
            throw new RuntimeException('Database not set in request');
        }

        $this->getSession()->set($this->databaseSessionKey, [
            'host'     => $request->getParsedBody()['host'],
            'port'     => $request->getParsedBody()['port'],
            'user'     => $request->getParsedBody()['user'],
            'password' => $request->getParsedBody()['password'],
            'database' => $request->getParsedBody()['database'],
            'charset'  => $request->getParsedBody()['charset'] ?? 'utf8mb4',
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function isDatabaseSetUp(bool $return_connection = false): bool|PDO
    {

        if (!$this->getSession()->has($this->databaseSessionKey)) {
            return false;
        }

        $data = $this->getSession()->get($this->databaseSessionKey);

        $dsn = sprintf('mysql:host=%s;port=%s;charset=%s',
            $data['host'],
            $data['port'],
            $data['charset'] ?? 'utf8mb4');

        if ($connection = isWorkingDatabaseConnection($dsn, $data['user'], $data['password'], $data['database'], $return_connection)) {

            if ($return_connection) {
                return $connection;
            }

            return true;
        }

        return false;
    }

    /**
     * Return the database data from the session
     * @return array|null[]
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getDatabaseData(bool $exception_if_missed = false): array
    {
        if (!$this->getSession()->has($this->databaseSessionKey)) {

            if ($exception_if_missed) {
                throw new \http\Exception\RuntimeException(__("Database data not found in session"));
            }

            return [
                'host'     => null,
                'port'     => null,
                'user'     => null,
                'password' => null,
                'database' => null,
                'charset'  => null,
            ];
        }

        $data = $this->getSession()->get($this->databaseSessionKey);

        return [
            'host'     => $data['host'],
            'port'     => $data['port'],
            'user'     => $data['user'],
            'password' => $data['password'],
            'database' => $data['database'],
            'charset'  => $data['charset'],
        ];
    }

}