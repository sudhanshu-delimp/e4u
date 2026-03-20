<div class="modal fade upload-modal programmatic" id="setAsDefaultVideoForMainAccount" style="display: none">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <img
                        src="{{ asset('assets/dashboard/img/banner.png') }}" class="custompopicon">Replace Media
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="custom_modal_text">Would you like to update Media in your My Information page for future Profiles?</h5>
               
            </div>
             <div class="modal-footer justify-content-center pt-0">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close"
                        id="close_change">No</button>
                    <button type="button" class="btn-success-modal" onclick="saveDefaultVideo()">Yes</button>
                </div>
        </div>
    </div>
</div>