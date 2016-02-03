<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

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
        $this->updateTransactions($store, $date);
        return view('createpersons', array('store' => $store, 'date' => $date));
    }

    protected function updateTransactions($store, $date){

    }
}
