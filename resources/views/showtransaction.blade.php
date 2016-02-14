@extends('layouts.app')

@inject('items', 'App\MyLibrary\ItemsForTransaction')
@inject('orders', 'App\MyLibrary\PersonalOrders')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Summary</div>

                <div class="panel-body">
                    <h4>
                        {{ $dbTransaction->store }}
                    </h4>
                    <h4>
                        {{ $dbTransaction->date }}
                    </h4>
                    <div class="app-spacer"></div>
                    <div id="app-summary">
                        <div id='summary-block'>
                            <h4>Overview</h4>
                            <div class='app-line-space'></div>
                            <div class='app-line'></div>
                            <div class='app-line-space'></div>
                            {!! $items->setId($dbTransaction->id) !!}
                            @foreach ($items->getItems() as $item)
                                <div class='summary-item-block'>
                                    <div class='summary-item-name'>{{ $item->name }}</div>
                                    <div class='summary-item-price'>{{ number_format($item->price, 2) }}</div>
                                    <div class='clear-both'></div>
                                </div>
                            @endforeach
                            @if ($items->getSvcCharge() != 0)
                                <div class='summary-item-block'>
                                    <div class='summary-item-name'>Service Charge</div>
                                    <div class='summary-item-price'>{{ number_format($items->getSvcCharge(), 2) }}</div>
                                </div>
                            @endif
                            <div class='app-line-space'></div>
                            <div class='app-line'></div>
                            <div class='app-line-space'></div>
                            <div class='summary-item-block'><strong>
                                <div class='summary-item-name'>Total</div>
                                <div class='summary-item-price'>{{ number_format($items->getTotal(), 2) }}</div>
                            </strong></div>
                        </div>
                    </div>
                    <div class="app-spacer"></div>
                    @foreach ($dbTransaction->persons as $person)
                        @if ($person->user_id == Auth::user()->id)
                            <div class='person-summary my-order'>
                        @else
                            <div class='person-summary'>
                        @endif
                            <h4>{{ $person->name }}</h4>
                            <div class='app-line-space'></div>
                            <div class='app-line'></div>
                            <div class='app-line-space'></div>
                            {!! $orders->setPersonId($dbTransaction->id, $person->id) !!}
                            @foreach ($orders->getOrders() as $order)
                                <div class='summary-item-block'>
                                    <div class='summary-item-name'>{{ $order->item->name }}</div>
                                    <div class='summary-qty'>{{ $order->quantity }}</div>
                                    <div class='summary-unit-price'>{{ '@' . $order->price }}</div>
                                    <div class='summary-item-price'>{{ number_format(($order->quantity * $order->price), 2) }}</div>
                                    <div class='clear-both'></div>
                                </div>
                            @endforeach
                            @if ($orders->getSvcCharge() != 0)
                                <div class='summary-item-block'>
                                    <div class='summary-item-name'>Service Charge</div>
                                    <div class='summary-placeholder'>&nbsp</div>
                                    <div class='summary-item-price'>{{ number_format($orders->getSvcCharge(), 2) }}</div>
                                </div>
                            @endif
                            <div class='app-line-space'></div>
                            <div class='app-line'></div>
                            <div class='app-line-space'></div>
                            <div class='summary-item-block'><strong>
                                <div class='summary-item-name'>Total</div>
                                <div class='summary-placeholder'>&nbsp</div>
                                <div class='summary-item-price'>{{ number_format($orders->getTotal(), 2) }}</div>
                            </strong></div>
                            <div class='app-spacer'></div>
                        </div>
                        <div class='app-spacer'></div>
                    @endforeach
                    <div class="app-spacer"></div>
                    <div class="app-spacer"></div>
                    <!--<input type="hidden" name="_token" value={{ csrf_token() }}>
                    <div class="app-button"><input type="submit" name="back" value="<< Back"></div>-->
                    <!--<div class="myButton"><< Back</div>-->
                    <div>{!! HTML::linkRoute('home', '<< Back', array(), array('class' => 'myButton')) !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
