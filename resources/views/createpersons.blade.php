@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Transaction Details</div>

                <div class="panel-body">
                    {{ $store }}
                    <br>
                    {{ $date }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection