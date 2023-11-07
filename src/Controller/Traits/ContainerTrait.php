<?php
/**
 * Xzit Giggle
 * 
 * This file `ContainerTrait.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Traits;

use Psr\Container\ContainerInterface;

trait ContainerTrait {

    private ContainerInterface $container;

    protected function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    protected function getContainer(): ContainerInterface {
        return $this->container;
    }
}