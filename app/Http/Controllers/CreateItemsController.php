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
        $store = Session::get('store');
        $date = Session::get('date');
        $items = Session::get('items', array());
        $itemNames = array_column($items, 'itemName');
        $itemPrices = array_column($items, 'itemPrice');
        $itemNamesJSArray = JSConverter::toJSArray($itemNames);
        $itemPricesJSArray = JSConverter::toJSArray($itemPrices);
        return view('createitems', array('store' => $store, 
                                         'date' => $date, 
                                         'itemNames' => $itemNamesJSArray,
                                         'itemPrices' => $itemPricesJSArray));
    }
}
