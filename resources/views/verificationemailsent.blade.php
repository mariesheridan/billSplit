@extends('layouts.app')

@section('localStyle')
<link href="{{ asset('css/items_style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Verification</div>

                <div class="panel-body" id="item-body">
                    <p>Thanks for registering with BillSplit!</p>
                    <p>A verification link has been sent to {{ $email }}.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection