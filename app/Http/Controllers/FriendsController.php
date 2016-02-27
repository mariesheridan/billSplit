<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use App\Friend;
use App\User;
use App\MyLibrary\PersonListBuilder;
use App\MyLibrary\Tools;

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
        $friendsError = Session::get('friendsError', "");
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

        return view('friendslist', array('friends' => $friends, 
                                         'tempFriendsIds' => $tempFriendsIds, 
                                         'friendsError' => $friendsError));
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

    public function includeFriend(Request $request)
    {
        $persons = new PersonListBuilder;
        $persons->copyArrayWithEmail(Session::get('persons', array()));
        foreach ($request->all() as $key=>$friendIds)
        {
            if (preg_match('/^friends$/', $key))
            {
                foreach ($friendIds as $friendId)
                {
                    $friend = Friend::find($friendId);
                    $persons->addWithEmail($friend->name, $friend->email);                    
                }
            }
        }

        Session::set('persons', $persons->getEmailArray());

        return redirect()->route('create_persons');
    }

    public function add(Request $request)
    {
        $name = Tools::removeSpaces($request->input('friendname'));
        $friendsError = "";

        $user = User::find(Auth::user()->id);

        foreach ($user->friends as $friendOfUser)
        {
            $friendName = Tools::removeSpaces($friendOfUser->name);
            if ($friendName == $name)
            {
                $friendsError = "Please use another name.";
            }
        }

        $email = $request->input('friendemail');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $friendsError = "Invalid email format!"; 
        }

        if ($friendsError == "")
        {
            $friend = new Friend();
            $friend->user_id = Auth::user()->id;
            $friend->name = $request->input('friendname');
            $friend->email = $request->input('friendemail');
            $friend->save();
        }

        Session::set('friendsError', $friendsError);

        return redirect()->route('friends_list');
    }
}
