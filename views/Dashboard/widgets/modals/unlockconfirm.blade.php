<!-- Modal 1-->
<div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="modalToggleLabel">Modal 1</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center f-14" id="deposit-message"></div>
            <div class="modal-footer">
                <a class="btn btn-danger text-white" href="{{route('dashboard.deposit')}}" id="deposit-link"  >
                    Confirm
                </a>
            </div>
        </div>
    </div>
</div>