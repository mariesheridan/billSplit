@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Who are splitting the bill?</div>

                <div class="panel-body">
                    {{ $store }}
                    <br>
                    {{ $date }}
                    <br>
                    @foreach($persons as $key=>$person)
                        {{$person}}<br>
                    @endforeach
                    <div class="app-spacer"></div>
                    <form action="update_persons" method="POST">
                        <div id="app-persons">
                        </div>
                        <div class="app-spacer"></div>
                        <input type="button" id="addRow" value="Add" />
                        <div class="app-spacer"></div>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <div class="app-button"><input type="submit" name="back" value="<< Back"></div>
                        <div class="app-button"><input type="submit" name="next" value="Next >>"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section ('localScript')
<script src="{{ asset('js/inputs.js') }}"></script>
<script>
    setName('person');
</script>
@endsection