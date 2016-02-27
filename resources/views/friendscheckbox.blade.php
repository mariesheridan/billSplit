@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Check the box beside the name.</div>

                <div class="panel-body">
                    <div class="app-spacer"></div>
                    <form id="app-form" action="include_friends" method="POST">
                        <div id="app-persons">
                            @foreach ($friends->getCollection()->all() as $friend)
                            <div class='friend'>
                                <span class='friend-name'>
                                    <input type='checkbox' id='friend_{{ $friend->id }}' name='friends[]' value='{{ $friend->id }}'>
                                    <label for='friend_{{ $friend->id }}'>
                                        {{ $friend->name }}
                                    </label>
                                </span>
                                <span class='friend-email'>{{ $friend->email }}</span>
                            </div>
                            @endforeach
                            @if ($friends->getCollection()->count() == 0)
                                 Your friends list is still empty!
                            @endif
                        </div>
                        <div class="app-spacer"></div>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <div class="app-button"><input type="submit" name="back" value="Done"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection