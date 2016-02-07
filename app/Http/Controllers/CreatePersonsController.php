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
        $personsJSArray = JSConverter::toJSArray($persons);
//        $transId = Session::get('transactionId');
//        $transaction = Transaction::find($transId);
//        return view('createpersons', array('store' => $transaction->store, 'date' => $transaction->date));
        return view('createpersons', array('store' => $store, 'date' => $date, 'persons' => $personsJSArray));
    }
}
