<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content" style="width: 900px;position: absolute;">
            <form id="mulitiImage" method="POST" action="{{route('escort.upload.gallery')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><img src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross"> Upload Photos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container p-0">
                                    <div class="row p-0">
                                        <div class="col-12 p-0">
                                            <div class="photo-sec-popup custom-upload-photo"  id="image_preview">
                                                <a href="#">
                                                    <div class="five_column_content_top img-title-sec justify-content-between wish_span rm" style="z-index: 1;">
                                                      
                                                    </div>
                                                    <label class="newbtn rm">
                                                        <img id="blah" class="item" src="{{ asset('assets/app/img/upload-thum-1.png')}}">
                                                        
                                                        <input name="img[]" id="upload_file" class="pis" onchange="preview_image(this);" type="file" multiple accept="image/*">
                                                    </label>
                                                    <div style="margin-top: -34px;">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-lg-6">
                                                    <div class="plate"><label class="newbtn">
                                                        <img id="blah9" class="img-fluid pl-2 pr-2 js_bannerDefaultImage" src="{{ asset('assets/app/img/upload-3.png')}}" style="height: 150px;object-fit: cover;width: 100%;">
                                                        <input name="img[9]" id="uploadImage9" class="pis" onchange="readImageURL(this);" type="file" accept="image/*" >
                                                        <input type="hidden" name="position[]" id="mediaId9">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="plate"><label class="newbtn">
                                                        <img id="blah10" class="img-fluid pl-2 pr-2 js_pinupDefaultImage" src="{{ asset('assets/app/img/add-pinup-banner-full.png')}}" style="height: 150px;object-fit: cover;width: 100%;">
                                                        <input name="img[10]" id="uploadImage10" class="pis" onchange="readImageURL(this);" type="file" accept="image/*" >
                                                        <input type="hidden" name="position[]" id="mediaId10">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4 pt-1" style="border: 1px dotted;">
                                        <div class="col-6 pt-4 pb-4">
                                            <h4>Verify these Photos</h4>

                                            <ul style="text-align: justify;">
                                              <li>Two (2) selfies with your User Name and Membership ID printed (can be handwritten) on a sheet of paper held up to the side of you and not obscuring any part of you</li>
                                              <li>A drivers licence which matches your User Name and Home State</li>
                                              <li>A passport which matches your User Name and Home State</li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <div class="plate" style="position: relative;top: 30%;"><label class="newbtn">
                                                <img class="img-fluid" id="blah8" src="{{ asset($path->findByposition(auth()->user()->id,8)['path']) }}" style="height: 138px;object-fit: cover;width: 370px;">
                                                <input name="img[8]" id="pic8" data-id="8" class="pis" onchange="readImageURL(this);" type="file">
                                                <input type="hidden" name="selected_files[]" value="8">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn-success-modal">Verify Media</button>
                        <button type="submit" class="btn-success-modal">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>