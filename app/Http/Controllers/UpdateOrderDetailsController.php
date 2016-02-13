<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\MyLibrary\ItemBuilder;

class UpdateOrderDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update(Request $request)    
    {
        $index = 0;
        $items = ItemBuilder::copyArray(Session::get('items'));
        $items->resetBuyers();

        foreach($request->all() as $key=>$nameArray)
        {
            if(preg_match('/^order[\d]+Name$/', $key))
            {
                $itemNameId = $key . "-item-name";
                $itemName = $request->input($itemNameId);
                foreach($nameArray as $name)
                {
                    $qtyName = 'order' . ($index + 1) . preg_replace('/[^a-zA-Z0-9]/', '', $name);
                    $qty = $request->input($qtyName);
                    $items->addBuyer($itemName, $name, $qty);
                }
                $index++;
            }
        }

        Session::forget('items');
        Session::set('items', $items->getArray());

        if ($request->__get('next'))
        {
            echo "Next";
            return redirect()->route('summary');
        }
        else if ($request->__get('back'))
        {
            echo "Back";
            return redirect()->route('create_items');
        }
        else
        {
            echo "Ooops.. Please go back";
        }
    }
}
