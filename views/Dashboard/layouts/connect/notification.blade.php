<?php

$notifications =  app(\App\Models\Notifications::class)->last_records(0);
$last_record_id =  app(\App\Models\Notifications::class)->last_record_id();

?>
<!-- Enable Scrolling & Backdrop Offcanvas -->
<div>

    <div class="offcanvas offcanvas-end" data-bs-scroll="false" tabindex="-1" id="offcanvasBoth" aria-labelledby="offcanvasBothLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasBothLabel" class="offcanvas-title"><i class="bx bx-bell"></i> Notifications</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body my-autos mx-0 flex-grow-0 px-0">
            <div data-last-id="{{$last_record_id}}" class="notification-bar">
                @foreach($notifications as $noti)
                <div class="noti-bar">
                    <a href="javascript:void(0);" onclick="$.post('{{route('connect.read')}}/{{$noti['id']}}')" class="list-group-item list-group-item-action flex-column align-items-start border-0 {{ $noti['read'] ? '' : 'alert-secondary text-dark fw-normal' }}">
                        <div class="d-flex justify-content-between w-100">
                            <h6>
                                @if(!$noti['read'])
                                <i class="bx bxs-circle text-danger f-14"></i>
                                @endif
                                {!!$noti['title']!!}
                            </h6>
                            <small class="text-muted">{{$noti['created_at']}}</small>
                        </div>
                        <p class="mb-1">
                            {!!$noti['body']!!}
                        </p>
                        <small class="text-muted"></small>
                    </a>
                    <hr class="m-0">
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

<script>

    function copyClipoard(text) {
        navigator.clipboard.writeText(text).then( () => {})
    }
    document.addEventListener('DOMContentLoaded', function() {

        var last_noti_id = $('.notification-bar').attr('data-last-id');
        setInterval(function() {
            $.post("{{route('connect.sync')}}", {
                id: last_noti_id
            }, function(response) {
                try {
                    response = JSON.parse(response);

                    var w_balance = $('.w-balance').html();
                    var acc_balance = $('.acc-balance').html();
                    var total_balance = $('.total-balance').html();
                    var funding = $('.fun-balance').html();

                    if(w_balance != response.balance.formated.withdrawBalance){
                        $('.w-balance').html(response.balance.formated.withdrawBalance)
                    }

                    if(acc_balance != response.balance.formated.deposit) 
                    {
                        $('.acc-balance').html(response.balance.formated.deposit)
                    }

                    if(total_balance != response.balance.formated.total) 
                    {
                        $('.total-balance').html(response.balance.formated.total)
                    }
                    
                    if(funding != response.balance.formated.funding) 
                    {
                        $('.fun-balance').html(response.balance.formated.funding)
                    }


                    WCconfig.balance = response.balance.raw;
                    $('#not-count').html(response.count > 0 ? response.count : '');

                    if (response.last_id > last_noti_id) {
                        last_noti_id = response.last_id;

                        $('.notification-bar').attr('data-last-id', response.last_id);

                        response.data.reverse().map(data => {
                            var element = $('.noti-bar').first();
                            var className = data.read ? '' : 'alert-secondary text-dark fw-normal';
                            if (element.length) {


                                element.before(`
                                <div class="noti-bar" >
                                    <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start border-0 ${className}">
                                        <div class="d-flex justify-content-between w-100">
                                            <h6>
                                            <i class="bx bxs-circle text-danger f-14"></i>
                                            ${data.title}
                                            </h6>
                                            <small class="text-muted">${data.created_at}</small>
                                        </div>
                                        <p class="mb-1">
                                            ${data.body}
                                        </p>
                                        <small class="text-muted"></small>
                                    </a>
                                    <hr class="m-0">
                                </div>
                                `);
                            } else {
                                $('.notification-bar').append(`
                                <div class="noti-bar" >
                                    <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start border-0 ${className}">
                                        <div class="d-flex justify-content-between w-100">
                                            <h6>
                                            <i class="bx bxs-circle text-danger f-14"></i>
                                            ${data.title}
                                            </h6>
                                            <small class="text-muted">${data.created_at}</small>
                                        </div>
                                        <p class="mb-1">
                                            ${data.body}
                                        </p>
                                        <small class="text-muted"></small>
                                    </a>
                                    <hr class="m-0">
                                    </div>
                                `);
                            }
                        });
                    }

                } catch (error) {

                }
            })
        }, 1000);
    });
</script>