<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Friend;

class AddressBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        $friends = Friend::where('user_id', '=', Auth::user()->id)
                        ->orderBy('name', 'asc')->paginate(100);

        return view('addressbook', array('friends' => $friends));
    }

    public function include(Request $request)
    {
        foreach ($request->all() as $key=>$checkedFriend)
        {
            if (preg_match('/^friend_(.*)/', $key))
            {
                echo $key . "<br>";
            }
        }
    }
}
