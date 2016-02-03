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
                    <div class="app-spacer"></div>
                    <form action="update_persons" method="POST">
                        <div id="app-persons">
                            <div class="app-label">1.</div>
                            <div class="app-value"><input type="text" name="person1" required></div>
                        </div>
                        <div class="app-spacer"></div>
                        <input type="button" id="addRow" value="Add" />
                        <div class="app-spacer"></div>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <div class="app-button"><input type="submit" value="Next >>"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section ('localScript')
<script>
    var counter = 1;
    $(document).ready(function () {

        $("#addRow").click(function () {
            counter++;
            var appendValue = "<div class='app-spacer'></div>";
            appendValue = appendValue + "<div class='app-label'>" + counter + ".</div>";
            appendValue = appendValue + "<div class='app-value'><input type='text' name='person" + counter + "' required></div>";
            $("#app-persons").append(appendValue);
        });
    });
</script>
@endsection