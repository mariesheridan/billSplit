@extends('layouts.app')

@section('localStyle')
<link href="{{ asset('css/items_style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Please confirm.</div>

                <div class="panel-body" id="item-body">
                    Do you want to send email notification to your friends?
                    <div class="app-spacer"></div>
                    <form id="app-form" action="send_email" method="POST">
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <div class="app-button"><input type="submit" name="yes" value="Yes"></div>
                        <div class="app-button"><input type="submit" name="no" value="No"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection