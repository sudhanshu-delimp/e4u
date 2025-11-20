<style type="text/css">
    .stage .select2-search__field {
    margin-top: -2.2rem !important;
    position: absolute !important;
    margin-left: -0.3rem !important;
}
.parsley-errors-list li {
    list-style: none !important;
    margin-left: -2.3rem;
}
.parsley-min {
    color: #e5365a;
}
</style>

<div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
    <form id="update_about_me" action="{{ route('escort.settings.about.me')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- upload video  -->
        <div class="about_me_drop_down_info ">
        
        
            <div class="about_me_heading_in_first_tab fill_profile_headings_global custom--headingbod custom--social-head">
                <h2>About me</h2>
                <span class="custom--help"><b>Help?</b></span>
            </div>
            <div class="custom-note-section">
                            <div class="card" style="">
                            <div class="card-body">
                            <h3 class="NotesHeader"><b>Notes:</b> </h3> 
                            <ol class=" mb-0">
                                <li>By completing these settings, the information set out under My Available Times will by default appear in your Profile creator.</li>
                                <li>Leave the time blank if you are unavailable. Select ‘By Appointment’ as an alternative to a particular time period.</li>
                                <li>You can over ride these settings when creating a Profile, provided you have enabled the <a href="/escort-dashboard/update-account" class="custom_links_design">feature</a> (see My Account - Profile & Tour options).</li>
                            </ol>
                            </div>
                            </div>
                        </div>
            <div class="padding_20_all_side pb-0 custom-removemargin">
                <!--New Row from here-->
                <div class="row">
                    {{--
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-3 font-weight-500" for="exampleFormControlSelect1">
                            <span style="color:red">*</span>Gender:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="gender" required>
                                    <option value='' selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.genders') as $key => $gender)
                                    <option value="{{ $key }}" {{ ($escort->gender == $gender)? 'selected' : ''}}>{{$gender}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    --}}

                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">
                            Age:<span style="color:red">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" data-parsley-type="digits" class="form-control form-control-sm select_tag_remove_box_sadow" id="" required="" name="age" value="{{$escort->age}}" data-parsley-min="18" data-parsley-max="70">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Orientation:</label>
                            <div class="col-sm-7 national">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="orientation">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.orientation') as $key => $orientate)
                                    <option value='{{ $key}}' {{ ($escort->orientation == $key) ? 'selected' : ''}}>{{ $orientate}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Ethnicity:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="ethnicity">
                                    <option value="">-Not Set-</option>
                                    @foreach(config('escorts.profile.ethnicities') as $key => $ethnicity)
                                    <option value="{{ old('ethnicity', $key) }}" {{ ($escort->ethnicity == $key) ? 'selected' : ''}} >{{ $ethnicity }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Body type:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="body_type">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.body-type') as $key => $body_type)
                                    <option value='{{ $key}}' {{ ($escort->body_type == $key) ? 'selected' : ''}}>{{ $body_type}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">
                            Nationality:</label>
                            <div class="col-sm-7 national">
                                {{-- <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="payment_type">
                                    <option value="{{ old('nationality_id',$escort->nationality_id)}}">{{($escort->nation) ? $escort->nation->name : ''}}</option>
                                </select> --}}

                                <select style="border: 1px solid #d5d7e5 !important;" class="form-control form-control-sm select_tag_remove_box_sadow nationality-sec" id="select2-dropdown"  data-parsley-required-message="Select nationality" name="nationality_id" data-parsley-errors-container="#nationality-errors">
                                    <option value="{{ old('nationality_id',$escort->nationality_id)}}">{{($escort->nation) ? $escort->nation->name : ''}}</option>
                                </select>
                                <span id="nationality-errors"></span>

                                 {{-- <select style="border: 1px solid #d5d7e5 !important;" class="form-control form-control-sm select_tag_remove_box_sadow" id="select2-dropdown"  data-parsley-required-message="Select nationality" name="nationality_id" data-parsley-errors-container="#nationality-errors">
                                    <option value="{{ old('nationality_id',$escort->nationality_id)}}">{{($escort->nation) ? $escort->nation->name : ''}}</option>
                                    </select>
                                <span id="nationality-errors"></span> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500 custom--stathead" for="exampleFormControlSelect1" style="font-size: 18px;
                                margin-top: 11px;"><h2>Statistics</h2></label>
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
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Hair colour:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="hair_color">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.hair-colour') as $key => $colour)
                                    <option value='{{ $key}}' {{ ($escort->hair_color == $key) ? 'selected' : ''}}>{{ $colour}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Hair style:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="hair-style" name="hair_style">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.hair-style') as $key => $hair_style)
                                    <option value='{{ $key}}' {{ ($escort->hair_style == $key) ? 'selected' : ''}}>{{ $hair_style }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Height:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="height" id="">
                                    <option value="" selected>-Not Set-</option>
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
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1"> Eyes:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="eyes" id="">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.eye-colors') as $key => $color)
                                    <option value="{{ $key }}" {{ ($escort->eyes == $key) ? 'selected' : ''}}>{{ $color}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Skin tone:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="skin_tone">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.skin-tone') as $key => $colour)
                                    <option value='{{ $key}}' {{ ($escort->skin_tone == $key) ? 'selected' : ''}}>{{ $colour}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Weight (Kgs):</label>
                            <div class="col-sm-7">
                                <input type="text" data-parsley-type="digits" class="form-control form-control-sm  removebox_shdow" placeholder="Enter Your Weight" value="{{$escort->weight}}" name="weight" data-parsley-min="30" data-parsley-max="150" vlaue="{{ $escort->weight}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Shaved:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="shaved">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.shaved-type') as $key => $type)
                                    <option value='{{ $key}}' {{ ($escort->shaved == $key) ? 'selected' : ''}}>{{ $type}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @if(!in_array($user->gender, [1]))
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Breast:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="breast">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.breast-size') as $size => $cup_sizes)
                                        <optgroup label="{{$size}}">
                                            @foreach($cup_sizes as $cup_size)
                                                <option value='{{ $size.$cup_size}}' {{ ($escort->breast == ($size.$cup_size)) ? 'selected' : ''}}>{{ $size.$cup_size}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Dress size:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="dress_size">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.dress-size') as $key => $dress_size)
                                    <option value='{{ $key}}' {{ ($escort->dress_size == $key) ? 'selected' : ''}}>{{ $dress_size }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="row">
                    
                    @if(!in_array($user->gender, [6]))
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Endowment:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="endowment">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.endowments') as $key => $endowment)
                                    <option value='{{ $key}}' {{ ($escort->endowment == $key) ? 'selected' : ''}}>{{ $endowment }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Thickness:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="thickness">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.thicknesses') as $key => $thickness)
                                    <option value='{{ $key}}' {{ ($escort->thickness == $key) ? 'selected' : ''}}>{{ $thickness }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Circumcised:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="circumcised">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.circumcises') as $key => $circumcised)
                                    <option value='{{ $key}}' {{ ($escort->circumcised == $key) ? 'selected' : ''}}>{{ $circumcised }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    @endif
                </div>

                <div class="row">
                    
                    @if(!in_array($user->gender, [6]))
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Butt:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="butt">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.butts') as $key => $butt)
                                    <option value='{{ $key}}' {{ ($escort->butt == $key) ? 'selected' : ''}}>{{ $butt }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Preference:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="preference">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.preferences') as $key => $preference)
                                    <option value='{{ $key}}' {{ ($escort->preference == $key) ? 'selected' : ''}}>{{ $preference }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="row">
                    @if(in_array($user->gender, [1,2,3]))
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Hormones:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" name="hormones">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.hormones') as $key => $hormone)
                                        <option value='{{ $key}}' {{ ($escort->hormones == $key) ? 'selected' : ''}}>{{ $hormone }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Contact me:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="contact">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.contact-me') as $key => $contact)
                                    <option value='{{ $key}}' {{ ($escort->contact == $key) ? 'selected' : ''}}>{{ $contact}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500 custom--stathead" for="exampleFormControlSelect1" style="font-size: 18px;
                                margin-top: 11px;"><h2>Read More</h2></label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Piercing:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="piercing">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.piercing') as $key => $piercing)
                                    <option value='{{ $key}}' {{ ($escort->piercing == $key) ? 'selected' : ''}}>{{ $piercing }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Drugs:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="drugs">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.drugs') as $key => $drug)
                                    <option value='{{ $key}}' {{ ($escort->drugs == $key) ? 'selected' : ''}}>{{ $drug }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Language:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="language">
                                    <option value="" selected>-Not Set-</option>
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
                            <div class="col-sm-12">
                            <div id="show_language" style="display:none">
                            </div>

                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Travel:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="travel">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.travels') as $key => $travel)
                                    <option value='{{ $key}}' {{ ($escort->travel == $key) ? 'selected' : ''}}>{{ $travel }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Tattoos:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="tattoos">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.tattooes') as $key => $tattoos)
                                    <option value='{{ $key}}' {{ ($escort->tattoos == $key) ? 'selected' : ''}}>{{ $tattoos }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Smoke:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="smoke">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.smokes') as $key => $smoke)
                                    <option value='{{ $key}}' {{ ($escort->smoke == $key) ? 'selected' : ''}}>{{ $smoke }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Available to:</label>
                            <div class="col-sm-7">
                                <div class="form-control form-control-sm dropdown dropdown-with-checkbox">
                                    <button class="btn toggle_custome_btn_style custome_button_style dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select</button>
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

                            <div class="col-sm-12">
                            <div class="selecated_languages available">
                                <img src="{{ asset('assets/dashboard/img/woman-avatar.png')}}" id="1" style="display:@if(!empty($escort->available_to)) {{ (in_array(1 , $escort->available_to)) ? 'inline-block' : 'none' }}; @else none @endif">
                                <img src="{{ asset('assets/dashboard/img/male-user.png')}}" id="2" style="display:@if(!empty($escort->available_to)) {{(in_array(2 , $escort->available_to)) ? 'inline-block' : 'none'}};@else none @endif">
                                <img src="{{ asset('assets/dashboard/img/trans.png')}}" id="3" style="display:@if(!empty($escort->available_to)) {{ (in_array(3 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                                <img src="{{ asset('assets/dashboard/img/couple.png')}}" id="4" style="display:@if(!empty($escort->available_to)) {{ (in_array(4 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                                <img src="{{ asset('assets/dashboard/img/disabilities.png')}}" id="5" style="display:@if(!empty($escort->available_to)) {{ (in_array(5 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                                <img src="{{ asset('assets/dashboard/img/group.png')}}" id="6" style="display:@if(!empty($escort->available_to)) {{ (in_array(6 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                            </div>
                        </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500 small-icon" for="exampleFormControlSelect1">
                                SWA License:
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="Not compulsory but display it if you have one (Victoria only)." data-boundary="window">
                            </label>
                            <div class="col-sm-7">
                                <input type="text" value="{{ $escort->license}}" name="license" class="form-control form-control-sm select_tag_remove_box_sadow" id="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Play types:</label>
                            <div class="col-sm-7">
                                <div class="form-control form-control-sm dropdown dropdown-with-checkbox">
                                    <button class="btn custome_button_style dropdown-toggle toggle_custome_btn_style" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select</button>
                                    <div class="dropdown-menu padding_three_px_all" aria-labelledby="dropdownMenuButton">
                                        @foreach(config('escorts.profile.play-types') as $key => $play_type)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input playType" name="play_type[]" value='{{ $key}}' @if(!empty($escort->play_type)) @if(in_array($key , $escort->play_type)) checked @endif @endif data-name="{{$play_type}}">
                                            <label class="form-check-label" for="exampleCheck1">{{ $play_type }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                            <div id="show_playType" style="display:block">
                                @isset($escort->play_type)
                                @foreach($escort->play_type as $play_type)
                                <div class='selecated_languages playT' style='display: inline-block' id="{{$play_type}}"><span class='languages_choosed_from_drop_down'>{{ config('escorts.profile.play-types')["$play_type"] }} </span> </div>
                                @endforeach
                                @endisset
                            </div>
                        </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Payment:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="payment_type" name="payment_type">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.Payments') as $key => $Payment)
                                    <option value='{{ $key}}' {{ ($escort->payment_type == $key) ? 'selected' : ''}} data-name="{{ $Payment }}">{{ $Payment }}</option>@endforeach
                                </select>
                            </div>
                            @if(!empty($escort->payment_type))
                            <div class='select_pay'>
                                <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.Payments.$escort->payment_type") !!}</span>
                            </div>
                            @endif

                            <div class="col-sm-12">

                                <div id="show_payment_type" style="display:none">
                                    <div class='select_pay' style='display: inline-block'>
                                        <span class='languages_choosed_from_drop_down'> </span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12 stage">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-3 font-weight-500 small-icon custom--stathead  custom--stathead--flex" for="exampleFormControlSelect1" style="font-size: 18px;">
                            <h2>Stage Names</h2>
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="You can create as many as you like. Select your Stage Name from the drop down list that will appear in the Profile creator." data-boundary="window">

                            </label>
                            
                            <div class="col-sm-12 stageListParent pl-1">
                                <div class="col-sm-12 pl-0">
                                <input type="text" class="form-control form-control-sm" id="st_name" placeholder="Enter stage name">
                            </div>
                            <span><b>Note:</b>  <i>Save your new Stage Names before you apply the Sort feature.</i></span><br>
                                <div class="col-sm-12 " style="display: ruby; padding-left: 0px;">
                                    <label for="">Sort By : </label>
                                    <div class="pt-4 pb-3" data-i="{{$escort->covidreport}}">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input sortedByStageName" type="radio" name="sortedByStageName" id="alphabetically" value="alphabetically" checked>
                                            <label class="form-check-label" for="alphabetically">Alphabetical (A–Z)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input sortedByStageName" type="radio" name="sortedByStageName" id="random" value="random">
                                            <label class="form-check-label" for="random">Random</label>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="card-body active-play border-0 pt-0 pl-0 mt-1 pb-0 mb-0">
                                    <div class="at-lable  mt-0">
                                        <ul class="results" id="stageList">
                                            @if(!empty(auth()->user()->escorts_names))
                                                @php 
                                                    $sortedEscortName= Arr::sort(auth()->user()->escorts_names);
                                                @endphp
                                                @foreach($sortedEscortName as $key => $name)
                                                <li style="font-size: 14px; background:#0C223D !important;"> <a href="#">{{ $name}}</a>
                                                    <div class="close ml-2 text-white stage-close" aria-label="Close">
                                                        <span aria-hidden="true" class='delete_stname' id='{{$name}}'>×</span>
                                                        <small class='mytool-tip'>Remove</small>
                                                    </div>
                                                    <input type='hidden' name='name[]' value="{{ $name }}">
                                                </li>
                                                @endforeach
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-3 font-weight-500 custom--stathead" for="exampleFormControlSelect1" style="font-size: 18px;"><h2>Covid 19</h2></label>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-7">
                        <div class="pb-3" data-i="{{$escort->covidreport}}">
                            <div class="form-check form-check-inline ml-1">
                                <input class="form-check-input covidreport" type="radio" name="covidreport" id="inlineRadio1" value="1"{{ $escort->getRawOriginal('covidreport') == 1 ? ' checked' : null }}>
                                <label class="form-check-label" for="inlineRadio1">Vaccinated, not up to date</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input covidreport" type="radio" name="covidreport" id="inlineRadio2" value="2"{{ $escort->getRawOriginal('covidreport') == 2 ? ' checked' : null }}>
                                <label class="form-check-label" for="inlineRadio2">Vaccinated, up to date</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input covidreport" type="radio" name="covidreport" id="inlineRadio3" value="3"{{ $escort->getRawOriginal('covidreport') == 3 ? ' checked' : null }}>
                                <label class="form-check-label" for="inlineRadio3">Not Vaccinated</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="read-more" type="submit" class="save_profile_btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
