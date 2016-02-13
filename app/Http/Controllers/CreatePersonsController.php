<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Transaction;
use App\MyLibrary\JSConverter;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CreatePersonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $store = Session::get('store');
        $date = Session::get('date');
        $persons = Session::get('persons', array());
        $personsJSObject = JSConverter::toJSObject($persons);
        return view('createpersons', array('store' => $store, 'date' => $date, 'persons' => $personsJSObject));
    }
}
