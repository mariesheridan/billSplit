<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;
use Session;
use App\Transaction;
use App\Person;
use App\User;
use App\MyLibrary\Tools;
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
        // Forget the specific person when all persons are shown
        Session::forget('personIdForEdit');
        Session::forget('friendsError');

        $tempIds = array_flip(Session::get('tempIds', array()));

        if ($id > count($tempIds))
        {
            return view('transactionnotfound');
        }

        $transaction = Transaction::find($tempIds[$id]);

        $persons = $transaction->persons;
        $counter = 0;
        $tempPersonsIds = array();
        foreach ($persons as $person)
        {
            $counter++;
            $tempPersonsIds[$person->id] = $counter;
        }

        Session::set('transactionId', $tempIds[$id]);
        Session::set('tempPersonsIds', $tempPersonsIds);

        return view('tag', array('persons' => $persons,
                                 'tempPersonsIds' => $tempPersonsIds));
    }

    public function save(Request $request)
    {
        if ($request->__get('next'))
        {
            $this->sendEmail($request);
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

    private function sendEmail(Request $request)
    {
        $transactionId = Session::get('transactionId', 0);
        $personsWithEmail = Session::get('personsWithEmail', array());
        $transaction = Transaction::find($transactionId);

        if ($transaction)
        {
            $persons = $transaction->persons;
            foreach ($persons as $person)
            {
                $key = Tools::removeSpaces($person->name);
                // Send email only to entries with email addresses
                if (($person->email != '') && ($request->input('send_' . $key)))
                {
                    $email = $person->email;
                    $name = $person->name;
                    Mail::send('emails.personalbill',
                                array('dbTransaction' => $transaction, 'person' => $person),
                                function($message) use ($email, $name, $transaction)
                    {
                        $message->from('noreply@billsplit.mstuazon.com', 'BillSplit');
                        $message->to($email, $name)->subject('Reminder for payment for purchase at ' . $transaction->store . " on " . date('F j, Y', strtotime($transaction->date)));
                    });
                }
            }
        }
    }
}
