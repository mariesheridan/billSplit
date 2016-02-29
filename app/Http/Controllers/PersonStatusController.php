<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Person;
use Session;
use Mail;

class PersonStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setVerifying(Request $request)
    {
        $id = $request->input("person_id");

        $person = Person::find($id);
        if ($person)
        {
            $person->status = "Verifying";
            $person->save();

            $email = $person->transaction->user->email;
            $name = $person->transaction->user->name;
            $transaction = $person->transaction;
            $payerName = $person->name;
            Mail::send('emails.paymentnotification',
                        array('person' => $person),
                        function($message) use ($email, $name, $transaction, $payerName)
            {
                $message->from('noreply@billsplit.mstuazon.com', 'BillSplit');
                $message->to($email, $name)->subject('Payment made by ' . $payerName . ' for transaction at ' . $transaction->store . " on " . date('F j, Y', strtotime($transaction->date)));
            });
        }

        return redirect()->route('transactions.show', array('id' => $this->getTempId()));
    }

    public function setUnpaid(Request $request)
    {
        $id = $request->input("person_id");

        $person = Person::find($id);
        if ($person)
        {
            $person->status = "Unpaid";
            $person->save();
        }

        return redirect()->route('transactions.show', array('id' => $this->getTempId()));
    }

    public function setPaid(Request $request)
    {
        $id = $request->input("person_id");

        $person = Person::find($id);
        if ($person)
        {
            $person->status = "Paid";
            $person->save();
        }

        return redirect()->route('transactions.show', array('id' => $this->getTempId()));
    }

    public function getTempId()
    {
        $transactionId = Session::get('transactionId', 0);

        // This is necessary because of the workaround for hiding the real transaction ID in URL
        $tempIds = Session::get('tempIds', array());
        $tempId = 0;

        if (array_key_exists($transactionId, $tempIds))
        {
            $tempId = $tempIds[$transactionId];
        }

        return $tempId;
    }
}
