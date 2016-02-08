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
                    <form id="app-form" action="update_items" method="POST">
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
    var itemNames = <?php echo $itemNames; ?>;
    var itemPrices = <?php echo $itemPrices; ?>;
    console.log("js itemNames = " + itemNames);
    console.log("js itemPrices = " + itemPrices);
</script>
@endsection