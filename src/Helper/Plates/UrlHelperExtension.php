<?php
/**
 * Xzit Giggle
 * 
 * This file `UrlHelperExtension.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Helper\Plates;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use League\Plates\Template\Template;

class UrlHelperExtension implements ExtensionInterface
{
    public Template $template;

    public function register(Engine $engine)
    {
        $engine->registerFunction('url', [$this, 'createUrl']);
    }

    public function createUrl(string $path, array $params = []) : string {
        $url = $path;
        if (count($params) > 0) {
            $url .= '?' . http_build_query($params);
        }
        return $url;
    }
}