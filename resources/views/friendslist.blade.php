@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add a Friend</div>

                <div class="panel-body">
                    <div class="app-spacer"></div>
                    <form id="app-form" action="add_friends" method="POST">
                        <div class="app-label-word">Name</div>
                        <div class="app-value"><input type="text" name="friendname" autofocus required></div>
                        <div class="app-spacer"></div>
                        <div class="app-label-word">Email</div>
                        <div class="app-value"><input type="text" name="friendemail" autofocus required></div>
                        <div class="app-spacer"></div>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <div class="app-button"><input type="submit" name="back" value="Add"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Friends List</div>

                <div class="panel-body">
                    <div class="app-spacer"></div>
                    <div id="app-persons">
                        <ol>
                        @foreach ($friends->getCollection()->all() as $friend)
                            <li>
                                <div class='tag-person-name app-column'>{{ $friend->name }}</div>
                                <div class='tag-email app-column'>{{ $friend->email }}</div>
                                <div class='app-column'>
                                    <div class="app-td-tag">{!! HTML::linkRoute('delete_friend', 'Delete', $tempFriendsIds[$friend->id]) !!}</div>
                                </div>
                                <div class='app-spacer'></div>
                            </li>
                        @endforeach
                        @if ($friends->getCollection()->count() == 0)
                             Your friends list is still empty!
                        @endif
                    </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection