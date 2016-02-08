<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UpdateOrderDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update(Request $request)    
    {
        $index = 0;
        $items = Session::get('items');

        $names = array();

        foreach($request->all() as $key=>$nameArray)
        {
            echo ("key: " . $key) . "<br>";
            if(preg_match('/^order[\d]+Name/', $key))
            {
                echo "items[$index]: <br>"; 
                print_r($items[$index]);
                echo "<br>";
                $items[$index]['buyers'] = array();
                foreach($nameArray as $name)
                {
                    $qtyName = 'order' . ($index + 1) . $name;
                    $qty = $request->input($qtyName);
                    echo "qtyName = " . $qtyName . ", qty = " . $qty . "<br>";
                    array_push($items[$index]['buyers'], array('name' => $name, 'qty' => $qty));
                }
                $index++;
            }
        }

        echo "items: <br>";
        print_r($items);

        if ($request->__get('next'))
        {
            echo "Next";
//            return redirect()->route('summary');
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
