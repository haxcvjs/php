<script>
    function Unlock(id) {

        var element = '.load-btn' + id;
        var balance = WCconfig.balance.deposit;
        var Plan = WCconfig.plans[id];
        var User = WCconfig.user;
        var PlanAmount = Plan.price;

        if (User.plan >= id) {
            $('#deposit-message').html(`Please Select Bigger`);
            $('#deposit-link').attr('href', `{{route('dashboard.deposit')}}?order=${id}`).hide();
            $('#modalToggle').modal('show');
            return;
        }

        $('#deposit-link').show();

        if (balance < PlanAmount) {
            $('#deposit-message').html(`The recharge balance is automatically unlocked Need to Deposit <b class="text-dark">${Math.round(PlanAmount-balance,2)}</b> {{currency('USDT')}}`);
            $('#deposit-link').attr('href', `{{route('dashboard.deposit')}}?order=${id}#h5`).html('Confirm').show();
            $('#modalToggle').modal('show');
            return;
        }

        var html = $(element).html();
        $(element).html(`<div class="spinner-border spinner-border-sm text-secondary" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>`).attr('disabled', '1');



        $.post("{{route('dashboard.subscribe')}}", {
            id: id,
            csrf_token: '{{generate_csrf()}}',
        }, function(response) {
            $('#deposit-link').attr('href', `{{route('dashboard.vip')}}`);
            try {
                response = JSON.parse(response)
                $('#deposit-message').html(response.message);


                if (response.error) {

                    $(element).html(html);
                    $(element).removeAttr('disabled')
                    $('#deposit-link').hide();
                    $('#modal-message').addClass('text-danger');
                } else {
                    $(element).attr('disabled', '1').removeClass('btn-dark').addClass('alert-success text-dark')
                    $(element).html('<i class="bx bx-check"></i> Success');
                    $('#modal-message').addClass('text-dark');
                    $('#deposit-link').hide();
                    setTimeout(() => {
                        location.reload();
                    }, 3300);
                }


            } catch (error) {
                $('#deposit-link').attr('href', `{{route('dashboard.vip')}}`).hide();
            }

            $('#modalToggle').modal('show');
        })

    }
</script>