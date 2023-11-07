<?php
/**
 * Xzit Giggle
 * 
 * This file `BaseSetupController.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Setup;

use basteyy\XzitGiggle\Controller\BaseController;
use basteyy\XzitGiggle\Controller\Traits\Session\Flash\SessionFlashMessagesTrait;
use basteyy\XzitGiggle\Controller\Traits\Session\SetupSessionTrait;

class BaseSetupController extends BaseController {

    use SetupSessionTrait,
        SessionFlashMessagesTrait;

}