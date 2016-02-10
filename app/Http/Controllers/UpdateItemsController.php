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
        $oldItems = Session::get('items', array());
        $itemNames = array();
        foreach($request->all() as $key=>$itemName)
        {
            if(preg_match('/^item[\d]+/', $key))
            {
                array_push($itemNames, $itemName);
            }
        }

        $index = 0;

        // Copy old values having the current item names
        // This will remove other entries that were removed in the view
        $items = array();
        foreach($itemNames as $itemName)
        {
            if (array_key_exists($itemName, $oldItems))
            {
                $items[$itemName] = $oldItems[$itemName];
            }
        }
        foreach($request->all() as $key=>$price)
        {
            if(preg_match('/^price[\d]+/', $key))
            {
                //echo "key: " . $key . ", itemNames [" . $index . "] = " . $itemNames[$index] . "<br>";
                if (array_key_exists($itemNames[$index], $items))
                {
                    //echo "exists!<br>";
                    $items[$itemNames[$index]]['itemPrice'] = $price;
                }
                else
                {
                    //echo "does not exist!<br>";
                    //array_push($items, array('itemName' => $itemNames[$index], 'itemPrice' => $price));
                    $items[$itemNames[$index]] = array('itemPrice' => $price);
                }
                $index++;
            }
        }

        //print_r($items);

        Session::forget('items');
        Session::set('items', $items);

        $svcCharge = $request->input('svc-charge');
        Session::set('svcCharge', $svcCharge);

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
