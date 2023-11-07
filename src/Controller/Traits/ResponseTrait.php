<?php
/**
 * Xzit Giggle
 * 
 * This file `ResponseTrait.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Traits;

use Fig\Http\Message\StatusCodeInterface;
use JustSteveKing\StatusCode\Http;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

trait ResponseTrait
{
    use RequestTrait;

    /** @var ResponseInterface $response */
    private ResponseInterface $response;

    protected function reload(?ResponseInterface $response, ?Http $status = Http::OK) : ResponseInterface {

        if (!isset($response)) {
            $response = $this->getResponse();
        }

        /** Get the current Url */
        $url = $this->getCurrentUrl();

        /** Redirect to the current Url */
        $response = $response->withHeader('Location', $url);

        return $response->withStatus($status->value);
    }

    /**
     * Redirect to a new target. If no response is given, a new one will be created. If no status code is given, TENPORARY_REDIRECT will be used.
     * @param string $target
     * @param ResponseInterface|null $response
     * @param StatusCodeInterface|null $statusCode
     * @return ResponseInterface
     */
    protected function redirect(
        string               $target,
        ?ResponseInterface   $response = null,
        ?StatusCodeInterface $statusCode = null): ResponseInterface
    {
        if (!isset($response)) {
            $response = $this->getResponse();
        }

        if (!isset($statusCode)) {
            $statusCode = Http::OK;
        }

        $response = $response->withStatus($statusCode->value);

        return $response->withHeader('Location', $target);
    }

    /**
     * Returns the current response. If no response is set, a new one will be created.
     * @return ResponseInterface
     */
    protected function getResponse(): ResponseInterface
    {

        if (!isset($this->response)) {
            return $this->createNewResponse();
        }

        return $this->response;
    }

    /**
     * Set the current response.
     * @param ResponseInterface $response
     * @return void
     */
    protected function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    /**
     * Create a new response. To avoid creating a new response, use getResponse() instead.
     * @return ResponseInterface
     */
    protected function createNewResponse(): ResponseInterface
    {
        return new Response();
    }

}