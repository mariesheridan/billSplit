<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CreateItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $persons = Session::get('persons');
        return view('createitems', array('persons' => $persons));
    }

    protected function updateTransactions($store, $date){

    }
}
