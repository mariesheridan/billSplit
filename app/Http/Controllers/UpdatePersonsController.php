<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\MyLibrary\PersonListBuilder;

class UpdatePersonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        $persons = new PersonListBuilder;
        $savedPersons = new PersonListBuilder;
        $savedPersons->copyArrayWithEmail(Session::get('persons', array()));

        foreach($request->all() as $key=>$person)
        {
            if(preg_match('/^person[\d]+/', $key))
            {
                echo $person . " : " . $savedPersons->getEmail($person) . "<br>";
                $persons->add($person, $savedPersons->getEmail($person), $savedPersons->getStatus($person));
            }
        }

        Session::set('persons', $persons->getEmailArray());

        if ($request->__get('next'))
        {
            return redirect()->route('create_items');
        }
        else if ($request->__get('back'))
        {
            return redirect()->route('create_transaction');
        }
        else
        {
            echo "Ooops.. Please go back";
        }
    }
}
