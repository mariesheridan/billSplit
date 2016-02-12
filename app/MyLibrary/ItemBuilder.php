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
        foreach ($itemArray as $key=>$value)
        {
            $obj->setItem($key, $value);
        }
        return $obj;
    }

    public function getArray()
    {
        return $this->items;
    }

    public function getKeys()
    {
        return array_keys($this->items);
    }

    public function setArray($itemArray)
    {
        $this->items = $itemArray;
    }

    public function setItem($key, $value)
    {
        $newKey = $this->removeSpaces($key);
        $this->items[$newKey] = $value;
    }

    public function getItem($key)
    {
        $newKey = $this->removeSpaces($key);
        return $this->items[$newKey];
    }

    public function addItemArray($key, $itemArray)
    {
        $this->items[$key] = $itemArray;
    }

    public function addItemByName($itemName, $itemPrice)
    {
        $key = $this->removeSpaces($itemName);
        $this->items[$key]['itemName'] = $itemName;
        $this->items[$key]['itemPrice'] = $itemPrice;
        return $this;
    }

    public function addBuyer($itemName, $buyerName, $quantity)
    {
        $itemKey = $this->removeSpaces($itemName);
        $buyerKey = $this->removeSpaces($buyerName);
        $this->items[$itemKey]['buyers'][$buyerKey] = array('name' => $buyerName, 'qty' => $quantity);
        return $this;
    }

    public function toJSObject()
    {
        $jsObject = "{";
        foreach ($this->items as $key => $item)
        {
            $jsObject .= $key . ": {";
            $jsObject .= "itemName: '" . $item['itemName'] . "', ";
            $jsObject .= "itemPrice: " . $item['itemPrice'] . ", ";
            if (array_key_exists('buyers', $item))
            {
                $jsObject .= "buyers: {";
                foreach ($item['buyers'] as $buyerKey=>$buyer)
                {
                    $jsObject .= $buyerKey . ": " . $buyer['qty'] . ",";
                }
                $jsObject .= "}";
            }
            $jsObject .= "},";
        }
        $jsObject .= "}";
        return $jsObject;
    }

    public function hasName($itemName)
    {
        $key = $this->removeSpaces($itemName);
        return array_key_exists($key, $this->items); 
    }

    private function removeSpaces($input)
    {
        return str_replace(' ', '', $input);
    }
}
