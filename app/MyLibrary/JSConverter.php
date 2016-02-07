<?php

namespace App\MyLibrary;

class JSConverter
{
    private static $initialized = false;

    private function __construct() {}

    private static function initialize()
    {
        if (self::$initialized)
        {
            return;
        }

        self::$initialized = true;
    }

    public static function toJSArray($phpArray)
    {
        return '["' . implode('", "', $phpArray) . '"]';
    }
}
