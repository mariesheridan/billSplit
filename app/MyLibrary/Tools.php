<?php

namespace App\MyLibrary;

class Tools
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

    public static function removeSpaces($string)
    {
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
    }
}
