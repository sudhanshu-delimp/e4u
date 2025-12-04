<div class="modal programmatic" id="setAsDefaultVideoForMainAccount" style="display: none">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" id="exampleModalLabel" style="color:white"> <img
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
                Would you like to update Media in your My Information page for future Profiles?
                <div class="modal-footer">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close"
                        id="close_change">No</button>
                    <button type="button" class="btn-success-modal" onclick="saveDefaultVideo()">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>