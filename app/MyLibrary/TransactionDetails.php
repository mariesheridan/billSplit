<?php

namespace App\MyLibrary;

use App\Transaction;
use App\Order;
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
        $svcCharge = Item::forTransaction($this->id)->svcCharge()->first();

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
        return $list;   
    }

    public function getPersonsEmailList()
    {
        $persons = $this->transaction->persons;
        $list = new PersonListBuilder();
        foreach ($persons as $person)
        {
            $list->addWithEmail($person->name, $person->email);
        }
        return $list->getEmailArray();
    }

    public function getItems()
    {
        $items = Item::forTransaction($this->id)->excludeSvcCharge()->get();

        $itemList = new ItemBuilder();
        foreach ($items as $item)
        {
            $itemList->addItemByName($item->name, $item->price);
            //echo "name: " . $item->name . ", price: " . $item->price . "<br>";
            $orders = Order::forItem($item->id)->get();
            foreach ($orders as $order)
            {
                $itemList->addBuyer($item->name, $order->person->name, $order->quantity);
                //echo "person: " . $order->person->name . ", qty: " . $order->quantity . "<br>";
            }
        }
        return $itemList;
    }

    public function getTransactionId()
    {
        return $this->transaction->id;
    }
}