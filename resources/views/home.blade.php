@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class='app-table'>
                    <table>
                    @foreach ($transactions->getCollection()->all() as $transaction)
                        <tr class='app-tr'>
                            <td class='app-td-date'>{{ $transaction->date }}</td>
                            <td class='app-td-store'>
                                {!! HTML::linkRoute('transactions.show', $transaction->store, $tempIds[$transaction->id]) !!}
                            </td>
                            <td class='app-td-persons'>
                                <?php 
                                    $personsList = [];
                                    foreach ($transaction->persons as $person)
                                    {
                                        array_push($personsList, $person->name);
                                    }
                                    echo implode(", ", $personsList);
                                ?>
                            </td>
                            <td class='app-td-tag'>
                                {!! HTML::linkRoute('tag', 'Tag', $tempIds[$transaction->id]) !!}
                            </td>
                        </tr>
                    @endforeach
                    @if ($transactions->getCollection()->count() == 0)
                         You don't have any transactions! 
                    @endif
                    </table>
                    <div class='app-spacer'></div>
                    </div>
                    <div>{{ $transactions->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
