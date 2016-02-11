<?php

namespace App\MyLibrary;

/**
 * Structure:
 * key =>
 *     itemName  => name
 *     itemPrice => price
 *     buyers    =>
 *         buyerKey => 
 *             name => name
 *             qty  => quantity
 */

class ItemBuilder
{
    private $items = array();

    public function __construct()
    {

    }

    public static function copyArray($itemArray)
    {
        $obj = new ItemBuilder;
        $obj->setArray($itemArray);
        return $obj;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setArray($itemArray)
    {
        $this->items = $itemArray;
    }

    public function addItemArray($key, $itemArray)
    {
        $this->items[$key] = $itemArray;
    }

    public function addItemByName($itemName, $itemPrice)
    {
        $key = str_replace(' ', '', $itemName);
        $this->items[$key]['itemName'] = $itemName;
        $this->items[$key]['itemPrice'] = $itemPrice;
        return $this;
    }

    public function addBuyer($key, $buyerName, $quantity)
    {
        $buyerKey = str_replace(' ', '', $buyerName);
        $this->items[$key]['buyers'][$buyerKey] = array('name' => $buyerName, 'qty' => $quantity);
        return $this;
    }

    public function toJSObject()
    {
        $jsObject = "{";
        foreach($this->items as $key => $item)
        {
            $jsObject .= $key . ": {";
            $jsObject .= "itemName: " . $item['itemName'] . ", ";
            $jsObject .= "itemPrice: " . $item['itemPrice'] . ", ";
            if (array_key_exists('buyers', $item))
            {
                $jsObject .= "buyers: {";
                foreach ($item['buyers'] as $buyer)
                {
                    $jsObject .= $buyer['name'] . ": " . $buyer['qty'] . ",";
                }
                $jsObject .= "}";
            }
            $jsObject .= "},";
        }
        $jsObject .= "};";
        return $jsObject;
    }

    public function hasName($itemName)
    {
        $key = str_replace(' ', '', $itemName);

        return array_key_exists($key, $this->items); 
    }
}
