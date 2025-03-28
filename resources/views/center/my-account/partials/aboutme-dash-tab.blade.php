<div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
    <form id="update_about_me" action="{{ route('escort.settings.about.me')}}" method="POST" enctype="multipart/form-data">
        @csrf  
       
        
        <!-- upload video  -->
        <div class="about_me_drop_down_info">
            <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                <h2>About me</h2>
            </div>
            <div class="padding_20_all_side pb-0">
                <!--New Row from here-->
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">
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
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Orientation:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="orientation">
                                    <option value="" selected disabled>-Not Set-</option>
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
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">
                            Nationality:</label>
                            <div class="col-sm-7">
                                <select style="border: 1px solid #d5d7e5 !important;" class="form-control form-control-sm select_tag_remove_box_sadow" id="select2-dropdown"  data-parsley-required-message="Select nationality" name="nationality_id" data-parsley-errors-container="#nationality-errors">
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
                                    <option value="" selected="" disabled="">-Not Set-</option>
                                    <option value="" selected disabled>-Not Set-</option>
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
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1" style="font-size: 18px;
                            margin-top: 11px;">Statistics</label>
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
                                    <option value="" selected disabled>-Not Set-</option>
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
                                    <option value="" selected disabled>-Not Set-</option>
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
                                    <option value="" selected disabled>-Not Set-</option>
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
                                    <option value="" selected disabled>-Not Set-</option>
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
                                    <option value="" selected disabled>-Not Set-</option>
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
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.contact-me') as $key => $contact)
                                    <option value='{{ $key}}' {{ ($escort->contact == $key) ? 'selected' : ''}}>{{ $contact}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Piercing:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="piercing">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.piercing') as $key => $piercing)
                                    <option value='{{ $key}}' {{ ($escort->piercing == $key) ? 'selected' : ''}}>{{ $piercing }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Drugs:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="drugs">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.drugs') as $key => $drug)
                                    <option value='{{ $key}}' {{ ($escort->drugs == $key) ? 'selected' : ''}}>{{ $drug }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Language:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="language">
                                    <option value="" selected disabled>-Not Set-</option>
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
                                    <option value="" selected disabled>-Not Set-</option>
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
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.tattooes') as $key => $tattoos)
                                    <option value='{{ $key}}' {{ ($escort->tattoos == $key) ? 'selected' : ''}}>{{ $tattoos }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Smoke:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="smoke">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.smokes') as $key => $smoke)
                                    <option value='{{ $key}}' {{ ($escort->smoke == $key) ? 'selected' : ''}}>{{ $smoke }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Available to:</label>
                            <div class="col-sm-7">
                                <div class="form-control form-control-sm dropdown dropdown-with-checkbox">
                                    <button class="btn toggle_custome_btn_style custome_button_style dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-Not Set-</button>
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
                            <div class="selecated_languages available">
                                <img src="{{ asset('assets/dashboard/img/woman-avatar.png')}}" id="1" style="display:@if(!empty($escort->available_to)) {{ (in_array(1 , $escort->available_to)) ? 'inline-block' : 'none' }}; @else none @endif">
                                <img src="{{ asset('assets/dashboard/img/male-user.png')}}" id="2" style="display:@if(!empty($escort->available_to)) {{(in_array(2 , $escort->available_to)) ? 'inline-block' : 'none'}};@else none @endif">
                                <img src="{{ asset('assets/dashboard/img/trans.png')}}" id="3" style="display:@if(!empty($escort->available_to)) {{ (in_array(3 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                                <img src="{{ asset('assets/dashboard/img/couple.png')}}" id="4" style="display:@if(!empty($escort->available_to)) {{ (in_array(4 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                                <img src="{{ asset('assets/dashboard/img/disabilities.png')}}" id="5" style="display:@if(!empty($escort->available_to)) {{ (in_array(5 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                                <img src="{{ asset('assets/dashboard/img/group.png')}}" id="6" style="display:@if(!empty($escort->available_to)) {{ (in_array(6 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                            </div>
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
                                    <button class="btn custome_button_style dropdown-toggle toggle_custome_btn_style" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-Not Set-</button>
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
                            <div id="show_playType" style="display:block">
                                
                                @isset($escort->play_type)
                                    @foreach($escort->play_type as $play_type)
                                    <div class='selecated_languages playT' style='display: inline-block' id="{{$play_type}}"><span class='languages_choosed_from_drop_down'>{{ config('escorts.profile.play-types')["$play_type"] }} </span> </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Payment:</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="payment_type">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.Payments') as $key => $Payment)
                                    <option value='{{ $key}}' {{ ($escort->payment_type == $key) ? 'selected' : ''}}>{{ $Payment }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="read-more" type="submit" class="save_profile_btn">Save Information</button>
                    </div>
                </div>
            
            </div>
        </div>
    </form>
</div>
