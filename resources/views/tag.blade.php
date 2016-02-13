@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <form action="/save_the_tag" method="POST">
                        @foreach ($persons as $key => $person)
                        <div class="tag-block">
                            <div class='tag-person-name'>{{ $person['name'] }}</div>
                            <div class='tag-email'><input type='text' name='tag_{{$key}}' value="{{$person['email']}}"></div>
                            <div class='app-spacer'></div>
                        </div>
                        @endforeach
                        <div class="app-spacer"></div>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <div class="app-button"><input type="submit" name="back" value="<< Back"></div>
                        <div class="app-button"><input type="submit" name="next" value="Save"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
