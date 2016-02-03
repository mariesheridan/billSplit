@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">What items were bought?</div>

                <div class="panel-body">
                    @foreach($persons as $key=>$person)
                        @if(preg_match('/^person[\d]+/', $key))
                            {{$person}}<br>
                        @endif
                    @endforeach
                    <div class="app-spacer"></div>
                    <form "action="create_items" method="POST">
                        <div id="app-items">
                            <div class="app-label">1.</div>
                            <div class="app-value"><input type="text" name="item1" required></div>
                        </div>
                        <div class="app-spacer"></div>
                        <input type="button" id="addRow" value="Add" />
                        <div class="app-spacer"></div>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <div class="app-button"><input type="submit" value="Next >>"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section ('localScript')
<script>
    var counter = 1;
    $(document).ready(function () {

        $("#addRow").click(function () {
            counter++;
            var appendValue = "<div class='app-spacer'></div>";
            appendValue = appendValue + "<div class='app-label'>" + counter + ".</div>";
            appendValue = appendValue + "<div class='app-value'><input type='text' name='item" + counter + "' required></div>";
            $("#app-items").append(appendValue);
        });
    });
</script>
@endsection