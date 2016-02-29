@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">What are their emails?</div>

                <div class="panel-body">
                    <form action="/save_the_tag" method="POST">
                        @foreach ($persons as $person)
                        <?php
                            $key = preg_replace('/[^a-zA-Z0-9]/', '', $person->name);
                        ?>
                        <div class="tag-block">
                            <div class='tag-person-name'>{{ $person->name }}</div>
                            <div class='tag-email'>{{ $person->email }} &nbsp</div>
                            <div class='tag-person-name'>{!! HTML::linkRoute('showlistforfetch', 'Edit', $tempPersonsIds[$person->id]) !!}</div>
                            <div class='tag-person-name'>{{ $person->status }}</div>
                            <div class='tag-checkbox'>
                                <?php
                                    $isBoxChecked = "";
                                    if ($person['status'] == "Unpaid")
                                    {
                                        $isBoxChecked = "checked";
                                    }
                                ?>
                                <input type='checkbox' id="send_{{$key}}_checkbox" name='send_{{$key}}' {{$isBoxChecked}}>
                                <label for="send_{{$key}}_checkbox">Send Notification</label>
                            </div>
                            <div class='app-spacer'></div>
                        </div>
                        @endforeach
                        <div class="app-spacer"></div>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <div class="app-button"><input type="submit" name="back" value="<< Back"></div>
                        <div class="app-button"><input type="submit" name="next" value="Save & Send"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
