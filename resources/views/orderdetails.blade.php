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
    var persons = <?php echo '["' . implode('", "', $persons) . '"]'; ?>;
    console.log("js persons = " + persons);
    var items = <?php echo '["' . implode('", "', $items) . '"]'; ?>;
    console.log("js items = " + items);
    var priceNames = <?php echo '["' . implode('", "', array_column($prices, 'priceName')) . '"]'; ?>;
    var priceAmounts = <?php echo '["' . implode('", "', array_column($prices, 'priceAmount')) . '"]'; ?>;
    var prices = [];
    for (index in priceNames)
    {
        prices.push({priceName: priceNames[index], priceAmount: priceAmounts[index]}); 
    }
    console.log("js prices = " + prices);
    setPersons(persons);
    setItems(items);
    setPrices(prices);

</script>
@endsection

<!--
//    var prices = <!-?php echo '["' . implode('", "', $prices) . '"]'; ?>;
//    console.log("js prices = " + prices);
//    setPrices(prices);
-->