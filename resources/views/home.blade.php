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
                            <div class='app-td-date app-column'>{{ date('m/d/Y', strtotime($transaction->date)) }}</div>
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
                                {{ number_format($transactionHelper->getTransaction($transaction->id)->getTotal(), 2) }}
                            </div>
                            <div class='app-td-status app-column {{ $statusClass->getStatusClass($transactionHelper->getStatus()) }}'>
                                {{ $transaction->status }}
                            </div>
                            <div class='app-column'>
                                <div class="app-td-tag">{!! HTML::linkRoute('tag', 'Remind', $tempIds[$transaction->id]) !!}</div>
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
                                {{ date('m/d/Y', strtotime($payable->transaction->date)) }}
                            </div>
                            <div class='app-td-store app-column'>
                                {!! HTML::linkRoute('transactions.show', $payable->transaction->store, $tempIds[$payable->transaction->id]) !!}
                            </div>
                            <div class='app-td-pay-to app-column'>Pay to: {!! $payable->transaction->user->name !!}</div>
                            <div class='app-td-price app-column'>
                                {!! $personalOrder->setUserId($payable->transaction->id, Auth::user()->id) !!}
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
