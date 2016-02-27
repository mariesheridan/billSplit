<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use App\Friend;

class FriendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkbox()
    {
        $friends = Friend::where('user_id', '=', Auth::user()->id)
                        ->orderBy('name', 'asc')->paginate(100);

        return view('friendscheckbox', array('friends' => $friends));
    }

    public function view()
    {
        $friends = Friend::where('user_id', '=', Auth::user()->id)
                        ->orderBy('name', 'asc')->paginate(100);

        // This is important, so that friends id will not be shown in the URL
        $tempFriendsIds = array();
        $counter = 0;
        foreach ($friends as $friend)
        {
            $counter++;
            $tempFriendsIds[$friend->id] = $counter;
        }

        Session::set('tempFriendsIds', $tempFriendsIds);

        return view('friendslist', array('friends' => $friends, 'tempFriendsIds' => $tempFriendsIds));
    }

    public function delete($id)
    {
        $flippedIds = array_flip(Session::get('tempFriendsIds', array()));
        //$transaction = Transaction::find($tempIds[$id]);
        if ($id > count($flippedIds))
        {
            return view('friendnotfound');
        }

        $friend = Friend::find($flippedIds[$id]);
        $friend->delete();

        return redirect()->route('friends_list');
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

        return redirect()->route('create_persons');
    }

    public function add(Request $request)
    {
        $friend = new Friend();

        $friend->user_id = Auth::user()->id;
        $friend->name = $request->input('friendname');
        $friend->email = $request->input('friendemail');
        $friend->save();

        return redirect()->route('friends_list');
    }
}
