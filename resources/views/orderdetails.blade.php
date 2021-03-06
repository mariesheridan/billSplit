@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Who ordered the items?</div>

                <div class="panel-body" id="order-body">
                    {{ $store }}
                    <br>
                    {{ $date }}
                    <div class="app-spacer"></div>
                    <div class="app-total-block">
                        <div class="app-item-name">Subtotal:</div>
                        <div class="app-total-price">{{ $subtotal }}</div>
                    </div>
                    <div class="app-total-block">
                        <div class="app-item-name">Service Charge:</div>
                        <div class="app-total-price">{{ $svcCharge }}</div>
                    </div>
                    <div class="app-total-block">
                        <div class="app-item-name">Total:</div>
                        <div class="app-total-price">{{ $subtotal + $svcCharge }}</div>
                    </div>
                    <div class="app-spacer"></div>
                    <form id="app-form" action="update_orders" method="POST">
                        <div id="app-orders">
                        </div>
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
    var items = <?php echo $items; ?>;
</script>
@endsection

