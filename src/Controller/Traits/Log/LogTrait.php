<?php
/**
 * Xzit Giggle
 *
 * This file `LogTrait.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 10.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Traits\Log;

use basteyy\XzitGiggle\Controller\Traits\Session\UserSessionTrait;
use basteyy\XzitGiggle\Models\User;
use Propel\Runtime\Exception\PropelException;

trait LogTrait {
    use UserSessionTrait;

    /**
     * @throws PropelException
     */
    public function log(string $log, ?User $user = null) : void {
        if (!$user) {
            $user = $this->getUser();
        }

        $action_log = new \basteyy\XzitGiggle\Models\ActionLog();
        $action_log->setUser($user);
        $action_log->setAction($log);
        $action_log->save();
    }
}