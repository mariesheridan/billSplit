<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Person;
use Session;

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
