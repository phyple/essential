<?php

namespace Phyple\Essential\Patterns;

class Facade
{
    /**
     * Perform static call to selected subject
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $subject = static::getClassSubject();
        $instance = self::buildSubject($subject);

        return call_user_func_array([$instance, $name], $arguments);
    }

    /**
     * Get facade instance subject
     *
     * @return string
     */
    protected static function getClassSubject(): string
    {
        return static::class;
    }

    /**
     * Build facade subject
     *
     * @param string $class_name
     * @return object
     */
    protected static function buildSubject(string $class_name): object
    {
        return Singleton::isSingleton($class_name) ? call_user_func([$class_name, 'getInstance']) : new $class_name;
    }
}