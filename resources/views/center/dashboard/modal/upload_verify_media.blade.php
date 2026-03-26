<div class="modal fade upload-modal" id="veryfy_media" tabindex="-1" role="dialog" aria-labelledby="veryfy_mediaLongTitle"
    data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="mediaVerification" method="POST" action="{{ route('center.media.verification.upload') }}" enctype="multipart/form-data">
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
                                <label class="newbtn rm">

                                    <img id="blah" class="item px-2"
                                        src="{{ $imageUrl ?? asset('assets/app/img/upload-media.png') }}"
                                        style="width: 400px;object-fit: contain; height:250px">

                                        <input name="image" id="upload_varification_img" class="pis galleryMedia" onchange="readVarificationImageURL(this);" type="file" accept="image/*" >

                                </label>
                            </div>
                        </div>

                        <hr>
                        <div class="row pt-1">
                            <div class="col-sm-12">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol style="text-align: justify;">
                                    <li>Upload a photo of the Business premises which displays the name of the Business
                                        and the Business number.</li>
                                    <li>Please ensure your photo clearly identifies your Business.</li>
                                </ol>
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
