<?php
/**
 * Xzit Giggle
 *
 * This file `SetupDatabaseController.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Setup;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SetupDatabaseController extends BaseSetupController
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(
        RequestInterface  $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        $this->setRequest($request);

        if(isSetUp()) {
            $this->addErrorMessage('Setup already done. Dont touch the setup again.');
            return $response->withHeader('Location', '/')->withStatus(302);
        }

        if ($this->isDatabaseSetUp()) {
            $database_data = $this->getDatabaseData();
        }

        if ($this->isPost()) {

            $dsn = sprintf('mysql:host=%s;port=%s;charset=%s',
                $request->getParsedBody()['host'],
                $request->getParsedBody()['port'],
                $request->getParsedBody()['charset'] ?? 'utf8mb4');

            if (isWorkingDatabaseConnection($dsn, $request->getParsedBody()['user'], $request->getParsedBody()['password'], $request->getParsedBody()['database'])) {
                $this->saveDatabaseDataFromRequest($request);
                $this->addInfoMessage('Database connection established. Go one friend.');
                return $response->withHeader('Location', '/setup/superuser/')->withStatus(302);
            }

            $this->addErrorMessage('Database connection failed. Please check your credentials. Try again.');
        }

        return $this->render(
            template: 'setup::database/database',
            data: [
                'database_data' => $database_data ??
                    [
                        'host'     => 'localhost',
                        'port'     => '3306',
                        'user'     => '',
                        'password' => '',
                        'database' => '',
                        'charset'  => 'utf8mb4'
                    ]
            ],
            response: $response
        );
    }
}