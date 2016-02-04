<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Routing\Redirector;
use App\Transaction;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UpdateTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update(Request $request){
        Session::set('store', $request->input('store'));
        Session::set('date', $request->input('date'));
        $trans = Transaction::create(array('user_id' => $request->user()->id,
                                           'date' => $request->input('date'),
                                           'store' => $request->input('store')));
        Session::set('transactionId', $trans->id);
        return redirect()->route('create_persons');
    }
}
