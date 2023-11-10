<?php
/**
 * Xzit Giggle
 *
 * This file `SuperUsersOnlyMiddleware.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Middleware\Session;

use basteyy\XzitGiggle\Models\UserQuery;
use League\Plates\Engine;
use Odan\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class SuperUsersOnlyMiddleware implements MiddlewareInterface {

    /** @var SessionInterface $session */
    private SessionInterface $session;

    /** @var Engine $engine */
    private Engine $engine;

    /**
     * @param SessionInterface $session
     * @param Engine $engine
     */
    public function __construct(SessionInterface $session, Engine $engine)
    {
        $this->session = $session;
        $this->engine = $engine;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (session_status() === PHP_SESSION_NONE) {
            throw new \Exception('Please make sure, that you create a session before using the FlashMessage Component');
        }

        if(!$this->session->has(USER_SESSION_IDENTIFIER) || !(UserQuery::create()->findOneById($this->session->get(USER_SESSION_IDENTIFIER)['id']))->isAdmin()) {
            $response = new Response();
            $response->getBody()->write($this->engine->render('layouts/errors/403'));
            return $response->withStatus(403);
        }

        return $handler->handle($request);
    }
}