@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add a Friend</div>

                <div class="panel-body">
                    <div class="app-spacer"></div>
                    <form id="app-form" action="add_friend" method="POST">
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
                        <?php $counter = 0; ?>
                        @foreach ($friends->getCollection()->all() as $friend)
                            <?php $counter += 1; ?>
                            <div class='friend'>
                                <div class='app-label'>{{ $counter }}.</div>
                                <div class='friend-name app-column'>{{ $friend->name }}</div>
                                <div class='friend-email app-column'>{{ $friend->email }}</div>
                                <div class="app-td-tag">{!! HTML::linkRoute('delete_friend', 'Delete', $tempFriendsIds[$friend->id]) !!}</div>
                            </div>
                        @endforeach
                        @if ($friends->getCollection()->count() == 0)
                             Your friends list is still empty!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection