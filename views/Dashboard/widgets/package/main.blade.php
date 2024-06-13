<style>
    .simple-vip .card {
        min-height: 230px;
    }

    .balance {
        font-size: 18px !important;
    }
</style>
<div class="row simple-vip">

     
   


    @foreach($plans as $plan)

    @if($plan['id'] < $user['plan'])
    <div class="col-lg-4 col-md-6">
        <div class="card mb-3">
            <div class="row g-0">

                <div class="col-md-12">
                    <div class="card-body" style="opacity:0.8">
                        <h5 class="card-title badge rounded-pill alert-warning text-dark px-4 mt-2"> {!!$plan['icon']!!}  {{$plan['name']}}</h5>
                        <h5 class="card-title badge rounded-pill alert-dark px-4 effective"><i class="bx bxs-lock"></i> Locked</h5>
                        <div>
                            <ul class="list-group">
                            <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <strong class="f-14">{{__('Simple Interest')}}</strong>
                                    <span class="balance"><span class="currency"></span> <span class="chart f-14">₮{{$plan['unit']}}</span></span>
                                </li>
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <strong class="f-14">{{__('Daily Comission')}}</strong>
                                    <span class="balance"><span class="currency"></span> <span class="chart f-14">₮{{$plan['comission']}}</span></span>
                                </li>
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <strong class="f-14">{{__('Total Profits')}}</strong>
                                    <span class="balance"><span class="currency"></span> <span class="chart f-14">₮{{$plan['profit']}}</span></span>
                                </li>

                            </ul>
                        </div>
                        <div class="mt-2">
                            <button class="btn rounded-pill alert-dark w-100" disabled> <i class="bx bx-lock-open"></i>Unlocked</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @elseif($plan['id'] == $user['plan'])
    <div class="col-lg-4 col-md-6">
        <div class="card mb-3">
            <div class="row g-0">

                <div class="col-md-12">
                    <div class="card-body">

                        <h5 class="card-title badge rounded-pill alert-warning text-dark px-4 mt-2"> {!!$plan['icon']!!} {{$plan['name']}}</h5>
                        <h5 class="card-title badge rounded-pill alert-primary px-4 effective"><i class="bx bxs-lock-open"></i> Effective</h5>
                        <div>
                            <ul class="list-group">
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <strong class="f-14">{{__('Simple Interest')}}</strong>
                                    <span class="balance"><span class="currency"></span> <span class="chart f-14">₮{{$plan['unit']}}</span></span>
                                </li>
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <strong class="f-14">{{__('Daily Comission')}}</strong>
                                    <span class="balance"><span class="currency"></span> <span class="chart f-14">₮{{$plan['comission']}}</span></span>
                                </li>
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <strong class="f-14">{{__('Total Profits')}}</strong>
                                    <span class="balance"><span class="currency"></span> <span class="chart f-14">₮{{$plan['profit']}}</span></span>
                                </li>

                            </ul>
                        </div>
                        <div class="mt-3">
                            <div class="badge alert-dark w-100 p-2"> <i class="bx bx-calendar"></i> <b>Period:</b> <span class="mx-2 text-green">{{$user['effective_time']}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-lg-4 col-md-6">
        <div class="card mb-3">
            <div class="locker"></div>
            <div class="row g-0">

                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title badge rounded-pill alert-warning text-dark px-4 mt-2"> {!!$plan['icon']!!}  {{$plan['name']}}</h5>
                        <div>
                            <ul class="list-group"> 
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <strong class="f-14">{{__('Simple Interest')}}</strong>
                                    <span class="balance"><span class="currency"></span> <span class="chart f-14">₮{{$plan['unit']}}</span></span>
                                </li>
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <strong class="f-14">{{__('Daily Comission')}}</strong>
                                    <span class="balance"><span class="currency"></span> <span class="chart f-14">₮{{$plan['comission']}}</span></span>
                                </li>
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                    <strong class="f-14">{{__('Total Profits')}}</strong>
                                    <span class="balance"><span class="currency"></span> <span class="chart f-14">₮{{$plan['profit']}}</span></span>
                                </li>

                            </ul>
                        </div>
                        <div class=" unlock mt-2">
                            <button class="btn rounded-pill btn-dark btn-lg w-100 load-btn{{$plan['id']}}"  onclick="Unlock(<?= $plan['id'] ?>)"> <i class="bx bx-locks"></i> {{ number_format($plan['price']) }} {{currency('USDT')}} <span class="mx-3">Unlock now</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach

</div>