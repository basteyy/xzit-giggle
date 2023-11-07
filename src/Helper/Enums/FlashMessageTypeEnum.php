<?php
/**
 * Xzit Giggle
 * 
 * This file `FlashMessageTypeEnum.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 06.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Helper\Enums;

enum FlashMessageTypeEnum: string
{
    case SUCCESS = 'success';
    case INFO = 'info';
    case WARNING = 'warning';

    /**
     * Because the bootstrap is using the class danger for the error messages, error has to name danger
     */
    case ERROR = 'danger';
}