<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\MyLibrary\SessionDetails;
use App\MyLibrary\TransactionHelper;
use App\Transaction;
use App\Person;
use Auth;
use HTML;
use Session;
use DB;

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

        $this->updateStatusOfReceivables();
        $this->updateStatusOfPayables();
        $this->updateUserIdInPersonsTable();

        $transactions = Transaction::where('user_id', '=', Auth::user()->id)
                        ->orderByRaw("CASE status WHEN 'Verifying' THEN 0 WHEN 'Unpaid' THEN 1 WHEN 'Paid' THEN 2 ELSE status END")
                        ->orderBy('date', 'asc')->paginate(5);

        // This is important, so that transaction id will not be shown in the URL
        $tempIds = array();
        $counter = 0;
        foreach ($transactions as $trans)
        {
            $counter++;
            $tempIds[$trans->id] = $counter;
        }

        $payables = Person::join('transactions', DB::raw('persons.transaction_id'), '=', Db::raw('transactions.id'))
                    ->where(DB::raw('persons.email'), '=', Auth::user()->email)
                    ->where(DB::raw('transactions.user_id'), '!=', Auth::user()->id)
                    ->orderByRaw("CASE persons.status WHEN 'Unpaid' THEN 0 WHEN 'Verifying' THEN 1 WHEN 'Paid' THEN 2 ELSE persons.status END")
                    ->orderBy(DB::raw('transactions.date'), 'asc')
                    ->paginate(5);

        foreach ($payables as $pay)
        {
            $counter++;
            $tempIds[$pay->transaction->id] = $counter;
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

    public function updateStatusOfReceivables()
    {
        $transactions = Transaction::where('user_id', '=', Auth::user()->id)->get();
        foreach ($transactions as $transaction)
        {
            $helper = new TransactionHelper();
            $status = $helper->getTransaction($transaction->id)->getStatus();
            $transaction->status = $status;
            $transaction->save();
        }
    }

    public function updateStatusOfPayables()
    {
        $transactions = Transaction::whereHas('persons', function($query){
                            $query->where('user_id', '=', Auth::user()->id);
                        })->where('user_id', '!=', Auth::user()->id)->get();
        foreach ($transactions as $transaction)
        {
            $helper = new TransactionHelper();
            $status = $helper->getTransaction($transaction->id)->getStatus();
            $transaction->status = $status;
            $transaction->save();
        }
    }

    public function back()
    {
        return $this->index();
    }
}
