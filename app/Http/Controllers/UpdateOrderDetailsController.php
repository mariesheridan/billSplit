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

        foreach($request->all() as $key=>$name)
        {
            if(preg_match('/^order[\d]+Name/', $key))
            {
                array_push($names, $name);
            }
        }
        echo "Names: <br>";
        print_r($names);

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
