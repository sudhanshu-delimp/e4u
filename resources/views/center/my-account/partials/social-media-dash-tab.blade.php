<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
   
    <form id="socials_link" action="{{ route('center.settings.social')}}" method="POST" enctype="multipart/form-data">
       
        <div class="fill_profile_headings_global col-md-12 p-0  custom--social-head">
            <h2>Our Social Media</h2>
            <span class="custom--help"><b>Help?</b></span>
        </div>
        <div class="custom-note-section">
            <div class="card" style="">
                <div class="card-body">
                <h3 class="NotesHeader"><b>Notes:</b> </h3> 
                    <ol class=" mb-0">
                        <li>By completing these settings, the information set out under Our Social media will be
                            included and appear in your Profile creator.</li>
                                        <li>You can over ride these settings when creating a Profile, provided you have enabled
                                            the the  <a href="{{ route('centre.notifications-and-features') }}" class="custom_links_design">feature</a>.</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="padding_20_all_side pb-0">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group row align-items-center">
                        <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-facebook-f"></i></span></label>
                        <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Facebook" name="social_links[facebook]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ $massage_profile->social_links ? $massage_profile->social_links['facebook'] : null }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                                        <div class="form-group row align-items-center">
                        <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-instagram"></i></span></label>
                        <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Instagram" name="social_links[insta]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ $massage_profile->social_links ? $massage_profile->social_links['insta'] : null }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group row align-items-center">
                        <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><img src="{{ asset('assets/img/twitter-new.png') }}" alt="" class="cutom-social-icon"></span></label>
                        <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Twitter" name="social_links[twitter]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ $massage_profile->social_links ? $massage_profile->social_links['twitter'] : null }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn" id="escort-form-submit-btn">Save</button></div>
            </div>
        </div>
    </form>
</div>