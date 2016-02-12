<?php

namespace App\MyLibrary;

use App\Transaction;
use App\ItemBuilder;
use App\JSConverter;

class TransactionDetails
{
    private $transactions;

    public function __construct($id)
    {
        $this->transaction = Transaction::find($id);
    }

    public function getStore()
    {
        return $this->transaction->store;
    }

    public function getDate()
    {
        return $this->transaction->date;
    }

    public function getSvcCharge()
    {
        $item = $this->transaction->items;
        $svcCharge = $item->where('name', '=', 'SvcCharge');
        $price = $svcCharge->isEmpty() ? 0 : $svcCharge->price;
        return $price;
    }

}