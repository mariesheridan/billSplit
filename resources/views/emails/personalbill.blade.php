@inject('orders', 'App\MyLibrary\PersonalOrders')

<?php 
    $statusClass = "";
    if ($person->user_id == Auth::user()->id)
    {
        if ($person->status == 'Unpaid')
        {
            $statusClass = "my-order-unpaid";
        }
        elseif ($person->status == "Verifying")
        {
            $statusClass = "my-order-verifying";
        }
        elseif ($person->status == 'Paid')
        {
            $statusClass = "my-order-paid";
        }
    }
?>
<div class='person-summary {{ $statusClass }}'>
    <div class="order-header">
        <div class="person-header"><h4>{{ $person->name }}</h4></div>
        @if ( $person->user_id == Auth::user()->id )
        <div class="person-status">
            <div class="status-value">{{ $person->status }}</div>
            @if ($person->status == "Unpaid")
            <div class="status-action">
                <form action="/setVerifying" method="POST">
                    <input type="hidden" name="person_id" value={{ $person->id }}>
                    <input type="hidden" name="_token" value={{ csrf_token() }}>
                    <input type="submit" value="Pay" class="text_submit">
                </form>
            </div>
            @endif
        </div>
        @endif
    </div>
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
