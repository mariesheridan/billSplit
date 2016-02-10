<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyLibrary\JSConverter;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SummaryController extends Controller
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
        $personsJSArray = JSConverter::toJSArray($persons);
        $items = Session::get('items', array());
        $itemsJSObject = JSConverter::toJSItemObject($items);
        $itemNames = array_keys($items);
        $itemNamesJSArray = JSConverter::toJSArray($itemNames);

        return view('summary', array('store' => $store,
                                     'date' => $date,
                                     'svcCharge' => $svcCharge,
                                     'persons' => $personsJSArray,
                                     'items' => $itemsJSObject,
                                     'itemNames' => $itemNamesJSArray));
    }
}
