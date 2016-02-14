<?php

namespace App\MyLibrary;

use App\Order;

class PersonalOrders
{
    private $transactionId = 0;
    private $payerId = 0;

    public function __construct()
    {

    }

    public function setIds($transId, $payId)
    {
        $this->transactionId = $transId;
        $this->payerId = $payId;
    }

    public function getTotal()
    {
        $orders = Order::whereHas('person', function($query){
            $query->where('user_id', $this->payerId);
        })->where('transaction_id', $this->transactionId)->get();

        $price = 0;
        foreach ($orders as $order)
        {
            $price += ($order->quantity * $order->price);
        }

        return $price;
    }
}