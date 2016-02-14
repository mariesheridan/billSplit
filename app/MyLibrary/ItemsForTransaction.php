<?php

namespace App\MyLibrary;

use App\Transaction;
use App\Item;

class ItemsForTransaction
{
    private $transactionId = 0;

    public function __construct()
    {

    }

    public function setId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    // Get all items except service charge
    public function getItems()
    {
        $items = Item::forTransaction($this->transactionId)->excludeSvcCharge()->get();
        $itemsArray = array();
        foreach ($items as $item)
        {
            array_push($itemsArray, array('name' => $item->name, 'price' => $item->price));
        }
        return $itemsArray;
    }

    public function getSvcCharge()
    {
        $item = Item::forTransaction($this->transactionId)->svcCharge()->first();
        return $item->price;
    }

    public function getTotal()
    {
        $total = 0;
        $transaction = Transaction::find($this->transactionId);
        if ($transaction)
        {
            foreach ($transaction->items as $item)
            {
                $total += $item->price;
            }            
        }
        return $total;
    }
}