<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\MyLibrary\JSConverter;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $store = Session::get('store', "");
        $date = Session::get('date', "");
        $persons = Session::get('persons', array());
        $personsJSArray = JSConverter::toJSArray($persons);
        $items = Session::get('items', array());
        $itemNames = array_keys($items);
        print_r($itemNames);
        echo"<br>";
        $itemPrices = array();
        foreach ($items as $item)
        {
            array_push($itemPrices, $item['itemPrice']);
        }
        print_r($itemPrices);
        echo"<br>";
        $itemNamesJSArray = JSConverter::toJSArray($itemNames);
        $itemPricesJSArray = JSConverter::toJSArray($itemPrices);
        $buyers = array_column($items, 'buyers');
        $itemsJSArray = "[";
        foreach($items as $item)
        {
            $itemsJSArray .= "{";
            $itemsJSArray .= "itemName: '" . key($item) . "', ";
            $itemsJSArray .= "itemPrice: '" . $item['itemPrice'] . "', ";
            if (array_key_exists('buyers', $item))
            {
                $itemsJSArray .= "buyers: [";
                foreach ($item['buyers'] as $buyer)
                {
                    $itemsJSArray .= '{';
                    $itemsJSArray .= "name: '" . $buyer['name'] . "', ";
                    $itemsJSArray .= "qty: " . $buyer['qty'];
                    $itemsJSArray .= '}, ';
                }
                $itemsJSArray .= "]";
            }
            $itemsJSArray .= "},";
        }
        $itemsJSArray .= "]";
        echo "--itemsJSArray--<br>";
        print_r($itemsJSArray);
        echo "<br>--end--";
        return view('orderdetails', array('store' => $store, 
                                          'date' => $date, 
                                          'persons' => $personsJSArray, 
                                          'itemNames' => $itemNamesJSArray,
                                          'itemPrices' => $itemPricesJSArray,
                                          'buyers' => $buyers));
    }
}
