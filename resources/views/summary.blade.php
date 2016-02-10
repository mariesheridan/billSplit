@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Summary</div>

                <div class="panel-body">
                    {{ $store }}
                    <br>
                    {{ $date }}
                    <div class="app-spacer"></div>
                    <form id="app-form" action="save_new_transaction" method="POST">
                        <div id="app-summary">
                        </div>
                        <div class="app-spacer"></div>
                        <div class="app-spacer"></div>
                        <div class="app-spacer"></div>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <div class="app-button"><input type="submit" name="back" value="<< Back"></div>
                        <div class="app-button"><input type="submit" name="next" value="Save"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section ('localScript')
<script src="{{ asset('js/summary.js') }}"></script>
<script>
    var persons = <?php echo $persons; ?>;
    console.log("js persons = " + persons);
    var itemNames = <?php echo $itemNames; ?>;
    console.log("js itemNames = " + itemNames);
    var items = <?php echo $items; ?>;
    console.log("js items = " + items);
    var svcCharge = {{ $svcCharge }};
</script>
@endsection