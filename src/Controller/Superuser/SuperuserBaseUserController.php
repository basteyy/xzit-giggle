<?php
/**
 * Xzit Giggle
 *
 * This file `SuperuserBaseUserController.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Superuser;

use basteyy\XzitGiggle\Controller\BaseUserController;
use Psr\Container\ContainerInterface;

class SuperuserBaseUserController extends BaseUserController {
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->getRenderEngine()->addFolder('SU', ROOT . '/src/Templates/SuperUser/');

    }
}