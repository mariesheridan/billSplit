@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Enter the email you want to use for {{ $person->name }}.</div>

                <div class="panel-body">
                    <div class="app-spacer"></div>
                    <form id="app-form" action="/tag_friend" method="POST">
                        <div id="app-persons">
                            <div class="friend">
                                <span class='friend-name'>
                                    <input type='radio' id='new_email' name='email' value='input_email' checked>
                                    <label for='new_email'>
                                        Enter Email:
                                    </label>
                                </span>
                                <span class='friend-email'><input type='text' id="input_email" name="input_email" autofocus></span>
                            </div>
                            <div class="app-spacer"></div>
                            @if ($errorMessage != "")
                                <div class='help-block'><strong>{{ $errorMessage }}</strong></div>
                                <div class="app-spacer"></div>
                            @endif
                            <div class="friend">
                                <span class='friend-name'>
                                    <input type='radio' id='no_email' name='email' value='input_none'>
                                    <label for='no_email'>
                                        None
                                    </label>
                                </span>
                            </div>
                            <div class="app-spacer"></div>
                            @foreach ($friends->getCollection()->all() as $friend)
                            <div class='friend'>
                                <span class='friend-name'>
                                    <input type='radio' id='friend_{{ $friend->id }}' name='email' value='{{ $friend->email }}'>
                                    <label for='friend_{{ $friend->id }}'>
                                        {{ $friend->name }}
                                    </label>
                                </span>
                                <span class='friend-email'>{{ $friend->email }}</span>
                            </div>
                            <div class="app-spacer"></div>
                            @endforeach
                            @if ($friends->getCollection()->count() == 0)
                                 Your friends list is still empty!
                            @endif
                        </div>
                        <div class="app-spacer"></div>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <div class="app-button"><input type="submit" name="done" value="Done"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('localScript')
<script>
    $(document).ready(function() {
        $('.friend-email').on('click', function(){
            $radio = $(this).closest('.friend').find('input:radio');
            $radio.prop('checked', true);
        });
    });
</script>
@endsection