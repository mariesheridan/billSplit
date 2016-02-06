<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UpdateItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update(Request $request)    
    {
        $items = array();
        $itemNames = array();
        foreach($request->all() as $key=>$item)
        {
            if(preg_match('/^item[\d]+/', $key))
            {
                array_push($itemNames, $item);
            }
        }

        $index = 0;
        foreach($request->all() as $key=>$price)
        {
            if(preg_match('/^price[\d]+/', $key))
            {
                array_push($items, array('itemName' => $itemNames[$index], 'itemPrice' => $price));
                $index++;
            }
        }
        print_r($items);

        Session::forget('items');
        Session::set('items', $items);

        if ($request->__get('next'))
        {
            echo "Next";
            return redirect()->route('order_details');
        }
        else if ($request->__get('back'))
        {
            echo "Back";
            return redirect()->route('create_persons');
        }
        else
        {
            echo "Ooops.. Please go back";
        }
    }
}
