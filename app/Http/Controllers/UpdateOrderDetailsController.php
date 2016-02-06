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
        $prices = array();
        $index = 0;
        $items = Session::get('items');
        foreach($request->all() as $key=>$price)
        {
            if(preg_match('/^price[\d]+/', $key))
            {
                array_push($prices, array('priceName' => $items[$index], 'priceAmount' => $price));
                //array_push($prices, $price);
                $index++;
            }
        }
        print_r($prices);
        Session::forget('prices');
        Session::set('prices', $prices);
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
