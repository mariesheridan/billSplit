<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\MyLibrary\JSConverter;
use App\MyLibrary\ItemBuilder;

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
        $svcCharge = Session::get('svcCharge', 0);
        //$items = Session::get('items', array());
        $items = ItemBuilder::copyArray(Session::get('items', array()));
        //$itemNames = array_keys($items);
        $itemNames = $items->getKeys();
        print_r($items->getItems());
        echo "<br> keys: <br>";
        print_r($itemNames);
        echo"<br>";
        $itemPrices = array();
        foreach ($items as $item)
        {
            array_push($itemPrices, $item['itemPrice']);
        }
        //print_r($itemPrices);
        //echo"<br>";
        echo "toJSObject:<br>";
        echo $items->toJSObject();
        $itemNamesJSArray = JSConverter::toJSArray($itemNames);
        $itemPricesJSArray = JSConverter::toJSArray($itemPrices);
        return view('createitems', array('store' => $store, 
                                         'date' => $date,
                                         'svcCharge' => $svcCharge,
                                         'itemNames' => $itemNamesJSArray,
                                         'itemPrices' => $itemPricesJSArray,
                                         'items' => $items->toJSObject()));
    }
}
