<?php

namespace App\Models\Kernel;

use ReflectionClass;

trait HasReflectionTrait
{
    public static $reflection_singleton = null;

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public static function getReflection()
    {
        if( is_null(self::$reflection_singleton) )
            self::$reflection_singleton = new ReflectionClass( self::class );

        return self::$reflection_singleton;
    }
}