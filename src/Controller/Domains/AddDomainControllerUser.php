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
 * @since 07.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Domains;

use basteyy\XzitGiggle\Controller\BaseUserController;
use basteyy\XzitGiggle\Models\Domain;
use basteyy\XzitGiggle\Models\DomainQuery;
use basteyy\XzitGiggle\Models\IpAddressQuery;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AddDomainControllerUser extends BaseUserController
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(
        RequestInterface  $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        $this->setRequest($request);

        $domain = new Domain();

        if ($this->isPost()) {
            $domain->setdomain($request->getParsedBody()['domain'] ?? '');
            $domain->setWwwAlias(isset($request->getParsedBody()['www_alias']));
            $domain->setLetsEncrypt(isset($request->getParsedBody()['lets_encrypt']));
            $domain->setMountingPoint(($mounting_point = $request->getParsedBody()['mounting_point'] ?? ''));
            $errors = [];

            // Valid Domain with a valid TLD
            if (!filter_var($domain->getDomain(), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) || !str_contains($domain->getDomain(), '.')) {
                $errors[] = __('The domain is not valid');
            }

            // Check if the domain is already in use
            if (DomainQuery::create()->findOneByDomain($domain->getDomain())) {
                $errors[] = __('The domain is already in use');
            }

            // Check, if ip is valid
            $ipv4 = IpAddressQuery::create()
                ->filterByIpv4(true)
                ->filterByCanAssign(true)
                ->filterByExclusive(false)
                ->findOneById($request->getParsedBody()['ipv4']);

            if (!$ipv4) {
                $errors[] = __('The IPv4 address is not valid');
            }

            if (isset($request->getParsedBody()['ipv6']) && !($ipv6 = IpAddressQuery::create()
                    ->filterByIpv6(true)
                    ->filterByCanAssign(true)
                    ->filterByExclusive(false)
                    ->findOneById($request->getParsedBody()['ipv6']))) {

                $errors[] = __('The IPv6 address is not valid');
            }

            // Check, if $mounting_point has a valid path pattern with / and only aphanumeric chars
            if (!preg_match('/^[a-zA-Z0-9\/]+$/', $mounting_point)) {
                $errors[] = __('The mounting point is not valid');
            }

            if (count($errors) === 0) {

                $tld = substr($domain->getDomain(), strrpos($domain->getDomain(), '.') + 1);

                $domain->setIpv4($ipv4->getId());
                $domain->setIpv6($ipv6?->getId() ?? null);
                $domain->setUser($this->getUser());
                $domain->setTld($tld);
                $domain->save();

                $this->addSuccessMessage(__('The domain was added successfully'));
                return $this->redirect('/domains/domain?d=' . $domain->getDomain());
            }

            $this->addErrorMessage(__('The domain could not be added'));
            $this->addErrorMessage($errors);

        }

        return $this->render(
            template: 'user/domains/add_domain',
            data: [
                'domain' => $domain
            ],
            response: $response
        );
    }
}