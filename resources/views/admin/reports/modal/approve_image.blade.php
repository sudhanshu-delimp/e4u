<div class="modal fade" id="approve_image" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" style="color: white;"><img src="{{ asset('assets/dashboard/img/verify-image.png') }}"
                        class="custompopicon"> Verification Image
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
           <div class="modal-body" >
                <div class="view_img_gallery">

                    <div class="gallery_item">
                        <img src="{{ asset('assets/dashboard/img/view_img/b1.jpg') }}"
                            alt="view image gallery">
                    </div>
                    <div class="gallery_item">
                        <img src="{{ asset('assets/dashboard/img/view_img/b2.jpg') }}"
                            alt="view image gallery">
                    </div>
                    <div class="gallery_item">
                        <img src="{{ asset('assets/dashboard/img/view_img/b3.jpg') }}"
                            alt="view image gallery">
                    </div>

                    <div class="gallery_item">
                        <img src="{{ asset('assets/dashboard/img/view_img/b4.jpg') }}"
                            alt="view image gallery">
                    </div>
                    <div class="gallery_item">
                        <img src="{{ asset('assets/dashboard/img/view_img/b5.jpg') }}"
                            alt="view image gallery">
                    </div>
                    <div class="gallery_item">
                        <img src="{{ asset('assets/dashboard/img/view_img/b6.jpg') }}"
                            alt="view image gallery">
                    </div>


                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-success-modal">Approved</button>
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" >Close</button>
            </div>

        </div>
    </div>
</div>
