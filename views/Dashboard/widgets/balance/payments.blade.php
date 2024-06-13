<div class="row">
    @if($filter != 'none')
    <div class="col-md-12">

        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                <a class="nav-link btn-white {{ !$data['type'] ? 'active' : '' }}" href="?type"><i class="bx bx-user me-1"></i> {{__('All')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-white {{ $data['type'] == 'deposit' ? 'active' : '' }}" href="?type=deposit"><i class="bx bx-trending-down me-1"></i> {{__('Deposit')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-white {{ $data['type'] == 'withdraw' ? 'active' : '' }}" href="?type=withdraw"><i class="bx bx-trending-up me-1"></i> {{__('Withdrawal')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-white {{ $data['type'] == 'earning' ? 'active' : '' }}" href="?type=earning"><i class="bx bx-dollar me-1"></i> {{__('Earning')}}</a>
            </li>
        </ul>
    </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{$title}}</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{__('Type')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Address')}}</th>
                            <th>{{__('Date')}}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($data['payments'] as $payment)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong style="text-transform: capitalize;">{{$payment['entry']}}</strong></td>
                            <td><b class="fs-5"><b>{!!currencySymbol('USDT')!!}</b>{{$payment['amount']}}</b></td>
                            <td> @if($payment['entry'] == 'deposit' || $payment['entry'] == 'withdraw') <a href="javascript:void();"><i class="bx bx-copy text-dark fs-3" onclick="copyClipoard('{{$payment['address']}}')"></i></a> @endif {!!$payment['address']!!}</td>
                            <td>{{$payment['created_at']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>