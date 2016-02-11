@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @foreach ($transactions->getCollection()->all() as $transaction)
                        <div>{{ $transaction->id }}</div>
                    @endforeach
                    <div>{{ $transactions->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
