<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\MyLibrary\JSConverter;
use App\MyLibrary\ItemBuilder;
use App\MyLibrary\PersonListBuilder;

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
        $persons = new PersonListBuilder;
        $persons->copyArrayWithEmail(Session::get('persons', array()));
        $personsJSObject = $persons->namesToJSObject();
        $items = ItemBuilder::copyArray(Session::get('items', array()));
        $itemNames = $items->getKeys();
        $itemNamesJSArray = JSConverter::toJSArray($itemNames);

        return view('summary', array('store' => $store,
                                     'date' => $date,
                                     'svcCharge' => $svcCharge,
                                     'persons' => $personsJSObject,
                                     'items' => $items->toJSObject(),
                                     'itemNames' => $itemNamesJSArray));
    }
}
