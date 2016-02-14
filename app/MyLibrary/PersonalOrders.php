<?php

namespace App\MyLibrary;

use App\Order;

class PersonalOrders
{
    private $transactionId = 0;
    private $payerId = 0;
    private $orders;

    public function __construct()
    {

    }

    public function setIds($transId, $payId)
    {
        $this->transactionId = $transId;
        $this->payerId = $payId;
        $this->orders = Order::whereHas('person', function($query){
            $query->where('user_id', $this->payerId);
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
}