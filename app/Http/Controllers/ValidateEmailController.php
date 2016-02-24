<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\User;

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
        $message = "";
        $user = User::withConfirmationCode($confirmationCode)->first();
        if (!$user)
        {
            $message = "Sorry, wrong verification link!";
        }
        else
        {
            $user->confirmed = 1;
            $user->confirmation_code = null;
            $user->save();
            $message = "Your email address has been verified! Please proceed to the login page.";
        }

        return view('confirmemail', array('message' => $message));
    }
}
