<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;

class ValidateEmailController extends Controller
{
    public function index()
    {
        $email = Session::get('verifyEmail');
        Session::forget('verifyEmail');

        return view('verificationemailsent', array('email' => $email));
    }

    public function confirm($confirmationCode)
    {
        
    }
}
