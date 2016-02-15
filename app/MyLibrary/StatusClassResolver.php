<?php

namespace App\MyLibrary;

class StatusClassResolver
{
    public function __construct()
    {

    }

    public function getStatusClass($status)
    {
        $class = "";
        if ($status == 'Unpaid')
        {
            $class = "my-order-unpaid";
        }
        elseif ($status == "Verifying")
        {
            $class = "my-order-verifying";
        }
        elseif ($status == 'Paid')
        {
            $class = "my-order-paid";
        }
        return $class;
    }
}