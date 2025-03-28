<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
   
    <form id="socials_link" action="{{ route('center.settings.social')}}" method="POST" enctype="multipart/form-data">
        <div class="about_me_heading_in_first_tab fill_profile_headings_global">
            <h2>Social Links</h2>
        </div>
        <div class="padding_20_all_side">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group row align-items-center">
                        <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-facebook-f"></i></span></label>
                        <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Facebook" name="social_links[facebook]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ $massage_profile->social_links ? $massage_profile->social_links['facebook'] : null }}">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-instagram"></i></span></label>
                        <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Instagram" name="social_links[insta]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ $massage_profile->social_links ? $massage_profile->social_links['insta'] : null }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group row align-items-center">
                        <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-twitter"></i></span></label>
                        <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Twitter" name="social_links[twitter]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ $massage_profile->social_links ? $massage_profile->social_links['twitter'] : null }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn" id="escort-form-submit-btn">Save Social</button></div>
            </div>
        </div>
    </form>
</div>