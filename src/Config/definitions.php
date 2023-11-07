<?php
/**
 * Xzit Giggle
 * 
 * This file `definitions.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

return [

    /** Render Engine */
    \League\Plates\Engine::class => function(\Odan\Session\FlashInterface $flash) {
        $templates = new \League\Plates\Engine(ROOT . '/src/Templates');

        $templates->addFolder('layouts', ROOT . '/src/Templates/layouts');
        $templates->addFolder('setup', ROOT . '/src/Templates/setup/');

        $templates->loadExtensions([
            /** Url helper */
            new \basteyy\XzitGiggle\Helper\Plates\UrlHelperExtension(),

            /** Flash Messages inside Templates */
            new \basteyy\XzitGiggle\Helper\Plates\FlashMessagesExtension($flash)
        ]);


        return $templates;
    },

    /** Session Engine */
    \Odan\Session\SessionInterface::class             => function () {
        $sessionHandler = new \Odan\Session\PhpSession([
            'name'            => 'app',
            'cookie_samesite' => 'Lax',
            'cookie_secure'   => true,
            'cookie_httponly' => false,
        ]);

        $sessionHandler->start();

        return $sessionHandler;
    },

    /** Flash Messages */
    \Odan\Session\FlashInterface::class => function(\Odan\Session\SessionInterface $session) {
        return $session->getFlash();
    }

];