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
    <form id="update_about_me" class="common-form" action="{{ route('escort.settings.about.me')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- upload video  -->
        <div class="about_me_drop_down_info ">
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
                            <h2>About me <span class="custom--help"><b>Help?</b></span></h2>
                        </div>
                    </div>

                    <div class="custom-note-section">
                        <div class="card">
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
                </div>

                <div class="col-lg-12">
                    <div class="inner-field-row">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">
                                Age<span style="color:red">*</span>
                            </label>
                            <input type="text" data-parsley-type="digits" class="form-control form-control-sm select_tag_remove_box_sadow" id="" required="" name="age" value="{{$escort->age}}" data-parsley-min="18" data-parsley-max="70">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Orientation</label>
                            <div class="national">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="orientation">
                                    <option value="" selected>-Not Set-</option>
                                    @foreach(config('escorts.profile.orientation') as $key => $orientate)
                                    <option value='{{ $key}}' {{ ($escort->orientation == $key) ? 'selected' : ''}}>{{ $orientate}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Ethnicity</label>

                            <select class="form-control select_tag_remove_box_sadow" id="ethnicity" name="ethnicity">
                                <option value="">-Not Set-</option>
                                @foreach(config('escorts.profile.ethnicities') as $key => $ethnicity)
                                <option value="{{ old('ethnicity', $key) }}" {{ ($escort->ethnicity == $key) ? 'selected' : ''}}>{{ $ethnicity }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Body type</label>
                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="body_type">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.body-type') as $key => $body_type)
                                <option value='{{ $key}}' {{ ($escort->body_type == $key) ? 'selected' : ''}}>{{ $body_type}}</option>@endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">
                                Nationality</label>
                            <div class="national">

                                <select style="border: 1px solid #d5d7e5 !important;" class="form-control select_tag_remove_box_sadow nationality-sec" id="select2-dropdown" data-parsley-required-message="Select nationality" name="nationality_id" data-parsley-errors-container="#nationality-errors">
                                    <option value="{{ old('nationality_id',$escort->nationality_id)}}">{{($escort->nation) ? $escort->nation->name : ''}}</option>
                                </select>
                                <span id="nationality-errors"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row inner-row">
                <div class="col-lg-12">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg fill="#ff3c5f" height="64px" width="64px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 215.639 215.639" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <path d="M118.713,101.426h86.426c4.142,0,7.5-3.357,7.5-7.5C212.639,42.135,170.504,0,118.713,0c-4.142,0-7.5,3.357-7.5,7.5v86.426 C111.213,98.068,114.571,101.426,118.713,101.426z M126.213,15.354c37.547,3.555,67.517,33.524,71.072,71.072h-71.072V15.354z"></path>
                                        <path d="M101.427,118.606V35.287c0-4.143-3.358-7.5-7.5-7.5C42.135,27.787,0,69.922,0,121.713 c0,51.791,42.135,93.926,93.927,93.926c25.087,0,48.673-9.771,66.415-27.511c1.478-1.477,2.265-3.511,2.185-5.599 c-0.074-1.904-0.874-3.707-2.219-5.04L101.427,118.606z M93.927,200.639c-43.52,0-78.927-35.406-78.927-78.926 c0-40.991,31.41-74.784,71.427-78.572v78.572c0,1.989,0.79,3.896,2.197,5.304l55.561,55.562 C130.07,194.274,112.486,200.639,93.927,200.639z"></path>
                                        <path d="M208.139,109.256h-86.426c-3.034,0-5.768,1.827-6.929,4.63c-1.161,2.803-0.519,6.028,1.626,8.174l61.1,61.1 c0.07,0.069,0.142,0.139,0.214,0.206l0.013,0.012c1.439,1.329,3.265,1.99,5.088,1.99c1.923,0,3.843-0.735,5.304-2.196 c17.74-17.739,27.51-41.326,27.51-66.415C215.639,112.613,212.281,109.256,208.139,109.256z M182.578,167.015l-42.758-42.759h60.47 C198.812,140.028,192.686,154.818,182.578,167.015z"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="card-heading">
                            <h2>Statistics</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="inner-field-row">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Hair colour</label>

                            <select class="form-control  select_tag_remove_box_sadow" id="" name="hair_color">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.hair-colour') as $key => $colour)
                                <option value='{{ $key}}' {{ ($escort->hair_color == $key) ? 'selected' : ''}}>{{ $colour}}</option>@endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Hair style</label>

                            <select class="form-control  select_tag_remove_box_sadow" id="hair-style" name="hair_style">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.hair-style') as $key => $hair_style)
                                <option value='{{ $key}}' {{ ($escort->hair_style == $key) ? 'selected' : ''}}>{{ $hair_style }}</option>@endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Height</label>

                            <select class="form-control  select_tag_remove_box_sadow" name="height" id="">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.heights') as $key => $height)
                                <option value="{{ $key }}" {{ ($escort->height == $key) ? 'selected' : ''}}>{{ $height}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1"> Eyes</label>
                            <select class="form-control  select_tag_remove_box_sadow" name="eyes" id="">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.eye-colors') as $key => $color)
                                <option value="{{ $key }}" {{ ($escort->eyes == $key) ? 'selected' : ''}}>{{ $color}}</option>@endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Skin tone</label>

                            <select class="form-control select_tag_remove_box_sadow" id="" name="skin_tone">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.skin-tone') as $key => $colour)
                                <option value='{{ $key}}' {{ ($escort->skin_tone == $key) ? 'selected' : ''}}>{{ $colour}}</option>@endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Weight (Kgs)</label>

                            <input type="text" data-parsley-type="digits" class="form-control form-control-sm  removebox_shdow" placeholder="Enter Your Weight" value="{{$escort->weight}}" name="weight" data-parsley-min="30" data-parsley-max="150" vlaue="{{ $escort->weight}}">

                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlSelect1">Shaved</label>

                            <select class="form-control select_tag_remove_box_sadow" id="" name="shaved">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.shaved-type') as $key => $type)
                                <option value='{{ $key}}' {{ ($escort->shaved == $key) ? 'selected' : ''}}>{{ $type}}</option>@endforeach
                            </select>
                        </div>
                        @if(!in_array($user->gender, [1]))
                        <div class="form-group ">
                            <label for="exampleFormControlSelect1">Breast</label>

                            <select class="form-control select_tag_remove_box_sadow" id="" name="breast">
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
                        <div class="form-group ">
                            <label for="exampleFormControlSelect1">Dress size</label>

                            <select class="form-control select_tag_remove_box_sadow" name="dress_size">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.dress-size') as $key => $dress_size)
                                <option value='{{ $key}}' {{ ($escort->dress_size == $key) ? 'selected' : ''}}>{{ $dress_size }}</option>@endforeach
                            </select>

                        </div>
                        @endif
                        @if(!in_array($user->gender, [6]))
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Endowment:</label>

                            <select class="form-control select_tag_remove_box_sadow" name="endowment">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.endowments') as $key => $endowment)
                                <option value='{{ $key}}' {{ ($escort->endowment == $key) ? 'selected' : ''}}>{{ $endowment }}</option>@endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Thickness</label>

                            <select class="form-control select_tag_remove_box_sadow" name="thickness">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.thicknesses') as $key => $thickness)
                                <option value='{{ $key}}' {{ ($escort->thickness == $key) ? 'selected' : ''}}>{{ $thickness }}</option>@endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Circumcised</label>

                            <select class="form-control select_tag_remove_box_sadow" name="circumcised">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.circumcises') as $key => $circumcised)
                                <option value='{{ $key}}' {{ ($escort->circumcised == $key) ? 'selected' : ''}}>{{ $circumcised }}</option>@endforeach
                            </select>

                        </div>
                        @endif
                        @if(!in_array($user->gender, [6]))
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Butt</label>
                            <select class="form-control select_tag_remove_box_sadow" name="butt">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.butts') as $key => $butt)
                                <option value='{{ $key}}' {{ ($escort->butt == $key) ? 'selected' : ''}}>{{ $butt }}</option>@endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Preference</label>
                            <select class="form-control select_tag_remove_box_sadow" name="preference">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.preferences') as $key => $preference)
                                <option value='{{ $key}}' {{ ($escort->preference == $key) ? 'selected' : ''}}>{{ $preference }}</option>@endforeach
                            </select>
                        </div>
                        @endif

                        @if(in_array($user->gender, [1,2,3]))
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Hormones</label>

                            <select class="form-control select_tag_remove_box_sadow" name="hormones">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.hormones') as $key => $hormone)
                                <option value='{{ $key}}' {{ ($escort->hormones == $key) ? 'selected' : ''}}>{{ $hormone }}</option>@endforeach
                            </select>

                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Contact me</label>

                            <select class="form-control select_tag_remove_box_sadow" id="" name="contact">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.contact-me') as $key => $contact)
                                <option value='{{ $key}}' {{ ($escort->contact == $key) ? 'selected' : ''}}>{{ $contact}}</option>@endforeach
                            </select>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row inner-row">
                <div class="col-lg-12">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg width="40px" height="40px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="m 7.996094 0 c -1.105469 0 -2 0.894531 -2 2 s 0.894531 2 2 2 c 1.101562 0 2 -0.894531 2 -2 s -0.898438 -2 -2 -2 z m 0 6 c -1.105469 0 -2 0.894531 -2 2 s 0.894531 2 2 2 c 1.101562 0 2 -0.894531 2 -2 s -0.898438 -2 -2 -2 z m 0 6 c -1.105469 0 -2 0.894531 -2 2 s 0.894531 2 2 2 c 1.101562 0 2 -0.894531 2 -2 s -0.898438 -2 -2 -2 z m 0 0" fill="#ff3c5f"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="card-heading">
                            <h2>Read More</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="inner-field-row">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Piercing</label>

                            <select class="form-control select_tag_remove_box_sadow" id="" name="piercing">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.piercing') as $key => $piercing)
                                <option value='{{ $key}}' {{ ($escort->piercing == $key) ? 'selected' : ''}}>{{ $piercing }}</option>@endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Drugs</label>

                            <select class="form-control  select_tag_remove_box_sadow" id="" name="drugs">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.drugs') as $key => $drug)
                                <option value='{{ $key}}' {{ ($escort->drugs == $key) ? 'selected' : ''}}>{{ $drug }}</option>@endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Language</label>

                            <select class="form-control select_tag_remove_box_sadow" id="language">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.languages') as $key => $language)
                                <option value='{{ $key}}' @if(!empty($escort->language)) @if(in_array($key ,$escort->language)) selected @endif @endif data-name="{{ $language }}">{{ $language }}</option>@endforeach
                            </select>

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
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Travel</label>

                            <select class="form-control select_tag_remove_box_sadow" id="" name="travel">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.travels') as $key => $travel)
                                <option value='{{ $key}}' {{ ($escort->travel == $key) ? 'selected' : ''}}>{{ $travel }}</option>@endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Tattoos</label>

                            <select class="form-control select_tag_remove_box_sadow" id="" name="tattoos">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.tattooes') as $key => $tattoos)
                                <option value='{{ $key}}' {{ ($escort->tattoos == $key) ? 'selected' : ''}}>{{ $tattoos }}</option>@endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Smoke</label>

                            <select class="form-control select_tag_remove_box_sadow" id="" name="smoke">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.smokes') as $key => $smoke)
                                <option value='{{ $key}}' {{ ($escort->smoke == $key) ? 'selected' : ''}}>{{ $smoke }}</option>@endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Available to</label>

                            <div class="form-control dropdown dropdown-with-checkbox">
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

                        <div class="form-group">
                            <label class=" small-icon" for="exampleFormControlSelect1">
                                SWA License
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}" data-toggle="tooltip" data-html="true" data-placement="top" title="Not compulsory but display it if you have one (Victoria only)." data-boundary="window">
                            </label>

                            <input type="text" value="{{ $escort->license}}" name="license" class="form-control select_tag_remove_box_sadow" id="">

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Play types</label>

                            <div class="form-control dropdown dropdown-with-checkbox">
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
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Payment</label>

                            <select class="form-control  select_tag_remove_box_sadow" id="payment_type" name="payment_type">
                                <option value="" selected>-Not Set-</option>
                                @foreach(config('escorts.profile.Payments') as $key => $Payment)
                                <option value='{{ $key}}' {{ ($escort->payment_type == $key) ? 'selected' : ''}} data-name="{{ $Payment }}">{{ $Payment }}</option>@endforeach
                            </select>

                            @if(!empty($escort->payment_type))
                            <div class='select_pay'>
                                <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.Payments.$escort->payment_type") !!}</span>
                            </div>
                            @endif

                            <div class="col-sm-12">

                                <div id="show_payment_type" style="display:none">
                                    <div class='select_pay' style='display: inline-block'>
                                        <span class='languages_choosed_from_drop_down'> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row inner-row">
                <div class="col-lg-12">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg fill="#ff3c5f" height="40px" width="40px" version="1.2" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-426 153 106.7 256" xml:space="preserve" stroke="#ff3c5f">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M-351.5,396.8h-8.3v-16.7H-385v16.7h-8.3v8.4h41.8V396.8z M-383.2,206.6c0,4.6-3.7,8.3-8.3,8.3s-8.3-3.7-8.3-8.3 c0-4.6,8.3-16.8,8.3-16.8S-383.2,201.5-383.2,206.6z M-351.5,367.1V242.8h-8.3V226h-8.4v-67l-8.3,8.5V226h-8.5v16.8h-8.3v124.3 h-20.9v8.3h83.7v-8.3H-351.5z M-356.1,366.8h-32.5v-70h32.5V366.8z"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="card-heading">
                            <h2>Covid 19</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="inner-field-row">
                        <div data-i="{{$escort->covidreport}}">
                            <div class="form-check form-check-inline ml-1">
                                <input class="form-check-input covidreport" type="radio" name="covidreport" id="inlineRadio1" value="1" {{ $escort->getRawOriginal('covidreport') == 1 ? ' checked' : null }}>
                                <label class="form-check-label" for="inlineRadio1">Vaccinated, not up to date</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input covidreport" type="radio" name="covidreport" id="inlineRadio2" value="2" {{ $escort->getRawOriginal('covidreport') == 2 ? ' checked' : null }}>
                                <label class="form-check-label" for="inlineRadio2">Vaccinated, up to date</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input covidreport" type="radio" name="covidreport" id="inlineRadio3" value="3" {{ $escort->getRawOriginal('covidreport') == 3 ? ' checked' : null }}>
                                <label class="form-check-label" for="inlineRadio3">Not Vaccinated</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 common-footer">
                    <button id="read-more" type="submit" class="common-save-btn">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>