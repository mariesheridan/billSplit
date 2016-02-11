<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Routing\Redirector;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UpdatePersonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update(Request $request)    
    {
        $persons = array();
        foreach($request->all() as $key=>$person)
        {
            if(preg_match('/^person[\d]+/', $key))
            {
                //array_push($persons, $person);
                $persons[str_replace(' ', '', $person)] = $person;
            }
        }
        //print_r($persons);
        Session::forget('persons');
        Session::set('persons', $persons);

        if ($request->__get('next'))
        {
            echo "Next";
            return redirect()->route('create_items');
        }
        else if ($request->__get('back'))
        {
            echo "Back";
            return redirect()->route('create_transaction');
        }
        else
        {
            echo "Ooops.. Please go back";
        }
    }
}
