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

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SetupOptionsController extends BaseSetupController
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
        $this->setRequest($request);

        if (isSetUp()) {
            $this->addErrorMessage('Setup already done. Dont touch the setup again.');
            return $response->withHeader('Location', '/')->withStatus(302);
        }

        if (!$this->isDatabaseSetUp()) {
            $this->addErrorMessage('Please setup database first.');
            return $response->withHeader('Location', '/setup/database')->withStatus(302);
        }

        if (!$this->isSuperUserSetUp()) {
            $this->addErrorMessage('Please setup superuser first.');
            return $response->withHeader('Location', '/setup/superuser')->withStatus(302);
        }

        $ipv4_addresses = [];
        $ipv6_addresses = [];

        if ($this->isPost()) {

            $errors = [];

            $ipv4_addresses = str_contains($request->getParsedBody()['ipv4_addresses'], PHP_EOL) ? explode(PHP_EOL, $request->getParsedBody()['ipv4_addresses']) : [$request->getParsedBody()['ipv4_addresses']];
            $ipv6_addresses = str_contains($request->getParsedBody()['ipv6_addresses'], PHP_EOL) ? explode(PHP_EOL, $request->getParsedBody()['ipv6_addresses']) : [$request->getParsedBody()['ipv6_addresses']];

            foreach ($ipv4_addresses as $id => $address) {
                $ipv4_addresses[$id] = trim($address);

                if (!filter_var($ipv4_addresses[$id], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    // Unset invalid IPv4 Addresses
                    unset($ipv4_addresses[$id]);
                }
            }

            foreach ($ipv6_addresses as $id => $address) {
                $ipv6_addresses[$id] = trim($address);

                if (!filter_var($ipv6_addresses[$id], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                    // Unset invalid IPv4 Addresses
                    unset($ipv6_addresses[$id]);
                }
            }

            if (!isset($request->getParsedBody()['webroot_path'])) {
                $errors[] = 'Please set webroot path.';
            }

            if (!isset($request->getParsedBody()['user_home_path'])) {
                $errors[] = 'Please set users home path.';
            }

            if (!isset($request->getParsedBody()['users_bash'])) {
                $errors[] = 'Please set users bash.';
            }

            if (count($errors) === 0) {

                $this->setIpV6($ipv6_addresses);
                $this->setIpV4($ipv4_addresses);
                $this->setOptions(
                    [
                        'webroot_path' => $request->getParsedBody()['webroot_path'],
                        'user_home_path' => $request->getParsedBody()['user_home_path'],
                        'users_bash' => $request->getParsedBody()['users_bash'],
                        'allow_user_login' => isset($request->getParsedBody()['allow_user_login']),
                        'allow_users_domain_adding' => isset($request->getParsedBody()['allow_users_domain_adding']),
                    ]
                );

                $this->addSuccessMessage('All data received.');

                return $this->redirect(
                    target: '/setup/install/',
                    response: $response
                );
            }

            $this->addErrorMessage('You need to define at least one IPv4 Address.');
        }

        return $this->render(
            template: 'setup::options/options',
            data: [
                'ipv4_addresses' => implode(PHP_EOL, $ipv4_addresses),
                'ipv6_addresses' => implode(PHP_EOL, $ipv6_addresses),
            ],
            response: $response,
        );
    }
}