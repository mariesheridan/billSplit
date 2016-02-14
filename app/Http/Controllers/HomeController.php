<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\MyLibrary\SessionDetails;
use App\Transaction;
use App\Person;
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
                        Auth::user()->id)->orderBy('date')->simplePaginate(5);

        // This is important, so that transaction id will not be shown in the URL
        $tempIds = array();
        $counter = 0;
        foreach ($transactions as $trans)
        {
            $counter++;
            $tempIds[$trans->id] = $counter;
        }

        $this->updateUserIdInPersonsTable();

        $payables = Transaction::whereHas('persons', function($query){ 
                      $query->where('user_id', '=', Auth::user()->id);
               })
               ->where('user_id', '!=', Auth::user()->id)
               ->orderBy('date')
               ->simplePaginate(5);

        foreach ($payables as $pay)
        {
            $counter++;
            $tempIds[$pay->id] = $counter;
        }

        Session::set('tempIds', $tempIds);

        return view('home', array("transactions" => $transactions, "tempIds" => $tempIds, "payables" => $payables));
    }

    public function updateUserIdInPersonsTable()
    {
        $persons = Person::withEmail(Auth::user()->email)->get();
        foreach ($persons as $person)
        {
            $person->user_id = Auth::user()->id;
            $person->save();
        }
    }

    public function back()
    {
        return $this->index();
    }
}
