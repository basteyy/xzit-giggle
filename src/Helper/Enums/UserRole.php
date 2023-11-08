<?php
/**
 * Xzit Giggle
 *
 * This file `UserRole.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Helper\Enums;

enum UserRole: string
{
    case SUPER_USER = 'super_user';
    case USER = 'user';
}