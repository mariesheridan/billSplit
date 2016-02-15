@extends('layouts.app')

@inject('personalOrder', 'App\MyLibrary\PersonalOrders')
@inject('transactionHelper', 'App\MyLibrary\TransactionHelper')
@inject('statusClass', 'App\MyLibrary\StatusClassResolver')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Receivables</div>

                <div class="panel-body">
                    <div class='app-table'>
                    @foreach ($transactions->getCollection()->all() as $transaction)
                        <div class='app-tr'>
                            <div class='app-td-date app-column'>{{ $transaction->date }}</div>
                            <div class='app-td-store app-column'>
                                {!! HTML::linkRoute('transactions.show', $transaction->store, $tempIds[$transaction->id]) !!}
                            </div>
                            <div class='app-td-persons app-column'>
                                <?php 
                                    $personsList = [];
                                    foreach ($transaction->persons as $person)
                                    {
                                        array_push($personsList, $person->name);
                                    }
                                    echo implode(", ", $personsList);
                                ?>
                            </div>
                            <div class='app-td-price app-column'>
                                {!! $transactionHelper->setId($transaction->id) !!}
                                {{ number_format($transactionHelper->getTotal(), 2) }}
                            </div>
                            <div class='app-td-status app-column {{ $statusClass->getStatusClass($transactionHelper->getStatus()) }}'>
                                {{ $transaction->status }}                            
                            </div>
                            <div class='app-column'>
                                <div class="app-td-tag">{!! HTML::linkRoute('tag', 'Tag', $tempIds[$transaction->id]) !!}</div>
                                <div class="app-td-tag">{!! HTML::linkRoute('transactions.edit', 'Edit', $tempIds[$transaction->id]) !!}</div>
                            </div>

                            <div class='app-spacer'></div>
                        </div>
                    @endforeach
                    @if ($transactions->getCollection()->count() == 0)
                         You don't have any transactions! 
                    @endif
                    </div>
                    <div>{{ $transactions->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='app-spacer'></div>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Payables</div>

                <div class="panel-body">
                    <div class='app-table'>
                    @foreach ($payables->getCollection()->all() as $payable)
                        <div class='app-tr'>
                            <div class='app-td-date app-column'>
                                {{ $payable->date }}
                            </div>
                            <div class='app-td-store app-column'>
                                {!! HTML::linkRoute('transactions.show', $payable->store, $tempIds[$payable->id]) !!}
                            </div>
                            <div class='app-td-pay-to app-column'>Pay to: {!! $payable->user->name !!}</div>
                            <div class='app-td-price app-column'>
                                {!! $personalOrder->setUserId($payable->id, Auth::user()->id) !!}
                                {{ number_format($personalOrder->getTotal(), 2) }}
                            </div>
                            <div class='app-td-status app-column {{ $statusClass->getStatusClass($personalOrder->getStatus()) }}'>
                                {{ $personalOrder->getStatus() }}                            
                            </div>
                            <div class='app-spacer'></div>
                        </div>
                    @endforeach
                    @if ($payables->getCollection()->count() == 0)
                         You don't have any payables! 
                    @endif
                    </div>
                    <div>{{ $payables->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
