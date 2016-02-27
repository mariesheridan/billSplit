<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\Transaction;
use App\MyLibrary\JSConverter;
use App\MyLibrary\PersonListBuilder;

class CreatePersonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $store = Session::get('store');
        $date = Session::get('date');
        $persons = new PersonListBuilder;
        $persons->copyArrayWithEmail(Session::get('persons', array()));
        $personsJSObject = $persons->namesToJSObject();
        return view('createpersons', array('store' => $store, 'date' => $date, 'persons' => $personsJSObject));
    }
}
