<div class="modal fade" id="verify_masseur_images" style="display: none">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" style="color: white;"><img src="{{ asset('assets/dashboard/img/verify-image.png') }}"
                        class="custompopicon"> Verification Image - <span class="member_id">[Member ID]</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="view_img_gallery_masseur">
                    <div class="d-fle flex-column gap-10">
                        <p class="banner-sub-heading my-2">Gallery Images</p>
                        <div class="other_images">                   
                        
                            <div class="verify_icon_wrapper">
                                <img src="{{ asset('assets/dashboard/img/view_img/b2.jpg') }}" alt="view image gallery">
                                <span class="verify_icon">
                                    <img src="{{ asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png') }}" style="width:100%; height:20px;
                                        object-fit: contain;"><span class="mc_media_tooltip">Media Pending</span>
                                </span>
                                <div class="upload_date">
                                    Uploaded: <span>27-04-2026</span>
                                </div>
                            </div>

                            <div class="verify_icon_wrapper">
                                <img src="{{ asset('assets/dashboard/img/view_img/b3.jpg') }}" alt="view image gallery">
                                <span class="verify_icon">
                                    <img src="{{ asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png') }}" style="width:100%; height:20px;
                                            object-fit: contain;"><span class="mc_media_tooltip">Media Pending</span>
                                </span>
                                <div class="upload_date">
                                    Uploaded: <span>27-04-2026</span>
                                </div>
                            </div>

                            <div class="verify_icon_wrapper">
                                <img src="{{ asset('assets/dashboard/img/view_img/b4.jpg') }}" alt="view image gallery">
                                <span class="verify_icon">
                                    <img src="{{ asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png') }}" style="width:100%; height:20px;
                                    object-fit: contain;"><span class="mc_media_tooltip">Media Pending</span>
                                </span>
                                <div class="upload_date">
                                    Uploaded: <span>27-04-2026</span>
                                </div>
                            </div>
                        
                        
                            
                        </div>
                    </div>
                    
                    <div class="verification">                        
                        <span class="banner-sub-heading my-2">Verification Image</span>
                        <img src="{{ asset('assets/dashboard/img/view_img/b2.jpg') }}" alt="view image gallery">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <a type="button" href="" target="_blank" class="btn-success-modal printMasseursImgBtn">Print</a>
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" >Close</button>
                <button type="button" class="btn-success-modal approveMasseursBtn">Approve</button>
                <button type="button" class="btn-success-modal rejectMasseursBtn" data-dismiss="modal">Reject</button>
            </div>

        </div>
    </div>
</div>
