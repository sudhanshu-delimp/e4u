<div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
    <form id="update_about_me" action="{{ route('agent.about.me',[$escort->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12">
            <div class="member-id">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0" />
                </svg>
                <span>Member ID: {{$escort->user->member_id}}</span>
            </div>
        </div>
        <div class="about_me_drop_down_info ">
            <div class="row tab-input-">
                <div class="col-md-12 d-flex input-in-row">
                    <div class="d-flex align-item-center">Profile Name: <input type="text" placeholder="Profile Name" name="profile_name" value="{{ $escort->profile_name}}"></div>
                    <div class="d-flex">Profile start date: <input type="date" id="start_date" name="start_date" style="color: #2c3e5052 ;"></div>
                    <div class="d-flex">Profile end date: <input type="date" id="end_date" value="" name="end_date" style="color: #2c3e5052; display:none" ></div>
                    <div class="d-flex">
                        Membership type:
                        <select name="membership" id="membership">
                            <option value="" disable>Select</option>
                            <option value="1" {{($escort->membership == 1) ? 'selected' : ''}}>Platinum</option>
                            <option value="2" {{($escort->membership == 2) ? 'selected' : ''}}>Gold</option>
                            <option value="3" {{($escort->membership == 3) ? 'selected' : ''}}>Silver</option>
                            <option value="4" {{($escort->membership == 4) ? 'selected' : ''}}>Free</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="about_me_drop_down_info ">
            <div class="row">
                <div class="col-lg-2">
                    <img class="img-fluid" src="{{ $escort->default_image }}" alt="">
                </div>
                <div class="col-lg-8">
                    <div class="about-me-box-one-name">{{$escort->name}}</div>
                    <div class="about-me-box-one-number">{{ $escort->city ? $escort->city->name : null }} - {{$escort->phone}}</div>
                    <div class="about-me-box-one-map">
                        <svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F" />
                        </svg>
                        {{ $escort->address ? $escort->address.',' : null }} {{ $escort->state ? $escort->state->name : null }} {{ $escort->pincode }}
                    </div>
                    <div class="about-md-box-social">@if(!empty($escort->social_links)) @foreach($escort->social_links as $key=>$val)
                        <a href="{{ $val }}">
                        <img src="{{ asset('assets/dashboard/img/'.$key.'.svg')}}" />
                        </a>@endforeach @endif
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="pull-right">
                        <a href="{{ route('agent.create.escort.profile', $escort->id) }}">
                            <svg width="30" height="30" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.7 10.0707L16.7 11.0707L14.65 9.0207L15.65 8.0207C15.86 7.8107 16.21 7.8107 16.42 8.0207L17.7 9.3007C17.91 9.5107 17.91 9.8607 17.7 10.0707ZM8 15.6607L14.06 9.6007L16.11 11.6507L10.06 17.7207H8V15.6607ZM8 10.7207C3.58 10.7207 0 12.5107 0 14.7207V16.7207H6V14.8307L10 10.8307C9.34 10.7507 8.67 10.7207 8 10.7207ZM8 0.720703C6.93913 0.720703 5.92172 1.14213 5.17157 1.89228C4.42143 2.64242 4 3.65984 4 4.7207C4 5.78157 4.42143 6.79899 5.17157 7.54913C5.92172 8.29928 6.93913 8.7207 8 8.7207C9.06087 8.7207 10.0783 8.29928 10.8284 7.54913C11.5786 6.79899 12 5.78157 12 4.7207C12 3.65984 11.5786 2.64242 10.8284 1.89228C10.0783 1.14213 9.06087 0.720703 8 0.720703Z" fill="#0c223d">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="about_me_drop_down_info ">
            <div class="add_banner_or_image_bg">
                <div class="row">
                    <div class="col manage_upload_btn">
                        <div class="banner_reco_font preview">
                            <p>Recommended: 1920 x 469</p>
                            <label for="banner-image-upload" class="custom-file-upload">
                            <i class="fas fa-plus-circle"></i>
                            </label>
                            <input id="banner-image-upload" type="file" name="banner_image" accept="image/*">
                            <p>Add banner image</p>
                            <img id="banner-image-preview" src="{{ $escort->banner_image }}" class="attach-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add banner image -->
        <!-- upload video  -->
        <div class="about_me_drop_down_info ">
            <div class="add_banner_or_image_bg">
                <div class="row">
                    <div class="col manage_upload_btn">
                        <div class="banner_reco_font preview">
                            <label for="banner-video-upload" class="custom-file-upload">
                            <i class="fas fa-plus-circle"></i>
                            </label>
                            <input id="banner-video-upload" type="file" name="banner_video">
                            <p>Add Video</p>
                            <video id="banner-video-preview" class="vdo-absolute" height="100%" width="100%" controls>
                                <source src="{{ $escort->banner_video }}" type="video/mp4">
                                <source src="{{ $escort->banner_video }}" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- upload video  -->
        <div class="about_me_drop_down_info ">
            <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                <h2>About me</h2>
            </div>
            <div class="padding_20_all_side">
                <!--New Row from here-->
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">
                            <span style="color:red">*</span>Gender:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="gender" required>
                                    <option value='' selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.genders') as $key => $gender)
                                    <option value="{{ $key }}" {{ ($escort->gender == $key)? 'selected' : ''}}>{{$gender}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Orientation:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="orientation">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.orientation') as $key => $orientate)
                                    <option value='{{ $key}}' {{ ($escort->orientation == $key) ? 'selected' : ''}}>{{ $orientate}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Ethnicity:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="ethnicity">
                                    <option value="">-Select-</option>
                                    @foreach(config('escorts.profile.ethnicities') as $key => $ethnicity)
                                    <option value="{{ old('ethnicity', $key) }}">{{ $ethnicity }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">
                            <span style="color:red">*</span>Nationality:</label>
                            <div class="col-sm-7">
                                <select style="border: 1px solid #d5d7e5 !important;" class="form-control form-control-sm select_tag_remove_box_sadow" id="select2-dropdown" required data-parsley-required-message="Select nationality" name="nationality_id" data-parsley-errors-container="#nationality-errors">
                                    <option value="{{ old('nationality_id',$escort->nationality_id)}}">{{($escort->nation) ? $escort->nation->name : ''}}</option>
                                </select>
                                <span id="nationality-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">
                            <span style="color:red">*</span>Age:</label>
                            <div class="col-sm-7">
                                <input data-parsley-type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="" required="" name="age" value="21" data-parsley-min="18" data-parsley-max="70">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Body type:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="body_type">
                                    <option value="" selected="" disabled="">-Select-</option>
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.body-type') as $key => $body_type)
                                    <option value='{{ $key}}' {{ ($escort->body_type == $key) ? 'selected' : ''}}>{{ $body_type}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Statistics</label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Hair colour:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="hair_color">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.hair-colour') as $key => $colour)
                                    <option value='{{ $key}}' {{ ($escort->hair_color == $key) ? 'selected' : ''}}>{{ $colour}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Hair style:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="hair-style" name="hair_style">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.hair-style') as $key => $hair_style)
                                    <option value='{{ $key}}' {{ ($escort->hair_style == $key) ? 'selected' : ''}}>{{ $hair_style }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Height:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="height" id="">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.heights') as $key => $height)
                                    <option value="{{ $key }}" {{ ($escort->height == $key) ? 'selected' : ''}}>{{ $height}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1"> Eyes:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="eyes" id="">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.eye-colors') as $key => $color)
                                    <option value="{{ $key }}" {{ ($escort->eyes == $key) ? 'selected' : ''}}>{{ $color}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Skin tone:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="skin_tone">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.skin-tone') as $key => $colour)
                                    <option value='{{ $key}}' {{ ($escort->skin_tone == $key) ? 'selected' : ''}}>{{ $colour}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Weight:</label>
                            <div class="col-sm-7">
                                <input data-parsley-type="number" class="form-control form-control-sm  removebox_shdow" placeholder="Enter Your Weight" value="{{$escort->weight}}" name="weight" data-parsley-min="30" data-parsley-max="150" vlaue="{{ $escort->weight}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Shaved:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.shaved-type') as $key => $type)
                                    <option value='{{ $key}}' {{ ($escort->shaved == $key) ? 'selected' : ''}}>{{ $type}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Breast:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="breast">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.breast-size') as $key => $size)
                                    <option value='{{ $key}}' {{ ($escort->breast == $key) ? 'selected' : ''}}>{{ $size}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Dress size:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="dress_size">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.dress-size') as $key => $dress_size)
                                    <option value='{{ $key}}' {{ ($escort->dress_size == $key) ? 'selected' : ''}}>{{ $dress_size }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Contact me:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="contact">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.contact-me') as $key => $contact)
                                    <option value='{{ $key}}' {{ ($escort->contact == $key) ? 'selected' : ''}}>{{ $contact}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--New Row end here-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="border_covid covid_heading ">
                            <h2>COVID -19</h2>
                        </div>
                        <div class="pt-2 pb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="covidreport" id="inlineRadio1" value="">
                                <label class="form-check-label" for="inlineRadio1">Vaccinated, not up to date</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="covidreport" id="inlineRadio1" value="">
                                <label class="form-check-label" for="inlineRadio1">Vaccinated, up to date</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="covidreport" id="inlineRadio1" value="">
                                <label class="form-check-label" for="inlineRadio1">Not Vaccinated</label>
                            </div>
                        </div>
                        <div class="add_banner_or_image_bg pt-2 mb-4">
                            <div class="row">
                                <div class="col manage_upload_btn">
                                    <div class="banner_reco_font">
                                        <label for="file-upload" class="custom-file-upload">
                                        <i class="fas fa-plus-circle"></i>
                                        </label>
                                        <input id="file-upload" type="file">
                                        <p>Upload Vaccination Passport / Certificate</p>
                                    </div>
                                    <p class="site_red_color text-center">No file Selected</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" id="update-about-me" class="save_profile_btn">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="about_me_drop_down_info ">
        <div class="about_me_heading_in_first_tab fill_profile_headings_global">
            <h2>Read more</h2>
        </div>
        <div class="padding_20_all_side">
            <form id="read_more" action="{{ route('agent.read.more',[$escort->id])}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Piercing:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="piercing">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.piercing') as $key => $piercing)
                                    <option value='{{ $key}}' {{ ($escort->piercing == $key) ? 'selected' : ''}}>{{ $piercing }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Drugs:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="drugs">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.drugs') as $key => $drug)
                                    <option value='{{ $key}}' {{ ($escort->drugs == $key) ? 'selected' : ''}}>{{ $drug }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Language:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="language">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.languages') as $key => $language)
                                    <option value='{{ $key}}' @if(!empty($escort->language)) @if(in_array($key ,$escort->language)) selected @endif @endif data-name="{{ $language }}">{{ $language }}</option>@endforeach
                                </select>
                            </div>
                            @if(!empty($escort->language)) @foreach($escort->language as $language)
                            <div class='selecated_languages select_lang'>
                                <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.languages.$language") !!}</span>
                            </div>
                            @endforeach @endif
                            <div id="container_language">
                            </div>
                            <div id="show_language" style="display:none">
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Travel:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="travel">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.travels') as $key => $travel)
                                    <option value='{{ $key}}' {{ ($escort->travel == $key) ? 'selected' : ''}}>{{ $travel }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Tattoos:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="tattoos">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.tattooes') as $key => $tattoos)
                                    <option value='{{ $key}}' {{ ($escort->tattoos == $key) ? 'selected' : ''}}>{{ $tattoos }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Smoke:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="smoke">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.smokes') as $key => $smoke)
                                    <option value='{{ $key}}' {{ ($escort->smoke == $key) ? 'selected' : ''}}>{{ $smoke }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Available to:</label>
                            <div class="col-sm-7">
                                <div class="form-control form-control-sm dropdown dropdown-with-checkbox">
                                    <button class="btn toggle_custome_btn_style custome_button_style dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-Select-</button>
                                    <div class="dropdown-menu padding_three_px_all" aria-labelledby="dropdownMenuButton">
                                        @foreach(config('escorts.profile.available-to') as $key => $available_to)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input available_to" id="" name="available_to[]" value='{{ $key}}' @if(!empty($escort->available_to)) @if(in_array($key , $escort->available_to)) checked @endif @endif>
                                            <label class="form-check-label" for="exampleCheck1">{{ $available_to }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @isset($escort->available_to)
                            <div class="selecated_languages available">
                                <img src="{{ asset('assets/dashboard/img/male-user.png')}}" id="2" style="display:{{ (in_array(2 , $escort->available_to)) ? 'inline-block' : 'none' }}">
                                <img src="{{ asset('assets/dashboard/img/woman-avatar.png')}}" id="1" style="display:{{ (in_array(1 , $escort->available_to)) ? 'inline-block' : 'none' }}">
                                <img src="{{ asset('assets/dashboard/img/trans.png')}}" id="3" style="display:{{ (in_array(3 , $escort->available_to)) ? 'inline-block' : 'none' }}">
                                <img src="{{ asset('assets/dashboard/img/group.png')}}" id="6" style="display:{{ (in_array(6 , $escort->available_to)) ? 'inline-block' : 'none' }}">
                                <img src="{{ asset('assets/dashboard/img/couple.png')}}" id="4" style="display:{{ (in_array(4 , $escort->available_to)) ? 'inline-block' : 'none' }}">
                                <img src="{{ asset('assets/dashboard/img/disabilities.png')}}" id="5" style="display:{{ (in_array(5 , $escort->available_to)) ? 'inline-block' : 'none' }}">
                            </div>
                            @endisset
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">SWA License:</label>
                            <div class="col-sm-7">
                                <input type="text" value="{{ $escort->license}}" name="license" class="form-control form-control-sm select_tag_remove_box_sadow" id="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Play types:</label>
                            <div class="col-sm-7">
                                <div class="form-control form-control-sm dropdown dropdown-with-checkbox">
                                    <button class="btn custome_button_style dropdown-toggle toggle_custome_btn_style" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-Select-</button>
                                    <div class="dropdown-menu padding_three_px_all" aria-labelledby="dropdownMenuButton">
                                        @foreach(config('escorts.profile.play-types') as $key => $play_type)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="play_type[]" value='{{ $key}}' @if(!empty($escort->play_type)) @if(in_array($key , $escort->play_type)) checked @endif @endif>
                                            <label class="form-check-label" for="exampleCheck1">{{ $play_type }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Payment:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="payment_type">
                                    <option value="" selected disabled>-Select-</option>
                                    @foreach(config('escorts.profile.Payments') as $key => $Payment)
                                    <option value='{{ $key}}' {{ ($escort->payment_type == $key) ? 'selected' : ''}}>{{ $Payment }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="read-more" type="submit" class="save_profile_btn">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <div class="about_me_drop_down_info ">
            <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                <h2>Who am I ?</h2>
            </div>
            <div class="padding_20_all_side">
                <div class="whoiamtitle">Enter Your Title Here</div>
                <form id="update_abut_who_am_i" action="{{ route('agent.about',[$escort->id])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <textarea id="editor1" name="about">@if(!empty($escort->about)) {{ $escort->about}} @endif</textarea>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12 text-right">
                            <button id="update_who_am_i" type="submit" class="save_profile_btn">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="about_me_drop_down_info play-mets">
            <div class="padding_20_all_side">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mb-12">
                        @include('agent.dashboard.partials.playmates-edit')
                        <input type="hidden" name="h_escort_id" vlaue="{{ $escort->id }}">
                    </div>
                </div>
                <div id="playmate-template" class="row text-center">
                    {{-- @foreach($escort->playmates as $playmate)
                    <div class="col-md-6 col-sm-6 mb-4">
                        <div class="d-flex align-items-center gap_between_text_and_img">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="{{ $playmate->default_image }}" alt="User profile picture">
                            </div>
                            <div class="profile-username text-center">
                                <p class="suggase_profile_name">{{ $playmate->name }}</p>
                            </div>
                            <p>{{ $playmate->member_id }}</p>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <a class="dropdown-item" href="{{ route('profile.description', $playmate->id) }}" data-id="3">View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item remove-playmate" href="#" data-escort_id="{{ $escort->id }}" data-playmate_id="{{ $playmate->id }}" data-name="Floater Cruise" data-category="3">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach --}}
                </div>
            </div>
        </div>


    <div class="tab_btm_btns_preview_and_next">
            <div class="row pt-3 pb-2">
                <div class="col-md-12 text-right mb-2 a_text_white_hover">
                    <a href="{{ route('profile.description',$escort->id)}}" class="save_profile_btn" >Preview</a>
                    <a href="#services" class="nex_sterp_btn" id="profile-tab" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">Next Step
                    <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
</div>
