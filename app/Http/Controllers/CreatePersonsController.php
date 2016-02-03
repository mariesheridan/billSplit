<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CreatePersonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $store = $request->input('store');
        $date = $request->input('date');
        $this->updateTransactions($store, $date);
        return view('createpersons', array('store' => $store, 'date' => $date));
    }
    
    protected function updateTransactions($store, $date){
        
    }
}
