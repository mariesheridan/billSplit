@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Summary</div>

                <div class="panel-body">
                    <h4>
                        {{ $store }}
                    </h4>
                    <h4>
                        {{ $date }}
                    </h4>
                    <div class="app-spacer"></div>
                    <div id="app-summary">
                    </div>
                    <div class="app-spacer"></div>
                    <div class="app-spacer"></div>
                    <div class="app-spacer"></div>
                    <!--<input type="hidden" name="_token" value={{ csrf_token() }}>
                    <div class="app-button"><input type="submit" name="back" value="<< Back"></div>-->
                    <!--<div class="myButton"><< Back</div>-->
                    <div>{!! HTML::linkRoute('home', '<< Back', array(), array('class' => 'myButton')) !!}</div>
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