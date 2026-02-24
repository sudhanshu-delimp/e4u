<div class="modal fade" id="verify_masseur_images" style="display: none">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" style="color: white;"><img src="{{ asset('assets/dashboard/img/verify-image.png') }}"
                        class="custompopicon"> Verification Image - Masseur
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="view_img_gallery_masseur">
                     <div class="thumbnail">
                        
                        <span class="banner-sub-heading my-2">Thumbnail</span>
                        <img src="{{ asset('assets/dashboard/img/view_img/b1.jpg') }}" alt="view image gallery">
                    </div>
                    <div class="other_images">                     
                        <span class="banner-sub-heading mt-2">Gallery Images</span>
                        <img src="{{ asset('assets/dashboard/img/view_img/b2.jpg') }}" alt="view image gallery">
                        <img src="{{ asset('assets/dashboard/img/view_img/b3.jpg') }}" alt="view image gallery">
                        <img src="{{ asset('assets/dashboard/img/view_img/b4.jpg') }}" alt="view image gallery">
                    </div>
                    <div class="verification">                        
                        <span class="banner-sub-heading my-2">Verification Image</span>
                        <img src="{{ asset('assets/dashboard/img/view_img/b2.jpg') }}" alt="view image gallery">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-success-modal">Print</button>
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" >Close</button>
                <button type="button" class="btn-success-modal">Approved</button>
            </div>

        </div>
    </div>
</div>
