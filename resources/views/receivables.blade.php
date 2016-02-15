@foreach ($dbTransaction->persons as $person)
    @if ($person->status == "Unpaid")
    <div class='person-summary my-order-unpaid'>
    @elseif ($person->status == "Verifying")
    <div class='person-summary my-order-verifying'>
    @elseif ($person->status == "Paid")
    <div class='person-summary my-order-paid'>
    @else
    <div class='person-summary'>   
        @endif
        <div class="order-header">
            <div class="person-header"><h4>{{ $person->name }}</h4></div>
            <div class="person-status">
                <div class="status-value">{{ $person->status }}</div>
                @if ($person->status == "Paid")
                <div class="status-action">
                    <form action="/setUnpaid" method="POST">
                        <input type="hidden" name="person_id" value={{ $person->id }}>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <input type="submit" value="SetUnpaid" class="text_submit">
                    </form>
                </div>
                @else
                <div class="status-action">
                    <form action="/setPaid" method="POST">
                        <input type="hidden" name="person_id" value={{ $person->id }}>
                        <input type="hidden" name="_token" value={{ csrf_token() }}>
                        <input type="submit" value="SetPaid" class="text_submit">
                    </form>
                </div>
                @endif
            </div>
        </div>
        @include('summaryofitems')
    </div>
    <div class='app-spacer'></div>
@endforeach