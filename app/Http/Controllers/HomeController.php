<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\MyLibrary\SessionDetails;
use App\Transaction;
use Auth;
use HTML;
use Session;

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

        // This is important, so that transaction id will not be shown in the URL
        $tempIds = array();
        $counter = 0;
        foreach ($transactions as $trans)
        {
            $counter++;
            $tempIds[$trans->id] = $counter;
        }
        Session::set('tempIds', $tempIds);
        return view('home', array("transactions" => $transactions, "tempIds" => $tempIds));
    }

    public function back()
    {
        return $this->index();
    }
}
