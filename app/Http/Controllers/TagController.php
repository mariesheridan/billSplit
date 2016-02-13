<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\Transaction;
use App\Person;
use App\MyLibrary\TransactionDetails;
use App\MyLibrary\PersonListBuilder;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
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
        $personsWithEmail = $transaction->getPersonList();

        Session::set('transactionId', $tempIds[$id]);
        Session::set('personsWithEmail', $personsWithEmail);

        return view('tag', array('store' => $store,
                                     'date' => $date,
                                     'persons' => $personsWithEmail));
    }

    public function save(Request $request)
    {
        $transactionId = Session::get('transactionId', 0);
        $personsWithEmail = Session::get('personsWithEmail', array());
        $transaction = Transaction::find($transactionId);
        foreach($request->all() as $key=>$email)
        {
            if(preg_match('/^tag_(.*)/', $key))
            {
                $name = substr($key, strpos($key, "_") + 1);    
                $personsWithEmail[$name]['email'] = $email;
            }
        }

        foreach($personsWithEmail as $person)
        {
            $buyer = Person::forTransaction($transactionId)->withName($person['name'])->first();

            if ($buyer)
            {
                $buyer->email = $person['email'];
                $buyer->save();
            }

        }

        if ($request->__get('next'))
        {
            return redirect()->route('home');
        }
        else if ($request->__get('back'))
        {
            return redirect()->route('home');
        }
        else
        {
            echo "Ooops.. Please go back";
        }
    }
}
