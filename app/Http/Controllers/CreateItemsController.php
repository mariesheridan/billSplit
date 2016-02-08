<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\MyLibrary\JSConverter;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CreateItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $store = Session::get('store', "");
        $date = Session::get('date', "");
        $items = Session::get('items', array());
        $itemNames = array_keys($items);
        print_r($items);
        echo "<br>";
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
        return view('createitems', array('store' => $store, 
                                         'date' => $date, 
                                         'itemNames' => $itemNamesJSArray,
                                         'itemPrices' => $itemPricesJSArray));
    }
}
