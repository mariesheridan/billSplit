<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Mail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Added this so that when user is logged out after long time with no activity, when they log in again,
     * they will be directed to home and not to the previous window they were at.
     */
    protected $redirectPath = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Overridden from Illuminate\Foundation\Auth\RegisterUsers.php
     */
    public function register(Request $request)
    {
        $this->redirectPath = 'verificationemailsent';
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Session::set('verifyEmail', $request['email']);
        $code = str_random(15);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'confirmation_code' => $code,
        ]);

        Mail::send('auth.emails.verify', array('confirmation_code' => $code), function($message) use ($request) {
            $message->from('noreply@billsplit.mstuazon.com', 'BillSplit');
            $message->to($request['email'], $request['name'])->subject('Verify your email address');
        });

        return redirect($this->redirectPath());
    }

    /**
     * Overridden from Illuminate\Foundation\Auth\AuthenticateUsers.php
     */
    protected function getCredentials(Request $request)
    {
        $usernameLabel = $this->loginUsername();
        $credentials = array();
        $credentials[$usernameLabel] = $request[$usernameLabel];
        $credentials['password'] = $request['password'];
        $credentials['confirmed'] = 1;
        return $credentials;
    }


}
