<?php
/**
 * Xzit Giggle
 *
 * This file `BaseLoggedInController.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller;

use basteyy\XzitGiggle\Controller\Traits\RenderTrait;
use basteyy\XzitGiggle\Controller\Traits\Session\Flash\SessionFlashMessagesTrait;
use basteyy\XzitGiggle\Controller\Traits\Session\UserSessionTrait;
use basteyy\XzitGiggle\Models\UserQuery;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class BaseLoggedInController extends BaseController {
    use SessionFlashMessagesTrait,
        UserSessionTrait,
        RenderTrait;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->getRenderEngine()->registerFunction('isLoggedIn', fn() => $this->isLoggedIn(true));
        $this->getRenderEngine()->registerFunction('getUser', fn() => UserQuery::create()->findOneByUsername($this->getUserData()['username']));
    }

}