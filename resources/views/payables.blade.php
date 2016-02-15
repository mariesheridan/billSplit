@foreach ($dbTransaction->persons as $person)
    @if ($person->user_id == Auth::user()->id)
        @if ($person->status == "Unpaid")
    <div class='person-summary my-order-unpaid'>
        @elseif ($person->status == "Verifying")
    <div class='person-summary my-order-verifying'>
        @elseif ($person->status == "Paid")
    <div class='person-summary my-order-paid'>
        @else
    <div class='person-summary'>   
        @endif
    @else
    <div class='person-summary'>
    @endif
        <div class="order-header">
            <div class="person-header"><h4>{{ $person->name }}</h4></div>
            @if ( $person->user_id == Auth::user()->id )
            <div class="person-status">
                <div class="status-value">{{ $person->status }}</div>
                @if ($person->status == "Unpaid")
                <div class="status-action">
                    <form action="/setVerifying" method="POST">
                        <input type="hidden" name="person_id" value={{ $person->id }}>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <input type="submit" value="Pay" class="text_submit">
                    </form>
                </div>
                @endif
            </div>
            @endif
        </div>
        @include('summaryofitems')
    </div>
    <div class='app-spacer'></div>
@endforeach