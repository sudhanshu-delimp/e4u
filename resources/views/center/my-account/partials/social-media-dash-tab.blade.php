<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">

    <form id="myProfileServiceForm" class="common-form" name="myProfileServiceForm" action="{{route('center.update-massage-profile')}}" method="POST" enctype="multipart/form-data">

            <div class="row inner-row">
                <div class="col-lg-12">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">

                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                    stroke-linejoin="round">
                                </g>

                                <g id="SVGRepo_iconCarrier">

                                    <path
                                        d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>

                                    <path
                                        d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>

                                </g>

                            </svg>
                        </div>
                        <div class="card-heading">
                            <h2>Our Social Media <span class="custom--help"><b>Help?</b></span></h2>
                        </div>
                    </div>

                    <div class="custom-note-section">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol class=" mb-0">
                                    <li>By completing these settings, the information set out under Our Social media will be
                                        included and appear in your Profile creator.</li>
                                    <li>You can over ride these settings when creating a Profile, provided you have enabled
                                        the the <a href="{{ route('centre.notifications-and-features') }}" class="custom_links_design">feature</a>.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="inner-field-row">

                   
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Facebook</label>
                            
                                <input type="text" class="form-control" placeholder="https://facebook.com/yourprofile" name="social_links[facebook]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ isset($social_links['facebook']) ? $social_links['facebook'] : '' }}">
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">instagram</label>
                            
                                <input type="text" class="form-control" placeholder="https://instagram.com/yourprofile" name="social_links[insta]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ isset($social_links['insta']) ? $social_links['insta'] : '' }}">
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">X</label>
                            
                                <input type="text" class="form-control" placeholder="https://x.com/yourprofile" name="social_links[twitter]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ isset($social_links['twitter']) ? $social_links['twitter'] : '' }}">
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">                
                <div class="col-md-12 text-right common-footer">
                    <input type="hidden" name="type" id="type" value="social_links">
                    <input type="hidden" name="massage_id" id="massage_id" value="{{$massage_profile->id}}">
                    <button id="read-more" type="submit" class="save_profile_btn common-save-btn">Update</button>
                </div> 
            </div>                     
    </form>
</div>