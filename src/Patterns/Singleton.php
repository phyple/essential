<?php

namespace Phyple\Essential\Patterns;

class Singleton
{
    /**
     * Stored created object, so it won't be initialized later
     *
     * @var array $instances
     */
    private static array $instances = [];

    /**
     * Isolates the constructor, so the class can only be initiated from function
     */
    protected function __construct()
    {
    }

    /**
     * Check whether the instance created, if not, create and store it
     *
     * @param mixed ...$args
     * @return static
     */
    public static function getInstance(...$args): static
    {
        $class = static::class;

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static(...$args);
        }

        return self::$instances[$class];
    }

    /**
     * Check if selected class is using singleton pattern
     *
     * @param string $class_name
     * @return bool
     */
    public static function isSingleton(string $class_name): bool
    {
        return is_subclass_of($class_name, self::class);
    }
}