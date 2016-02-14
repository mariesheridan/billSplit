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
        return $items;
    }

    public function getSvcCharge()
    {
        $svcCharge = 0;
        $item = Item::forTransaction($this->transactionId)->svcCharge()->first();
        if ($item)
        {
            $svcCharge = $item->price;
        }
        return $svcCharge;
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