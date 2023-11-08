<?php
/**
 * Xzit Giggle
 *
 * This file `SUDashboardController.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Superuser\Dashboard;

use basteyy\XzitGiggle\Controller\Superuser\SuperuserBaseController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class SUDashboardController extends SuperuserBaseController {
    public function __invoke(
        RequestInterface $request,
        ResponseInterface $response
    ) : ResponseInterface
    {
        /** @var Response $response */



        return $this->render(
            template: 'SU::dashboard/superuser_dashboard',
            data: [],
            response: $response
        );
    }
}