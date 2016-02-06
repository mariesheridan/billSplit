<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

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
        $store = Session::get('store');
        $date = Session::get('date');
        $persons = Session::get('persons');
        $items = Session::get('items');
        $prices = Session::get('prices', array());
        return view('orderdetails', 
                     array('store' => $store, 
                           'date' => $date, 
                           'persons' => $persons, 
                           'items' => $items,
                           'prices' => $prices
                     )
                   );
    }
}
