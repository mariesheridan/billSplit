@inject('orders', 'App\MyLibrary\PersonalOrders')

<p>Hi {{ $person->transaction->user->name }},</p>
<div class="app-spacer" style="clear: both;height: 10px;"></div>
<p>Please verify if you have received {{ $person->name }}'s payment for the transaction at {{ $person->transaction->store }} on {{ date('F j, Y', strtotime($person->transaction->date)) }}.</p>
<div class="app-spacer" style="clear: both;height: 10px;"></div>
<p>Here are the details for {{ $person->name }}'s purchase:</p>
<div class="app-spacer" style="clear: both;height: 10px;"></div>
<div class="person-summary" style="width: 300px;border-style: solid;border-color: gray;border-width: 1px;padding: 10px;border-radius: 15px;">
    {!! $orders->setPersonId($person->transaction->id, $person->id) !!}
    @foreach ($orders->getOrders() as $order)
        <div class="summary-item-block" style="clear: both;box-sizing: border-box;">
            <div class="summary-item-name" style="float: left;width: 120px;vertical-align: middle;">{{ $order->item->name }}</div>
            <div class="summary-qty" style="float: left;width: 30px;text-align: right;margin-right: 10px;">{{ $order->quantity }}</div>
            <div class="summary-unit-price" style="float: left;width: 60px;">{{ '@' . $order->price }}</div>
            <div class="summary-item-price" style="float: right;width: 80px;text-align: right;vertical-align: middle;height: 100%;">{{ number_format(($order->quantity * $order->price), 2) }}</div>
            <div class="clear-both" style="clear: both;"></div>
        </div>
    @endforeach
    @if ($orders->getSvcCharge() != 0)
        <div class="summary-item-block" style="clear: both;box-sizing: border-box;">
            <div class="summary-item-name" style="float: left;width: 120px;vertical-align: middle;">Service Charge</div>
            <div class="summary-placeholder" style="float: left;width: 100px;">&nbsp;</div>
            <div class="summary-item-price" style="float: right;width: 80px;text-align: right;vertical-align: middle;height: 100%;">{{ number_format($orders->getSvcCharge(), 2) }}</div>
        </div>
    @endif
    <div class="app-line-space" style="clear: both;height: 5px;"></div>
    <div class="app-line" style="clear: both;width: 100%;height: 1px;background-color: gray;"></div>
    <div class="app-line-space" style="clear: both;height: 5px;"></div>
    <div class="summary-item-block" style="clear: both;box-sizing: border-box;"><strong>
        <div class="summary-item-name" style="float: left;width: 120px;vertical-align: middle;">Total</div>
        <div class="summary-placeholder" style="float: left;width: 100px;">&nbsp;</div>
        <div class="summary-item-price" style="float: right;width: 80px;text-align: right;vertical-align: middle;height: 100%;">{{ number_format($orders->getTotal(), 2) }}</div>
    </strong></div>
    <div class="clear-both" style="clear: both;"></div>
</div>
<div class="app-spacer" style="clear: both;height: 10px;"></div>

<p>Once verified, please set the status as Paid in you Receivables section in the Bill Split app. Thank you!</p>
<div class="app-spacer" style="clear: both;height: 10px;"></div>
<p>Go to: <a href="{{ $link = url('login') }}"> {{ $link }} </a></p>
