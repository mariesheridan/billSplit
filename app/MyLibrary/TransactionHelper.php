<?php

namespace App\MyLibrary;

use App\Transaction;

class TransactionHelper
{
    private $transactionId = 0;
    private $transaction;

    public function __construct()
    {

    }

    public function setId($id)
    {
        $this->transactionId = $id;
        $this->transaction = Transaction::find($id); 
    }

    public function getTransaction($id)
    {
        $this->setId($id);
        return $this;
    }

    public function getTotal()
    {
        $items = $this->transaction->items;
        $total = 0;

        foreach ($items as $item)
        {
            $total += $item->price;
        }

        return $total;
    }

    // Priority of reporting status:
    // 1 - Verifying (at least on verifying)
    // 2 - Unpaid
    // 3 - Paid (only when everyone has paid)
    public function getStatus()
    {
        $persons = $this->transaction->persons;
        $statuses = array();

        foreach ($persons as $person)
        {
            array_push($statuses, $person->status);
        }

        if (in_array('Verifying', $statuses))
        {
            return "Verifying";
        }
        elseif (in_array('Unpaid', $statuses))
        {
            return "Unpaid";
        }
        else
        {
            return "Paid";
        }
    }
}

