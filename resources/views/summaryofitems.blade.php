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