<?php

namespace App\MyLibrary;

use App\Person;
use App\User;

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

    public static function updatePersonUserId(Person $person)
    {
        $user = User::withEmail($person->email)->first();
        if ($user)
        {
            $person->user_id = $user->id;
            $person->save();
        }
    }
}
