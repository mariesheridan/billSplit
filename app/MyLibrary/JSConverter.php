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

    // This is not a generic function. It is specifically designed for items array.
    public static function toJSItemObject($itemObject)
    {
        $itemsJSArray = "{";
        foreach($itemObject as $itemName => $item)
        {
            echo ("item: <br>");
            print_r($item);
            echo ("<br>---- end item ---- <br>");
              $itemsJSArray .= $itemName . ": {";
            $itemsJSArray .= "itemPrice: " . $item['itemPrice'] . ", ";
            if (array_key_exists('buyers', $item))
            {
                $itemsJSArray .= "buyers: {";
                foreach ($item['buyers'] as $buyer)
                {
                    $itemsJSArray .= $buyer['name'] . ": " . $buyer['qty'] . ",";
                }
                $itemsJSArray .= "}";
            }
            $itemsJSArray .= "},";
        }
        $itemsJSArray .= "};";
        return $itemsJSArray;
    }
}
