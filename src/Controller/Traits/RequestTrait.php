<?php
/**
 * Xzit Giggle
 *
 * This file `RequestTrait.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Traits;

use Psr\Http\Message\RequestInterface;
use Slim\Factory\ServerRequestCreatorFactory;

trait RequestTrait
{

    use ContainerTrait;

    private RequestInterface $request;

    /**
     * Get the current Url including query string, in case port is not 80 or 443 include it
     * @return string
     */
    protected function getCurrentUrl(): string
    {
        $url = $this->getRequest()->getUri()->getScheme() . '://' . $this->getRequest()->getUri()->getHost();

        if ($this->getRequest()->getUri()->getPort() !== 80 && $this->getRequest()->getUri()->getPort() !== 443) {
            $url .= ':' . $this->getRequest()->getUri()->getPort();
        }

        $url .= $this->getRequest()->getUri()->getPath();

        if ($this->getRequest()->getUri()->getQuery()) {
            $url .= '?' . $this->getRequest()->getUri()->getQuery();
        }

        return $url;
    }

    public function getRequest(): RequestInterface
    {

        if (!isset($this->request)) {
            /** Check inside Container for a request, otherwise create a new one from server super globals */
            if ($this->getContainer()->has(RequestInterface::class)) {
                $this->setRequest($this->getContainer()->get(RequestInterface::class));
            } else {
                $this->setRequest((ServerRequestCreatorFactory::create())->createServerRequestFromGlobals());
            }
        }

        return $this->request;
    }

    protected function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    protected function isPost(): bool
    {
        return $this->getRequest()->getMethod() === 'POST';
    }

    protected function isGet(): bool
    {
        return $this->getRequest()->getMethod() === 'GET';
    }

    protected function isPut(): bool
    {
        return $this->getRequest()->getMethod() === 'PUT';
    }

    protected function isDelete(): bool
    {
        return $this->getRequest()->getMethod() === 'DELETE';
    }

    protected function isPatch(): bool
    {
        return $this->getRequest()->getMethod() === 'PATCH';
    }

    protected function isHead(): bool
    {
        return $this->getRequest()->getMethod() === 'HEAD';
    }

    protected function isOptions(): bool
    {
        return $this->getRequest()->getMethod() === 'OPTIONS';
    }

    protected function isAjax(): bool
    {
        return $this->getRequest()->getHeaderLine('X-Requested-With') === 'XMLHttpRequest';
    }

    protected function isSecure(): bool
    {
        return $this->getRequest()->getUri()->getScheme() === 'https';
    }

    protected function getIp(): string
    {
        return $this->getRequest()->getServerParams()['REMOTE_ADDR'];
    }

    protected function getReferrer(): string
    {
        return $this->getRequest()->getHeaderLine('HTTP_REFERER');
    }

    protected function getUserAgent(): string
    {
        return $this->getRequest()->getHeaderLine('HTTP_USER_AGENT');
    }
}