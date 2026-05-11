<div class="modal fade upload-modal" id="veryfy_media" tabindex="-1" role="dialog" aria-labelledby="veryfy_mediaLongTitle"
    data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="mediaVerification" action="{{route('center.upload-masseur-verification')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="veryfy_mediaLongTitle"><img
                                src="/assets/dashboard/img/verify-image.png" class="custompopicon" alt="cross"> Media
                            Verification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <label class="newbtn rm ">
                                    @php
                                    $imageUrl = $imageUrl ?? '';
                                    $defaultPath = 'assets/app/img/upload-media.png';
                                    $cleanPath = parse_url($imageUrl, PHP_URL_PATH);
                                    $cleanPath = ltrim($cleanPath ?? '', '/');

                                    @endphp
                                    <div class="{{ ($imageUrl != '' && $cleanPath != $defaultPath) ? 'has_img ' : '' }}upload_varification_img_wrapper">
                                        <img id="blah" class="item px-2"
                                            src="{{ !empty($imageUrl) ? $imageUrl : asset('assets/app/img/upload-media.png') }}">
                                        <input name="verification_image" id="upload_varification_img" class="pis galleryMedia" onchange="readVarificationImageURL(this);" type="file" accept="image/*">
                                        <span class="img_alert" style="{{ ($imageUrl != '' && $cleanPath != $defaultPath) ? '' : 'display:none' }}">
                                            <i class="fas fa-upload"></i>
                                            <br><small>Upload Image</small>
                                        </span>
                                    </div>
                                </label>

                                <div class="verification-type mt-3 d-flex justify-content-center gap-20">

                                    <div class="verification-type-title mb-2">
                                        <input type="radio" id="selfie" name="verification_type"
                                            value="0" checked>
                                        <label for="selfie">Selfie</label>
                                    </div>

                                    <div class="verification-type-title mb-2">
                                        <input type="radio" id="licence" name="verification_type"
                                            value="1">
                                        <label for="licence">Licence</label>
                                    </div>

                                    <div class="verification-type-title mb-2">
                                        <input type="radio" id="passport" name="verification_type"
                                            value="2">
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
                                    <li>Upload a selfie with your Username, Membership ID and Mobile number
                                        printed (can be hand written) on a sheet of paper held up to the
                                        side of
                                        you and not obscuring any part of you.</li>
                                    <li>A drivers licence or passport which matches your Username and Home
                                        State
                                        is acceptable.</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-success-modal" id="verifyMediaBtn">Verify Media</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>