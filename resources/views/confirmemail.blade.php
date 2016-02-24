@extends('layouts.app')

@section('localStyle')
<link href="{{ asset('css/items_style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Confirmation</div>

                <div class="panel-body" id="item-body">
                    {{ $message }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection