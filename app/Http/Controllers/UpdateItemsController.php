<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\MyLibrary\ItemBuilder;

class UpdateItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update(Request $request)    
    {
        $oldItems = ItemBuilder::copyArray(Session::get('items', array()));
        $itemNames = array();
        $itemKeys = array();
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
        $items = new ItemBuilder;
        foreach($itemNames as $name)
        {
            if ($oldItems->hasName($name))
            {
                $items->addItemArray($name, $oldItems->getItem($name));
            }
        }
        foreach($request->all() as $key=>$price)
        {
            if(preg_match('/^price[\d]+/', $key))
            {
                $items->addItemByName($itemNames[$index], $price);
                $index++;

            }
        }

        Session::forget('items');
        Session::set('items', $items->getArray());

        $svcCharge = $request->input('svc-charge');
        Session::set('svcCharge', $svcCharge);

        if ($request->__get('next'))
        {
            return redirect()->route('order_details');
        }
        else if ($request->__get('back'))
        {
            return redirect()->route('create_persons');
        }
        else
        {
            echo "Ooops.. Please go back";
        }
    }
}
