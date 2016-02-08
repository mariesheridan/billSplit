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
        $itemNamesJSArray = JSConverter::toJSArray(array_column($items, 'itemName'));
        $itemPricesJSArray = JSConverter::toJSArray(array_column($items, 'itemPrice'));
        $buyers = array_column($items, 'buyers');
        return view('orderdetails', array('store' => $store, 
                                          'date' => $date, 
                                          'persons' => $personsJSArray, 
                                          'itemNames' => $itemNamesJSArray,
                                          'itemPrices' => $itemPricesJSArray,
                                          'buyers' => $buyers));
    }
}
