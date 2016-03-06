<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\MyLibrary\SessionDetails;

class CreateTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $store = Session::get('store', '');
        $date = Session::get('date', '');
        return view('createtransaction', array('store' => $store, 'date' => $date));
    }

    public function beforeCreate()
    {
        SessionDetails::forget();
        return redirect()->route('create_transaction');
    }
}
