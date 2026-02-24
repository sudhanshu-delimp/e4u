<div class="modal fade upload-modal" id="mediaVerificationModal" tabindex="-1" role="dialog" aria-labelledby="mediaVerificationModal" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content" style="width: 900px;position: absolute;">
            <form id="mulitiImage" method="POST" action="{{route('escort.upload.gallery')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><img src="/assets/dashboard/img/verify-image.png" class="custompopicon" alt="cross"> Media Verification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container p-0">
                                    <div class="row p-0">
                                        <div class="col-sm-12 p-0 text-center">
                                            <div class="{{request()->segment(2) == 'archive-view-photos'?'col-lg-12':'col-lg-6'}} text-center">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah9" class="img-fluid px-2 js_bannerDefaultImage js_galleryMedia" src="{{ asset('assets/app/img/upload-media.png')}}" style="width: 400px;object-fit: cover; height:100%">
                                                    <input name="banner" id="upload_banner" class="pis galleryMedia" onchange="readImageURL(this);" type="file" accept="image/*" >
                                                    <input type="hidden" name="position[]" id="mediaBanner">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="verification-type mt-3 d-flex justify-content-center gap-20">

                                                <div class="verification-type-title mb-2">
                                                    <input type="radio" id="selfie" name="verification_type" value="selfie" checked>
                                                    <label for="selfie">Selfie</label>
                                                </div>

                                                <div class="verification-type-title mb-2">
                                                    <input type="radio" id="licence" name="verification_type" value="licence">
                                                    <label for="licence">Licence</label>
                                                </div>

                                                <div class="verification-type-title mb-2">
                                                    <input type="radio" id="passport" name="verification_type" value="passport">
                                                    <label for="passport">Passport</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row pt-1">
                                        <div class="col-sm-12">
                                            <h3 class="NotesHeader"><b>Notes:</b> </h3>

                                            <ol style="text-align: justify;">
                                              <li>Upload a selfie with your Username, Membership ID and Mobile number printed (can be hand written) on a sheet of paper held up to the side of you and not obscuring any part of you.</li>
                                              <li>A drivers licence or passport which matches your Username and Home State is acceptable.</li>
                                            </ol>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn-success-modal">Verify Media</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>