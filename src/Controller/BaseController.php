<?php
declare(strict_types=1);
/**
 * This file is part of xzit giggle
 *
 * Check out github.com/basteyy/xzit-giggle for more
 *
 */

namespace basteyy\XzitGiggle\Controller;

use basteyy\XzitGiggle\Controller\Traits\ContainerTrait;
use basteyy\XzitGiggle\Controller\Traits\RenderTrait;
use basteyy\XzitGiggle\Controller\Traits\RequestTrait;
use Psr\Container\ContainerInterface;

class BaseController {

    use ContainerTrait,
        RenderTrait,
        RequestTrait;

    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

}