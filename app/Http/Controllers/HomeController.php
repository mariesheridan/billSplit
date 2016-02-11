<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\MyLibrary\SessionDetails;
use App\Transaction;
use Auth;
use HTML;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SessionDetails::forget();
        $transactions = Transaction::where('user_id', '=', 
                        Auth::user()->id)->orderBy('date')->simplePaginate(10);
        return view('home', array("transactions" => $transactions));
    }
}
