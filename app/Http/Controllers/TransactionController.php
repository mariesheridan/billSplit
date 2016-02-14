<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Transaction;
use App\MyLibrary\TransactionDetails;
use Session;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tempIds = array_flip(Session::get('tempIds', array()));
        //$transaction = Transaction::find($tempIds[$id]);
        if ($id > count($tempIds))
        {
            return view('transactionnotfound');
        }
        $transaction = new TransactionDetails($tempIds[$id]);

        $store = $transaction->getStore();
        $date = $transaction->getDate();
        $svcCharge = $transaction->getSvcCharge();
        $persons = $transaction->getPersonNames()->toJSObject();
        $items = $transaction->getItems()->toJSObject();
        $itemNames = "[]";
        return view('showtransaction', array('store' => $store,
                                     'date' => $date,
                                     'svcCharge' => $svcCharge,
                                     'persons' => $persons,
                                     'items' => $items,
                                     'itemNames' => $itemNames));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tempIds = array_flip(Session::get('tempIds', array()));
        //$transaction = Transaction::find($tempIds[$id]);
        if ($id > count($tempIds))
        {
            return view('transactionnotfound');
        }
        $transaction = new TransactionDetails($tempIds[$id]);

        $store = $transaction->getStore();
        $date = $transaction->getDate();
        $svcCharge = $transaction->getSvcCharge();
        $persons = $transaction->getPersonNames()->getArray();
        $items = $transaction->getItems()->getArray();

        Session::set('store', $store);
        Session::set('date', $date);
        Session::set('svcCharge', $svcCharge);
        Session::set('persons', $persons);
        Session::set('items', $items);

        return redirect()->route('create_transaction');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
