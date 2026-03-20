<div class="modal fade upload-modal" id="view_image" style="display: none">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><img
                        src="{{ asset('assets/dashboard/img/verify-image.png') }}" class="custompopicon"> Verification Image - <span id="member-id"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="view_img_gallery">
                    <div class="other_wrapper">
                        
                        <ul class="nav nav-tabs view_img_tab" id="myTab" role="tablist">
                    
                            <li class="nav-item">
                                <a class="nav-link active" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false">
                                    Gallery Images
                                </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="banners-tab" data-toggle="tab" href="#banners" role="tab" aria-controls="banners" aria-selected="true">
                                        Banner
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pinups-tab" data-toggle="tab" href="#pinups" role="tab" aria-controls="pinups" aria-selected="true">
                                        Pinup
                                    </a>
                                </li>
                        </ul>
                        <div class="tab-content mt-3">
                            <!-- Tab panes -->
                            <div class="tab-pane fade show active" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                                    <div class="other_images" id="media-images"></div>
                            </div>

                            <div class="tab-pane fade" id="banners" role="tabpanel" aria-labelledby="banners-tab">
                                    <div class="banner_img">
                                        <img src="{{ asset('assets/dashboard/img/view_img/b1.jpg') }}"  alt="view image gallery">
                                    </div>
                            </div>

                            <div class="tab-pane fade" id="pinups" role="tabpanel" aria-labelledby="pinups-tab">
                                 <div class="pinup_img">
                                     <img src="{{ asset('assets/dashboard/img/view_img/b2.jpg') }}" alt="view image gallery">
                                 </div>
                            </div>
                        </div>            
                
                        
                    </div>
                    <div class="verification">
                        <p class="banner-sub-heading mt-2" style=" border-bottom: 1px solid #dddfeb; padding-bottom: 9px;">Verification Image</p>
                        <img src="{{ asset('assets/dashboard/img/view_img/b2.jpg') }}" id="verification-image" alt="view image gallery">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-success-modal printImages">Print</button>
                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                <button type="button" class="btn-success-modal approve-btn"  data-toggle="modal">Approve</button>
                <button type="button" class="btn-success-modal reject-btn" data-toggle="modal">Reject</button>
            </div>

        </div>
    </div>
</div>
