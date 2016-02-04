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
                array_push($persons, $person);
            }
        }
        Session::forget('persons');
        Session::set('persons', $persons);

        return redirect()->route('create_items');
    }
}
