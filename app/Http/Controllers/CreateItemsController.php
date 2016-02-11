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
        $items = ItemBuilder::copyArray(Session::get('items', array()));

        return view('createitems', array('store' => $store, 
                                         'date' => $date,
                                         'svcCharge' => $svcCharge,
                                         'items' => $items->toJSObject()));
    }
}
