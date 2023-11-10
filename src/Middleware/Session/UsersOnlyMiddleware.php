<?php
/**
 * Xzit Giggle
 *
 * This file `UsersOnlyMiddleware.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Middleware\Session;

use League\Plates\Engine;
use Odan\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class UsersOnlyMiddleware implements MiddlewareInterface {

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
     * @throws \Exception
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (session_status() === PHP_SESSION_NONE) {
            throw new \Exception('Please make sure, that you create a session before using the FlashMessage Component');
        }

        if(!$this->session->has(USER_SESSION_IDENTIFIER)) {
            $response = new Response();
            $engine = new Engine(ROOT . '/src/Templates/layouts/');
            $engine->addFolder('layouts', ROOT . '/src/Templates/layouts/');
            $response->getBody()->write($engine->render('403'));
            return $response->withStatus(403);
        }

        return $handler->handle($request);
    }
}