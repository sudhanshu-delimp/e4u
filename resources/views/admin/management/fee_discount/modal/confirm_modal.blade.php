  {{-- Modal: View database Centre --}}
    <div class="modal fade upload-modal" id="confirm" tabindex="-1" aria-labelledby="confirmLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/unblock.png') }}" class="custompopicon"
                            alt="View Centre">
                      Confirm
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body">
                  <h5 class="custom_modal_text">
                    Are You Sure Cancel Current Discount?
                  </h5>
                </div>
                <div class="modal-footer justify-content-center pt-0">
                    <button class="btn-successs-modal">Yes</button>
                    <button class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                </div>
               
            </div>
        </div>
    </div>
    {{-- end --}}