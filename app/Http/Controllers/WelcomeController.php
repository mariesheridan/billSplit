<?php

namespace App\Http\Controllers;

use App\MyLibrary\SessionDetails;

use App\Http\Requests;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SessionDetails::forget();
        return view('welcome');
    }
}
