<div class="balance">
    <div class="title">{{__('Withdrawals balance')}}</div>
    <div>
        <div class="text-dark">

            <span class="balance"><span class="currency">₮</span><span class="w-balance">--:--</span></span>
            <small class="text-success mx-1 chart"> (0.00%)</small>
            <small class="text-dark mx-1 f-14">  <i class="bx bx-info-circle" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="" data-bs-original-title="<span>{{__('Withdrawals Balance can be Withdrawed')}}</span>"></i></small>
        </div>
        <!-- <h5 class="text-success mx-1"> (0.00%)</h5> -->
        @if($buttons != 'none')
        <div class="demo-inline-spacing">
            <a type="button" class="btn rounded-pill btn-dark btn-sm text-white" href="{{route('dashboard.withdraw')}}">{{__('Withdraw')}}</a>
        </div>
        @endif
    </div>
</div>