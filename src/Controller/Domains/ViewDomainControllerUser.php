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
use basteyy\XzitGiggle\Models\DomainQuery;
use Propel\Runtime\Exception\PropelException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ViewDomainControllerUser  extends BaseUserController
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws PropelException
     */
    public function __invoke(
        RequestInterface  $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        $this->setRequest($request);

        $domain = DomainQuery::create()
            ->filterByUser($this->getUser())
            ->findOneByDomain($request->getQueryParams()['d'] ?? '');

        return $this->render(
            template: 'users::domains/view_domain',
            data: [
                'domain' => $domain
            ],
            response: $response
        );
    }
}