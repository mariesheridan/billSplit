<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .person-summary {
            width: 300px;
            border-style: solid;
            border-color: gray;
            border-width: 1px;
            padding: 10px;
            border-radius: 15px;
        }

        .app-line-space {
            clear: both;
            height: 5px;
        }

        .app-line {
            clear: both;
            width: 100%;
            height: 1px;
            background-color: gray;
        }

        .summary-item-block {
            clear: both;
            box-sizing: border-box;
        }

        .summary-item-name {
            float: left;
            width: 120px;
            vertical-align: middle;
        }

        .summary-qty {
            float: left;
            width: 30px;
            text-align: right;
            margin-right: 10px;
        }

        .summary-unit-price {
            float: left;
            width: 60px;
        }

        .summary-item-price {
            float: right;
            width: 50px;
            text-align: right;
            vertical-align: middle;
            height: 100%;
        }

        .clear-both {
            clear: both;
        }

        .summary-placeholder {
            float: left;
            width: 100px;
        }

        .app-spacer {
            clear: both;
            height: 10px;
        }
    </style>
</head>
<body>
    @inject('orders', 'App\MyLibrary\PersonalOrders')

    <p>Hi {{ $person->transaction->user->name }},</p>
    <div class='app-spacer'></div>
    <p>Please verify if you have received {{ $person->name }}'s payment for the transaction at {{ $person->transaction->store }} on {{ $person->transaction->date }}.</p>
    <div class='app-spacer'></div>
    <p>Here are the details for {{ $person->name }}'s purchase:</p>
    <div class='app-spacer'></div>
    <div class='person-summary'>
        {!! $orders->setPersonId($person->transaction->id, $person->id) !!}
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
        <div class='clear-both'></div>
    </div>
    <div class='app-spacer'></div>

    <p>Once verified, please set the status as Paid in you Receivables section in the Bill Split app. Thank you!</p>
    <div class='app-spacer'></div>
    <p>Go to: <a href="{{ $link = url('login') }}"> {{ $link }} </a></p>

</body>
</html>