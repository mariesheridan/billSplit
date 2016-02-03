@extends('layouts.app')

@section('localStyle')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Transaction Details</div>

                <div class="panel-body">
                    <form action="create_persons" method="POST">
                        <div class="app-label">Store</div>
                        <div class="app-value"><input type="text" name="store" required></div>
                        <div class="app-spacer"></div>
                        <div class="app-label">Date</div>
                        <div class="app-value"><input id="datepicker" name="date" required></div>
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

@section('localScript')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
    $("#datepicker").datepicker();
    });
</script>
@endsection