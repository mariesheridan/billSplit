<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use App\Friend;
use App\Person;
use App\Transaction;
use App\User;
use App\MyLibrary\PersonListBuilder;
use App\MyLibrary\SessionDetails;
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
        SessionDetails::forget();
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
        foreach ($request->all() as $key=>$friendIds)
        {
            if (preg_match('/^friends$/', $key))
            {
                foreach ($friendIds as $friendId)
                {
                    $friend = Friend::find($friendId);
                    $persons->add($friend->name, $friend->email);
                }
            }
        }

        Session::set('includedFriends', $persons->getEmailArray());

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

    public function showlistforfetch($id)
    {
        $personIds = array_flip(Session::get('tempPersonsIds', array()));
        if ($id > count($personIds))
        {
            return view('personnotfound');
        }

        $person = Person::find($personIds[$id]);

        Session::set('personIdForEdit', $personIds[$id]);

        $friends = Friend::where('user_id', '=', Auth::user()->id)
                        ->orderBy('name', 'asc')->paginate(100);

        return view('friendsfortag', array('friends' => $friends, 'person' => $person, 'errorMessage' => Session::get('friendsError', "")));

    }

    public function tagFriend(Request $request)
    {
        $tempPersonsIds = Session::get('tempPersonsIds');
        $personId = Session::get('personIdForEdit');
        $tempIds = Session::get('tempIds', array());
        $transactionId = Session::get('transactionId', 0);
        $errorMessage = "";
        $input = $request->input('email');

        if ($input == "input_email")
        {
            $input = $request->input('input_email');
            if (!filter_var($input, FILTER_VALIDATE_EMAIL))
            {
                $errorMessage = "Invalid email format!";
            }
        }
        else if ($input == "input_none")
        {
            $input = "";
        }

        if ($errorMessage == "")
        {
            $person = Person::find($personId);
            $person->email = $input;
            $person->save();

            return redirect()->route('tag', array('id' => $tempIds[$transactionId]));
        }
        else
        {
            Session::set('friendsError', $errorMessage);
            return redirect()->route('showlistforfetch', array('id' => $tempPersonsIds[$personId]));
        }
    }
}
