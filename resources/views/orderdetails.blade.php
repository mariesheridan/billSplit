@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">What's the price? Who ordered the items?</div>

                <div class="panel-body">
                    {{ $store }}
                    <br>
                    {{ $date }}
                    <div class="app-spacer"></div>
                    <form action="update_orders" method="POST">
                        <div id="app-orders">
                        </div>
                         <div class="app-spacer"></div>
                        <div id="svc-charge-price">Service Charge: {{ $svcCharge }}</div>
                        <div class="app-spacer"></div>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <div class="app-button"><input type="submit" name="back" value="<< Back"></div>
                        <div class="app-button"><input type="submit" name="next" value="Next >>"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section ('localScript')
<script src="{{ asset('js/orders.js') }}"></script>
<script>
    var persons = <?php echo $persons; ?>;
    console.log("js persons = " + persons);
    var itemNames = <?php echo $itemNames; ?>;
    console.log("js itemNames = " + itemNames);
    var items = <?php echo $items; ?>;
    console.log("js items = " + items);
</script>
@endsection

