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
use Propel\Runtime\Exception\PropelException;

class Config
{

    private static $instance;

    private array $config = [];

    public function __construct()
    {
        foreach (ConfigQuery::create()->find() as $config) {

            $value = match ($config->getVarType()) {
                'boolean', 'bool' => (bool)$config->getValue(),
                'integer' => (int)$config->getValue(),
                'double' => (double)$config->getValue(),
                'array' => (array)$config->getValue(),
                'object' => (object)$config->getValue(),
                default => $config->getValue()
            };

            $this->config[$config->getKey()] = $value;
            $_ENV[$config->getKey()] = $value;

        }
    }

    public static function get(string $key): mixed
    {
        return self::getInstance()->config[$key] ?? null;
    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public static function getAll(): array
    {
        return self::getInstance()->config;
    }

    /**
     * @throws PropelException
     */
    public static function set(string $string,
                               mixed  $value,
                               mixed  $default = null,
                               mixed  $type = null): void
    {
        if (!self::exists($string)) {
            $config = new \basteyy\XzitGiggle\Models\Config();
            $config->setKey($string);
            $config->setValue($value);
            $config->setDefault($default ?? $value);
            $config->setVarType((string)$type ?? gettype($value));
            $config->save();
        } else {
            $config = ConfigQuery::create()->findOneByKey($string);
            $config->setValue($value);
            $config->save();
        }



        self::getInstance()->config[$string] = $value;

        $_ENV[$string] = $value;
    }

    public static function exists(string $key): bool
    {
        return isset(self::getInstance()->config[$key]);
    }

}