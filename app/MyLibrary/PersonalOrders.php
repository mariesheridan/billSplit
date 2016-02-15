<?php

namespace App\MyLibrary;

use App\Order;
use App\Person;

class PersonalOrders
{
    private $transactionId = 0;
    private $payerId = 0;
    private $orders;

    public function __construct()
    {

    }

    public function setUserId($transId, $userId)
    {
        $this->transactionId = $transId;
        $this->payerId = $userId;
        $this->orders = Order::whereHas('person', function($query){
            $query->where('user_id', $this->payerId);
        })->where('transaction_id', $this->transactionId)->get();
    }

    public function setPersonId($transId, $personId)
    {
        $this->transactionId = $transId;
        $this->payerId = $personId;
        $this->orders = Order::whereHas('person', function($query){
            $query->where('id', $this->payerId);
        })->where('transaction_id', $this->transactionId)->get();   
    }

    public function getTotal()
    {
        $price = 0;
        foreach ($this->orders as $order)
        {
            $price += ($order->quantity * $order->price);
        }

        return $price;
    }

    public function getOrders()
    {
        $orderList = Order::whereHas('person', function($query){
            $query->where('id', $this->payerId);
        })->whereHas('item', function($query){
            $query->where('name', '!=', 'SvcCharge');
        })->where('transaction_id', $this->transactionId)->get();
        return $orderList;
    }

    public function getSvcCharge()
    {
        $svcCharge = 0;
        $orderList = Order::whereHas('person', function($query){
            $query->where('id', $this->payerId);
        })->whereHas('item', function($query){
            $query->where('name', 'SvcCharge');
        })->where('transaction_id', $this->transactionId)->first();

        if ($orderList)
        {
            $svcCharge = $orderList->price;
        }
        return $svcCharge;
    }

    public function getStatus()
    {
        return $this->orders->first()->person->status;
    }
}