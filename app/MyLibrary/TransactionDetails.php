<?php

namespace App\MyLibrary;

use App\Transaction;
use App\Item;
use App\MyLibrary\ItemBuilder;
use App\MyLibrary\JSConverter;
use App\MyLibrary\PersonListBuilder;

class TransactionDetails
{
    private $transaction;
    private $id = 0;

    public function __construct($id)
    {
        $this->id = $id;
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
        $svcCharge = Item::transId($this->id)->svcCharge()->first();

        return $svcCharge->price;
    }

    public function getPersonNames()
    {
        $persons = $this->transaction->persons;
        $list = new PersonListBuilder();
        foreach ($persons as $person)
        {
            $list->add($person->name);
        }
        return $list->toJSObject();
    }

}