<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\MyLibrary\JSConverter;
use App\MyLibrary\ItemBuilder;

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
        $svcCharge = Session::get('svcCharge', 0);
        $persons = Session::get('persons', array());
        $personsJSObject = JSConverter::toJSObject($persons);
        $items = ItemBuilder::copyArray(Session::get('items', array()));
        //$itemNames = array_keys($items);
        $itemNames = $items->getKeys();
        //print_r($itemNames);
        //echo"<br>";
        $itemNamesJSArray = JSConverter::toJSArray($itemNames);
        //$itemsJSArray = JSConverter::toJSItemObject($items);
        //echo "--itemsJSArray--<br>";
        //print_r($itemsJSArray);
        //echo "<br>--end--";
        return view('orderdetails', array('store' => $store, 
                                          'date' => $date,
                                          'svcCharge' => $svcCharge,
                                          'persons' => $personsJSObject,
                                          'itemNames' => $itemNamesJSArray,
                                          'items' => $items->toJSObject()));
    }
}
