<?php
/**
 * Xzit Giggle
 *
 * This file `Config.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 07.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Helper;

use basteyy\XzitGiggle\Models\ConfigQuery;

class Config {

    private static $instance;

    private array $config = [];

    public function __construct()
    {
        foreach (ConfigQuery::create()->find() as $config) {
            $this->config[$config->getKey()] = $config->getValue();
            $_ENV[$config->getKey()] = $config->getValue();
        }
    }

    public static function getInstance() : self {
        if (!self::$instance) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public static function get(string $key): mixed
    {
        return self::getInstance()->config[$key] ?? null;
    }

    public static function exists(string $key): bool
    {
        return isset(self::getInstance()->config[$key]);
    }

    public static function set(string $string, string $date)
    {
        if (!self::exists($string)) {
            $config = new \basteyy\XzitGiggle\Models\Config();
            $config->setKey($string);
            $config->setValue($date);
            $config->setDefault($date);
            $config->save();
        }

        self::getInstance()->config[$string] = $date;
        $_ENV[$string] = $date;
    }

}