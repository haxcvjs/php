<div class="balance">
    <div class="title">{{__('Funding balance')}}</div>
    <div>
        <div class="text-dark">

            <span class="balance"><span class="currency">₮</span><span class="fun-balance">--:--</span></span>
            <small class="text-success mx-1 chart"> (0.00%)</small>
            <small class="text-dark mx-1 f-14"> <i class="bx bx-info-circle" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="" data-bs-original-title="<span>{{__('Available Balance can be used inside platform Bets,lottery,spinner etc...')}}</span>"></i></small>
        </div>
        <!-- <h5 class="text-success mx-1"> (0.00%)</h5> -->
        <div class="demo-inline-spacing">
            <a type="button" class="btn rounded-pill btn-dark btn-sm" href="{{route('dashboard.deposit')}}">{{__('Deposit')}}</a>
        </div>
    </div>
</div>