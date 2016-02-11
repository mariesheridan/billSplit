<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\MyLibrary\JSConverter;
use App\MyLibrary\ItemBuilder;

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
        $personsJSObject = JSConverter::toJSObject($persons);
        $items = ItemBuilder::copyArray(Session::get('items', array()));
        $itemNames = $items->getKeys();
        $itemNamesJSArray = JSConverter::toJSArray($itemNames);

        //echo "items:<br>";
        //print_r($items->getArray());
        //echo "<br>itemsJS<br>";
        //print_r($items->toJSObject());

        return view('summary', array('store' => $store,
                                     'date' => $date,
                                     'svcCharge' => $svcCharge,
                                     'persons' => $personsJSObject,
                                     'items' => $items->toJSObject(),
                                     'itemNames' => $itemNamesJSArray));
    }
}
