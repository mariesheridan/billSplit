<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\Transaction;
use App\MyLibrary\JSConverter;
use App\MyLibrary\PersonListBuilder;

class CreatePersonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $store = Session::get('store');
        $date = Session::get('date');
        $persons = new PersonListBuilder;
        $persons->copyArrayWithEmail(Session::get('persons', array()));

        // These are the people from the friends list that you included
        $persons->appendArrayWithEmail(Session::get('includedFriends', array()));
        $personsJSObject = $persons->namesToJSObject();
        
        // We need to forget this so that when we remove a person, it will not be shown again in this page.
        Session::forget('includedFriends');
        
        return view('createpersons', array('store' => $store, 'date' => $date, 'persons' => $personsJSObject));
    }
}
