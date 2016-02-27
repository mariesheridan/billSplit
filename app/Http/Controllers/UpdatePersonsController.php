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
        foreach($request->all() as $key=>$person)
        {
            if(preg_match('/^person[\d]+/', $key))
            {
                $persons->add($person);
            }
        }

        Session::forget('persons');
        Session::set('persons', $persons->getArray());

        if ($request->__get('next'))
        {
            return redirect()->route('create_items');
        }
        else if ($request->__get('back'))
        {
            return redirect()->route('create_transaction');
        }
        else if ($request->__get('addressbook'))
        {
            return redirect()->route('view_address_book');
        }
        else
        {
            echo "Ooops.. Please go back";
        }
    }
}
