<div class="card text-center mb-3">
    <div class="card-body px-3">
        <!-- <h5 class="card-title">Wallet Address</h5> -->
        <div class="my-2 p-2">
            <img src="/assets/wallet.png" alt="" width="250">
        </div>
        <!-- <div class="input-group input-group-lg my-4">
                    <input id="Address" type="text" class="form-control rounded-pill cursor-pointer text-centers f-14" disabled value="{{$user['address']}}" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <span class="input-group-text cursor-pointer rounded-pill bg-dark text-white" style="position: absolute; right: 0px; top: 0px; padding-left: 11px; font-size: 12px; padding-top: 15px; padding-bottom: 13px;" id="copy" onclick="copyFromClipoard()"><i class="bx bx-copy mx-1"></i> copy</span>
                  </div> -->
        <div class="input-group input-group-merge" onclick="copyFromClipoard() ">
            <input id="Address" class="form-control form-control-lg fw-semibold text-dark" readonly style="font-size: 13.5px;" type="text" value="{{$user['address']}}" placeholder="Address">
            <span class="input-group-text cursor-pointer text-primary fw-bold" id="copy"> <i class="bx bx-copy mx-1"></i> copy</span>
        </div>
        <hr>
        <p class="card-text">Please do not recharge other non-TRC20 (USDT) assets. The funds will arrive in your account in about 1 to 3 minutes after recharging..</p>
        @if($isButton)
        <button class="btn btn-danger btn-lg w-100" type="button" id="completeBtn" onclick="verifyDeposit()">Confirm Deposit</button>
        @endif
    </div>
</div>

<script>
    function copyFromClipoard() {

        navigator.clipboard
            .writeText(document.querySelector("#Address").value)
            .then((newClip) => {
                $('#copy').html(`<i class="bx bx-check mx-1"></i> copied`);
                setTimeout(function() {
                    $('#copy').html(`<i class="bx bx-copy mx-1"></i> copy`);
                }, 1000)
            });
    }
</script>