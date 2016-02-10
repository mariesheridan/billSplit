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
        $itemNamesJSArray = JSConverter::toJSArray($itemNames);
        $buyers = array_column($items, 'buyers');
        $itemsJSArray = JSConverter::toJSItemObject($items);
        echo "--itemsJSArray--<br>";
        print_r($itemsJSArray);
        echo "<br>--end--";
        return view('orderdetails', array('store' => $store, 
                                          'date' => $date, 
                                          'persons' => $personsJSArray,
                                          'itemNames' => $itemNamesJSArray,
                                          'items' => $itemsJSArray,
                                          'buyers' => $buyers));
    }
}
