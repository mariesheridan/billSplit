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

        foreach($request->all() as $key=>$nameArray)
        {
            //echo ("key: " . $key) . "<br>";
            if(preg_match('/^order[\d]+Name$/', $key))
            {
                //echo "items[$index]: <br>"; 
                $itemNameId = $key . "-item-name";
                //echo "itemNameId = " . $itemNameId . ", value = " . $request->input($itemNameId) . "<br>";
                //print_r($items[$request->input($itemNameId)]);
                //print_r($items->getItem($request->input($itemNameId)));
                //echo "<br>";
                $itemName = $request->input($itemNameId);
                foreach($nameArray as $name)
                {
                    $qtyName = 'order' . ($index + 1) . str_replace(' ', '', $name);
                    $qty = $request->input($qtyName);
                    //echo "qtyName = " . $qtyName . ", qty = " . $qty . "<br>";
                    $items->addBuyer($itemName, $name, $qty);
                }
                $index++;
            }
        }

        //echo "items: <br>";
        //print_r($items->getArray());

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
