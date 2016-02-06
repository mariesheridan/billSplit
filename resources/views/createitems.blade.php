@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">What items were bought?</div>

                <div class="panel-body">
                    {{ $store }}
                    <br>
                    {{ $date }}
                    <div class="app-spacer"></div>
                    <form action="update_items" method="POST">
                        <div id="app-items">
                        </div>
                        <div class="app-spacer"></div>
                        <input type="button" id="addRow" value="Add" />
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
<script src="{{ asset('js/inputs.js') }}"></script>
<script src="{{ asset('js/items.js') }}"></script>
<script>
    setClass('item');
    var itemNames = <?php echo '["' . implode('", "', array_column($items, 'itemName')) . '"]'; ?>;
    var itemPrices = <?php echo '["' . implode('", "', array_column($items, 'itemPrice')) . '"]'; ?>;
    console.log("js itemNames = " + itemNames);
    console.log("js itemPrices = " + itemPrices);
//    var items = [];
//    for (index in itemNames)
//    {
//        items.push({itemName: itemNames[index], itemPrice: itemPrices[index]});
//        console.log("js " + itemNames[index] + " = " + itemPrices[index]);
//    }
//    console.log("js items = " + items);
//    setItems(items);
</script>
@endsection