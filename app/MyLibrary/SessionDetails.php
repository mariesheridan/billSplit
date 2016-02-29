<?php

namespace App\MyLibrary;

use Session;

class SessionDetails
{
    private static $initialized = false;
    private static $sessionVars = array('store', 'date', 'persons', 'items',
        'svcCharge', 'tempIds', 'personsWithEmail', 'transactionId', 'tempFriendsIds',
        'friendsError', 'includedFriends', 'tempPersonsIds', 'personIdForEdit');

    private function __construct() {}

    private static function initialize()
    {
        if (self::$initialized)
        {
            return;
        }

        self::$initialized = true;
    }

    public static function forget()
    {
        self::initialize();
        foreach (self::$sessionVars as $sessionVar)
        {
            Session::forget($sessionVar);
        }
    }
}
