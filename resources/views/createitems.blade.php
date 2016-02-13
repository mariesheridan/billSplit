@extends('layouts.app')

@section('localStyle')
<link href="{{ asset('css/items_style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">What items were bought?</div>

                <div class="panel-body" id="item-body">
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
                        <div id="svc-charge-price">
                            Service Charge: <input type="number" step="0.01" name="svc-charge" value='{{ $svcCharge }}' required="">
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
<script src="{{ asset('js/inputs.js') }}"></script>
<script src="{{ asset('js/items.js') }}"></script>
<script>
    setClass('item');
    var items = <?php echo $items; ?>;
</script>
@endsection