<style type="text/css">
    span.select2.select2-container.select2-container--default {
    width: 100% !important;
    }
    .select2-container--default .select2-selection--single{
    border: 1px solid #d1d3e2;
    }
</style>
<div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
    {{-- <form id="update_about_me" action="{{ route('agent.about.me',[$escort->id])}}" method="POST" enctype="multipart/form-data">
        @csrf   --}}
        <div class="row pl-3">
        <div class="col-lg-3">
            <div class="member-id pl-0 pb-2 pt-3">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0" />
                </svg>
                <span>Member ID: {{ $user->member_id }}</span>

                {{-- @if(!empty($escort->available_to)) @if(in_array($key , $escort->available_to)) checked @endif @endif --}}
            </div>
        </div>
        <div class="col-lg-6">

            <div class="member-id pl-0 pb-2 pt-3">

                <span>Save as Draft : </span><input type="checkbox" class="form-check-input draft mt-0" id="draftId" name="draft" @if(!empty($escort->enabled)) @if($escort->enabled == 2)) checked @endif @endif>

                {{-- @if(!empty($escort->available_to)) @if(in_array($key , $escort->available_to)) checked @endif @endif --}}
            </div>
        </div>
    </div>
<div class="about_me_drop_down_info profile-sec">
            <div class="row tab-input- pl-2 pt-4">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="form-group row tab-about-me-row-padding">
                        <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">
                        Profile Name:</label>
                        <div class="col-sm-7">
                            <input type="text" placeholder="Melbourne" value="{{ $escort->profile_name}}" name="profile_name" class="form-control form-control-sm select_tag_remove_box_sadow" id="profile_name" required="" data-parsley-required-message="Enter profile name" data-parsley-group="goup_one">

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="form-group row tab-about-me-row-padding saveDraft">
                        <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Profile start date:</label>
                        <div class="col-sm-7 pl-0">
                            <input type="date" name="start_date" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{ $escort->start_date ? date('Y-m-d',strtotime($escort->start_date)) : ''}}" id="start_date" onkeydown="return false" required="" data-parsley-required-message="-select date-" data-parsley-group="goup_one">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="form-group row tab-about-me-row-padding saveDraft">
                        <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Profile end date:</label>
                        <div class="col-sm-7 pl-0">
                            <input type="date" name="end_date" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{ $escort->end_date ? date('Y-m-d',strtotime($escort->end_date)) : ''}}" id="end_date" onkeydown="return false" required="" data-parsley-required-message="-select date-" data-parsley-group="goup_one">
                        </div>
                    </div>
                </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="form-group row tab-about-me-row-padding saveDraft">
                        <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Membership Type:</label>
                        <div class="col-sm-7">
                            <select name="membership" id="membership" required data-parsley-required-message="-select membership-" data-parsley-group="goup_one" style="width: 100%;">
                            {{-- <option value="" selected="">-Not Set-</option> --}}
                        <option value="1" {{($escort->membership == 1) ? 'selected' : ''}}>Platinum</option>
                        <option value="2" {{($escort->membership == 2) ? 'selected' : ''}}>Gold</option>
                        <option value="3" {{($escort->membership == 3) ? 'selected' : ''}}>Silver</option>
                        <option value="4" {{($escort->membership == 4) ? 'selected' : ''}}>Free</option>
                        </select>

                        </div>
                    </div>
                </div></div>
        </div>

        <div class="about_me_drop_down_info profile-sec">
            <div class="row">
                <div class="col-md-6" style="border-right: 10px solid #eee;">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8 pl-1">
                                <div class="about-me-box-one-name stage_name pt-3" style={{ $escort->name ? '' : "color:#9A9B9C;" }} >
                                    {{$escort->name ? $escort->name  : 'Stage Name'}}

                                </div>

                                <div class="about-me-box-one-name show_input_box mt-3"  style="display: none">
                                    {{-- <input type="text" name="name" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{$escort->name }}"> --}}
                                    @if( !empty($user->profile_creator) && in_array(1,$user->profile_creator))
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow" id="stageName" name="name" required="" data-parsley-required-message="-select name-" data-parsley-group="goup_one" data-parsley-errors-container="#stageName-errors">
                                            <option value="" selected>-Select Your Stage Name-</option>
                                            {{-- <option value="" selected disabled>-Not Set-</option> --}}
                                            @if(!empty($user->escorts_names))
                                            @foreach($user->escorts_names as $key => $name)
                                                <option value='{{ $name}}' {{ ($escort->name == $name)? 'selected' : ''}}>{{ $name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @else
                                        <input type="text" name="name" class="form-control form-control-sm select_tag_remove_box_sadow" placeholder="Enter Your Stage Name" value="{{$escort->name ? $escort->name : '' }}">
                                    @endif
                                </div>
                                <span id="stageName-errors"></span>
                                <div class="about-me-box-one-number mobile_num" style={{ $escort->city ? '' : "color:#C4C4C4;" }}>
                                    {{ $escort->city ? $escort->city->name : "Location -"}}{{$escort->phone ? ' - '.$escort->phone : $user->phone}}

                                </div>
                                {{-- {{  dd(config('escorts.profile.states')[3910]['cities']) }} --}}

                                <div class="about-me-box-one-number show_input_box" style="display: none">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="state_id" name="state_id" required="" data-parsley-required-message="-select location-" data-parsley-group="goup_one" data-parsley-errors-container="#locationState-errors">
                                        {{-- <required data-parsley-required-message="-select city-" data-parsley-group="goup_one"> --}}
                                        <option value="" selected="">-- Select States--</option>

                                        @foreach(config('escorts.profile.states') as $key => $state)
                                        <option style="font-weight: 500;" value="{{$key}}"
                                        @if($escort->state_id != null)
                                            {{ $escort->state_id != null && $escort->state_id == $key ? 'selected' : '' }}
                                        @else
                                            {{ $user->state_id == $key ? 'selected' : '' }}
                                        @endif
                                         > {{$state['stateName']}} </option>
                                        @endforeach

                                    </select>
                                </div>
                                <span id="locationState-errors"></span>
                                <div class="about-me-box-one-number show_input_box" style="display: none">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="city_id" name="city_id" required="" data-parsley-required-message="-select city-" data-parsley-group="goup_one" data-parsley-errors-container="#locationName-errors">
                                        {{-- <required data-parsley-required-message="-select city-" data-parsley-group="goup_one"> --}}
                                        {{-- <option value="" selected="">-- Select cites--</option> --}}
                                        @if($escort->city_id)
                                        <option id="{{$escort->city_id}}" value="{{$escort->city_id}}" selected>{{$escort->city->name}}</option>
                                        @else

                                        @foreach(config('escorts.profile.states')[$user->state_id]['cities'] as $key =>$city)
                                        <option id="{{$key}}" value="{{$key}}"  selected >{{$city['cityName']}}</option>
                                        @endforeach



                                        @endif
                                    </select>
                                    {{-- <span id="locationName-errors"></span> --}}
                                    <input type="text" name="phone" class="form-control form-control-sm select_tag_remove_box_sadow mt-2" value="{{$escort->phone ? $escort->phone : $user->phone  }}" placeholder="Mobile Number">
                                </div>

                                <div class="about-me-box-one-map add_class" style={{ $escort->
                                    state ? '' : "color:#C4C4C4;" }}>
                                    {{-- @php //if($escort->address || $escort->state || $escort->pincode) { @endphp --}}
                                    <svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F" />
                                    </svg>
                                    {{-- @php  } @endphp --}}
                                    {{ $escort->address ? $escort->address.',' : "Address" }} {{ $escort->state ? $escort->state->name : null }} {{ $escort->pincode }}
                                </div>
                                <div class="about-me-box-one-name show_input_box mt-3"  style="display: none">
                                    <input type="text" name="address" placeholder="Where are you staying" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{$escort->address }}">
                                </div>
                                <div class="about-md-box-social">@if(!empty($escort->social_links)) @foreach($escort->social_links as $key=>$val)
                                    <a href="{{ $val }}">
                                    <img src="{{ asset('assets/dashboard/img/'.$key.'.svg') }}" />
                                    </a>@endforeach @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="pull-right pt-5" style="text-align: end;">
                                    <a href="#" id="new_saveProfilename">
                                        <span class="pr-2">Edit</span>
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.5325 3.77992C13.825 3.48742 13.825 2.99992 13.5325 2.72242L11.7775 0.967422C11.5 0.674922 11.0125 0.674922 10.72 0.967422L9.34 2.33992L12.1525 5.15242L13.5325 3.77992ZM0.25 11.4374V14.2499H3.0625L11.3575 5.94742L8.545 3.13492L0.25 11.4374Z" fill="#90A0B7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12 pt-5 p-0 pb-3">
                                <div class="plate">
                                    <label class="newbtn p-0 m-0 d-flex">
                                    {{-- <img id="blah1" class="img-fluid" src="{{ asset('assets/app/img/new-upload.png')}}" style="width: 100%;object-fit: cover;height: 188px;"> --}}
                                    {{-- <input name="img[10]" id="imgx" class="pis" onchange="readURL(this);" type="file"> --}}
                                    <input type="hidden" name="position[]" value="1">

                                    <video poster="{{ asset('assets/app/img/video-play-button.jpg') }}" controls="" style="background: #0000006b;width: 520px;height: 190px;object-fit: cover;" id="akhVideo">
                                    <source id="imgx" src="{{ asset('assets/app/img/mov_bbb.mp4') }}" type="video/mp4">
                                    </video>

                                    <!-- <video width="100%" height="240" controls>
                                    <source id="imgx" src="{{ asset($escort->imagePosition(10)) }}" type="video/mp4">
                                        <source id="imgx" src="{{ asset($escort->imagePosition(10)) }}" type="video/mp4">
                                    </video> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="padding-right: 25px;">
                    <div class="container p-0">
                        <div class="row pt-3">
                            <div class="col-4 pr-0 ">
                                <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                {{-- <img class="img-fluid modal-image-first" id="img1" src="{{ asset('assets/app/img/upload-1.png')}}" style="height: 284px;object-fit: cover;"> --}}

                                    <img class="img-fluid" id="img1" src="{{ asset($escort->imagePosition(1))}}" style="height: 220px;object-fit: cover;width: 167px;">
                                    </label>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row" style="">
                                    <div class="col-4 pr-0">
                                        <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid upld-img" id="img2" src="{{ asset($escort->imagePosition(2))}}">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4 pr-0">
                                        <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid upld-img" id="img3" src="{{ asset($escort->imagePosition(3))}}">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4 pr-0">
                                        <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid upld-img" id="img4" src="{{ asset($escort->imagePosition(4))}}">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="">
                                    <div class="col-4 pr-0">
                                        <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid upld-img" id="img5" src="{{ asset($escort->imagePosition(5))}}">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4 pr-0">
                                        <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid upld-img" id="img6" src="{{ asset($escort->imagePosition(6))}}">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4 pr-0">
                                        <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid upld-img" id="img7" src="{{ asset($escort->imagePosition(7))}}">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="about_me_drop_down_info add_banner_pic pb-0">
                               <label class="newbtn" data-toggle="modal" data-target="#upload-sec-banner">
                                 <img class="img-fluid"  id="img9" src="{{ asset($escort->imagePosition(9))}}" style="height: 167.578px;width: 1066.640px;object-fit: cover;">
                               </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="about_me_drop_down_info profile-sec p-3">
            <div class="about_me_drop_down_info ">
                <label class="newbtn" data-toggle="modal" data-target="#upload-sec-banner">
                <img class="img-fluid" id="img0" src="{{ asset('assets/app/img/upload-3.png') }}" style="height: 167.578px;width: 1066.640px;object-fit: cover;">
                </label>
            </div>
        </div>
        <div class="about_me_drop_down_info profile-sec p-3">
            <div class="about_me_drop_down_info ">
                <label class="newbtn" data-toggle="modal" data-target="#upload-sec-banner">
                <img class="img-fluid" id="img0" src="{{ asset('assets/app/img/upload-7.png') }}" style="height: 167.578px;width: 1066.640px;object-fit: cover;">
                </label>
            </div>
        </div> -->
        <!-- add banner image -->

        <div class="about_me_drop_down_info profile-sec">
            <div class="padding_20_all_side p-2 pb-4">
                <!--New Row from here-->
                <!--New Row end here-->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="border_covid covid_heading ">
                            <h2>About Us</h2>
                        </div>

                                                <div class="card-body pb-0">
                            <div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
                                <!-- upload video  -->
                                <div class="about_me_drop_down_info ">
                                    <div class="padding_20_all_side pb-0">
                                        <!--New Row from here-->
                                        @php

                                        $escort->gender ? $escortGender = $escort->getRawOriginal('gender') : $escortGender = $user->gender;
                                        // if(empty($escort->gender)){
                                        //     $escortGender = auth()->user()->gender;
                                        // }
                                        @endphp
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">
                                                    Gender:<span style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Gender" name="gender" required  data-parsley-group="goup_one">

                                                            <option value='' selected>-Not Set- </option>
                                                            @foreach(config('escorts.profile.genders') as $key => $gender)
                                                            <option value="{{ $key }}" {{ ($escortGender == $key) ? 'selected' : ''}}>{{$gender}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Orientation:</label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Orientation" name="orientation">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.orientation') as $key => $orientate)
                                                            <option value='{{ $key}}' {{ ($escort->orientation == $key) ? 'selected' : ''}}>{{ $orientate}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Ethnicity</label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Ethnicity" name="ethnicity">
                                                            <option value="">-Not Set-</option>
                                                            @foreach(config('escorts.profile.ethnicities') as $key => $ethnicity)
                                                            <option value="{{ $key }}" {{ ($escort->ethnicity == $key) ? 'selected' : ''}}>{{ $ethnicity }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Nationality:</label>
                                                    <div class="col-sm-8">
                                                        <select style="border: 1px solid #d5d7e5 !important;" class="form-control form-control-sm select_tag_remove_box_sadow nationality-sec" id="select2-dropdown"  data-parsley-required-message="Select nationality" name="nationality_id" data-parsley-errors-container="#nationality-errors">
                                                            <option value="{{ old('nationality_id',$escort->nationality_id)}}">{{($escort->nation) ? $escort->nation->name : ''}}</option>
                                                        </select>
                                                        <span id="nationality-errors"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">
                                                    Age:<span style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input data-parsley-type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="age" required="" name="age" value="{{$escort->age}}" data-parsley-min="18" data-parsley-max="70" data-parsley-group="goup_one">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Body type:
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Body type" name="body_type">
                                                            <option value="" selected="" disabled="">-Not Set-</option>
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
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Hair colour:</label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Hair colour" name="hair_color">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.hair-colour') as $key => $colour)
                                                            <option value='{{ $key}}' {{ ($escort->hair_color == $key) ? 'selected' : ''}}>{{ $colour}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Hair style:</label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Hair style" name="hair_style">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.hair-style') as $key => $hair_style)
                                                            <option value='{{ $key}}' {{ ($escort->hair_style == $key) ? 'selected' : ''}}>{{ $hair_style }}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Height:</label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" name="height" id="Height">
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
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1"> Eyes:</label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" name="eyes" id="Eyes">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.eye-colors') as $key => $color)
                                                            <option value="{{ $key }}" {{ ($escort->eyes == $key) ? 'selected' : ''}}>{{ $color}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Skin tone:</label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Skin tone" name="skin_tone">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.skin-tone') as $key => $colour)
                                                            <option value='{{ $key}}' {{ ($escort->skin_tone == $key) ? 'selected' : ''}}>{{ $colour}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Weight(Kgs):</label>
                                                    <div class="col-sm-8">
                                                        <input data-parsley-type="number" class="form-control form-control-sm  removebox_shdow" placeholder="Enter Your Weight" value="{{$escort->weight}}" name="weight" data-parsley-min="30" data-parsley-max="150" vlaue="{{ $escort->weight}}" id="Weight">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Shaved:</label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" name="shaved" id="Shaved">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.shaved-type') as $key => $type)
                                                            <option value='{{ $key}}' {{ ($escort->shaved == $key) ? 'selected' : ''}}>{{ $type}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Breast:</label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Breast" name="breast">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.breast-size') as $key => $size)
                                                            <option value='{{ $key}}' {{ ($escort->breast == $key) ? 'selected' : ''}}>{{ $size}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Dress size:</label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Dress size" name="dress_size">
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
                                                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Contact me:</label>
                                                    <div class="col-sm-8">
                                                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Contact me" name="contact">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.contact-me') as $key => $contact)
                                                            <option value='{{ $key}}' {{ ($escort->contact == $key) ? 'selected' : ''}}>{{ $contact}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border_covid covid_heading mt-4">
                            <h2>Read more</h2>
                        </div>


                                <div class="card-body pb-0">
            {{-- <form id="read_more" action="{{ route('escort.read.more',[$escort->id])}}" method="POST">
                @csrf --}}
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Piercing:</label>
                            <div class="col-sm-8">
                                <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Piercing" name="piercing">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.piercing') as $key => $piercing)
                                    <option value='{{ $key}}' {{ ($escort->piercing == $key) ? 'selected' : ''}}>{{ $piercing }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Drugs:</label>
                            <div class="col-sm-8">
                                <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Drugs" name="drugs">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.drugs') as $key => $drug)
                                    <option value='{{ $key}}' {{ ($escort->drugs == $key) ? 'selected' : ''}}>{{ $drug }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Language:</label>
                            <div class="col-sm-8">
                                <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="language">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.languages') as $key => $language)
                                    <option value='{{ $key}}' @if(!empty($escort->language)) @if(in_array($key ,$escort->language)) selected @endif @endif data-name="{{ $language }}">{{ $language }}</option>@endforeach
                                </select>
                            </div>
                            @if(!empty($escort->language)) @foreach($escort->language as $language)
                            <div class='selecated_languages select_lang'>
                                <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.languages.$language") !!}</span>
                                <input class="lang" type="hidden" name="language[]" value="{{$language}}">
                            </div>
                            @endforeach @endif
                            <div id="container_language">
                            </div>
                            <div id="show_language" style="display:none">
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Travel:</label>
                            <div class="col-sm-8">
                                <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Travel" name="travel">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.travels') as $key => $travel)
                                    <option value='{{ $key}}' {{ ($escort->travel == $key) ? 'selected' : ''}}>{{ $travel }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Tattoos:</label>
                            <div class="col-sm-8">
                                <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Tattoos" name="tattoos">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.tattooes') as $key => $tattoos)
                                    <option value='{{ $key}}' {{ ($escort->tattoos == $key) ? 'selected' : ''}}>{{ $tattoos }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Smoke:</label>
                            <div class="col-sm-8">
                                <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Smoke" name="smoke">
                                    <option value="" selected disabled>-Not Set-</option>
                                    @foreach(config('escorts.profile.smokes') as $key => $smoke)
                                    <option value='{{ $key}}' {{ ($escort->smoke == $key) ? 'selected' : ''}}>{{ $smoke }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Available to:</label>
                            <div class="col-sm-8">
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
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">SWA License:</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{ $escort->license}}" name="license" class="form-control form-control-sm select_tag_remove_box_sadow" id="" @if($user->state_id == 3903) required data-parsley-group="goup_one" @endif>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Play types:</label>
                            <div class="col-sm-8">
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
                            <div id="show_playType" style="display:block">
                                @isset($escort->play_type)
                                @foreach($escort->play_type as $play_type)
                                <div class='selecated_languages playT' style='display: inline-block' id="{{$play_type}}"><span class='languages_choosed_from_drop_down'>{{ config('escorts.profile.play-types')["$play_type"] }} </span> </div>
                                @endforeach
                                @endisset
                            </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Payment:</label>
                            <div class="col-sm-8">
                                <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="payment" name="payment_type">
                                    <option value="" selected disabled>-Not Set-</option>
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
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="read-more" type="button" class="save_profile_btn">Update</button>

                    </div>
                </div>
            {{-- </form> --}}
        </div>



                        <div class="border_covid covid_heading mt-2">
                            <h2>COVID -19</h2>
                        </div>
                        <div class="pt-2 pb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input covidreport" type="radio" name="covidreport" id="inlineRadio1" value="1"{{ $escort->covidreport == 1 ? ' checked' : null }}>
                                <label class="form-check-label" for="inlineRadio1">Vaccinated, not up to date</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input covidreport" type="radio" name="covidreport" id="inlineRadio1" value="2"{{ $escort->covidreport == 2 ? ' checked' : null }}>
                                <label class="form-check-label" for="inlineRadio1">Vaccinated, up to date</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input covidreport" type="radio" name="covidreport" id="inlineRadio1" value="3"{{ $escort->covidreport == 3 ? ' checked' : null }}>
                                <label class="form-check-label" for="inlineRadio1">Not Vaccinated</label>
                            </div>
                        </div>
                        {{--<div class="add_banner_or_image_bg pt-2 mb-4" @if(!in_array($escort->covidreport, [1,2])) style="display: none" @endif id="covid-file-block">--}}
                        {{--
                        <div class="add_banner_or_image_bg pt-2 mb-4" style="display: none" id="covid-file-block">
                            <div class="row">
                                <div class="col manage_upload_btn">
                                    <div class="banner_reco_font">
                                        <label for="file-upload" class="custom-file-upload">
                                        <i class="fas fa-plus-circle"></i>
                                        </label>
                                        <input id="file-upload" type="file" name="covid_report_file">
                                        <p>Upload Vaccination Passport / Certificate</p>
                                        <p class="site_red_color text-center">No file Selected</p>
                                        <img id="covid-image-preview" src="/{{ $escort->covidReport ? $escort->covidReport->path : null }}" class="attach-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right" style="padding-right: 1.8rem;">
                        <button type="button" id="update-about-me" class="save_profile_btn">Update</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- </form> --}}

    <div class="about_me_drop_down_info profile-sec pl-4 pr-4 p-2 pt-4">
        <div class="about_me_heading_in_first_tab fill_profile_headings_global text-capitalize">
            <h2>Who am I ?</h2>
        </div>
        <div class="padding_20_all_side">
            <input type="text" name="about_title" value="{{$escort->about_title ? $escort->about_title : null }}" class="whoiamtitle mb-3" placeholder="Enter Your Title Here">
            {{-- <form id="update_abut_who_am_i" action="{{ route('escort.about',[$escort->id])}}" method="POST">
                @csrf --}}
                <div class="row">
                    <div class="col-12">
                        <textarea id="editor1" name="about" data-parsley-maxlength="257" data-parsley-maxlength-message="You can't enter more than 250 characters .." data-parsley-group="ckeditor">@if(!empty($escort->about)) {{ $escort->about}} @endif</textarea>
                        <span class="theme-text-color text-capitalize">max limit 250 chracters</span>
                    </div>

                </div>

                <div class="row pt-3">
                    <div class="col-md-12 text-right" style="padding-right: 1.8rem;">
                        <button id="update_who_am_i" type="button" class="save_profile_btn who_am_i">Update</button>
                    </div>
                </div>
            {{-- </form> --}}
        </div>
    </div>
    <div class="tab_btm_btns_preview_and_next pb-2">
        <div class="row pt-3 pb-2">
            <div class="col-md-12 text-right mb-2 a_text_white_hover">
                <a href="{{ route('profile.description',$escort->id ? $escort->id : '' )}}" class="save_profile_btn" >Preview</a>
                <a href="#services" class="nex_sterp_btn " id="profile-tab" data-toggle="tab" href="#services" role="tab" aria-controls="profile" aria-selected="false">Next Step
                <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="upload-sec" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Manage Photos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/cross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container p-0">
                                <div class="row pr-2">
                                    <div class="col-4">
                                        <div class="plate"><label class="newbtn">
                                            <img id="blah1" class="img-fluid" src="{{ asset($escort->imagefrontPosition(1))}}" style="width: 300px;height: 308px;object-fit: cover;">
                                            <input name="img[1]" id="pic1" data-id="1" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                            <input type="hidden" name="position[]" id="mediaId1">
                                            </label>
                                        </div>
                                    </div>
                                    {{-- <div class="col-8 pl-0">
                                        <div class="row" style="">
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah2" class="img-fluid modal-image_2" src="{{ asset('assets/app/img/upload-manage-1.png') }}">
                                                    <input name="img[2]" id="pic2" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="2">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah3" class="img-fluid modal-image_2" src="{{ asset('assets/app/img/upload-manage-1.png') }}">
                                                    <input name="img[3]" id="pic3" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="3">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah4" class="img-fluid modal-image_2" src="{{ asset('assets/app/img/upload-manage-1.png') }}">
                                                    <input name="img[4]" id="pic4" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="4">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="">
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah5" class="img-fluid modal-image_2" src="{{ asset('assets/app/img/upload-manage-1.png') }}">
                                                    <input name="img[5]" id="pic5" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="5">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah6" class="img-fluid modal-image_2" src="{{ asset('assets/app/img/upload-manage-1.png') }}">
                                                    <input name="img[6]" id="pic6" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="6">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah7" class="img-fluid modal-image_2" src="{{ asset('assets/app/img/upload-manage-1.png') }}">
                                                    <input name="img[7]" id="pic7" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="7">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-8 pl-0">
                                        <div class="row" style="">
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah2" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(2))   }}">
                                                    <input name="img[2]" id="pic2" data-id="2" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[]" id="mediaId2">
                                                </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah3" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(3))   }}">
                                                    <input name="img[3]" id="pic3" data-id="3" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[]" id="mediaId3">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah4" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(4))   }}">
                                                    <input name="img[4]" id="pic4" data-id="4" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[]" id="mediaId4">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="">
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah5" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(5))   }}">
                                                    <input name="img[5]" id="pic5" data-id="5" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[]" id="mediaId5">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah6" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(6))   }}">
                                                    <input name="img[6]" id="pic6" data-id="6" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[]" id="mediaId6">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah7" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(7)) }}">
                                                    <input name="img[7]" id="pic7" data-id="7" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[]" id="mediaId7">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row pr-2 pt-2">
                                    <div class="col-12 pr-0">
                                        <div class="plate">
                                            <label class="newbtn">

                                            {{-- <img id="blahx" class="img-fluid" style="width:870px; height:147px;object-fit: cover;"src="{{ asset($escort->imagefrontPosition(10)) }}"> --}}
                                            <input name="img[11]" id="picx" class="pis" onchange="readURL(this);" type="file" accept="video/*">

                                            <video class="img-fluid" id="blahx" controls="" src="" style="width:870px; height:147px;object-fit: cover;">
                                                <source id="akhVideo" src="" type="video/mp4" >
                                            </video>
                                            <input type="hidden" name="position[]" id="mediaIdx">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 pt-1" style="border: 1px dotted;">
                                    <div class="col-6 pt-4 pb-4">
                                            <h4>Verify these Photos</h4>

                                            <ul style="text-align: justify;">
                                              <li>Two (2) selfies with your User Name and Membership ID printed (can be handwritten) on a sheet of paper held up to the side of you and not obscuring any part of you</li>
                                              <li>A drivers licence which matches your User Name and Home State</li>
                                              <li>A passport which matches your User Name and Home State</li>
                                            </ul>
                                        </div>
                                    <div class="col-6 pt-4">
                                        <div class="plate" style="position: relative;top: 25%;"><label class="newbtn">
                                            {{-- <img class="img-fluid" id="blah8" src="{{ asset('assets/app/img/upload-6.png')}}" style="height: 138px;object-fit: cover;width: 370px;"> --}}
                                            <img class="img-fluid cl_blash8" id="blah8" src="{{ asset($escort->imagefrontPosition(8))}}" style="height: 138px;object-fit: cover;width: 370px;">
                                            <input id="pic8" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                            <input type="hidden" name="position[]" id="mediaId8">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="defaultImg">Use Default</button>
                    <button type="button" class="btn btn-primary" id="manageImgId">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="upload-sec-banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Manage Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/cross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="plate"><label class="newbtn">
                                        <img id="blah9" class="img-fluid" src="{{ asset($escort->imagefrontPosition(9))}}" style="height: 118px;object-fit: cover;width: 618px;">
                                        {{-- <img id="blah9" class="img-fluid" src="{{ asset('assets/app/img/upload-3.png')}}" style="height: 118px;object-fit: cover;width: 618px;"> --}}
                                        <input name="img[9]" id="pic9" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                        <input type="hidden" name="position[]" id="mediaId9">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3" style="border: 1px dotted;">
                                <div class="col-6 pt-4 pb-4">
                                    <h4>Verify these photos</h4>
                                    <p>Upload a picture of your ID with your most recent photo for verification.</p>
                                </div>
                                <div class="col-6">
                                    <div class="plate"><label class="newbtn">
                                        <img class="img-fluid cl_blash8" id="blah8" src="{{ asset($escort->imagefrontPosition(8))}}" style="height: 138px;object-fit: cover;width: 291px;">
                                        {{-- <img class="img-fluid" id="blah0" src="{{ asset('assets/app/img/upload-6.png')}}" style="height: 138px;object-fit: cover;width: 291px;"> --}}
                                        <input name="img[8]" id="pic8" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                        <input type="hidden" name="position[]" id="mediaId8">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="defaultImg2">Use Default</button>
                <button type="button" class="btn btn-primary" id="manageImgId">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    // $('.newbtn').bind("click" , function () {
    //        $('#pic').click();
    //        console.log($(this).attr('id'));
    // });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //console.log(reader);
            var imgbytes = input.files[0].size;
            var imgkbytes = Math.round(parseInt(imgbytes)/1024);
            var imgMB = Math.round(parseInt(imgkbytes)/1024);
            if(imgMB <= 2 ) {
                 reader.onload = function (e) {
                $('#blah'+input.id[3])
                    .attr('src', e.target.result);

                };
            } else {
                //alert("file size in MB = "+imgMB);
                $('.comman_msg').html("Can't upload more than 2 MB size");
                $("#comman_modal").modal('show');
            }


            reader.readAsDataURL(input.files[0]);
            console.log("img = "+input.id[3]);


            console.log("sizeKB = "+imgkbytes);


        }
        $("body").on('click','#manageImgId',function(e){
            var src = $("#blah"+input.id[3]).attr('src');
            $('#img'+input.id[3])
                    .attr('src', src);
            $("#upload-sec").modal('hide');
            console.log("file = "+input.id[3]);
            //console.log("src = "+src);
        })

    }
</script>
<style>
    .pis{
    display: none;
    }
    .newbtn{
    cursor: pointer;
    }
</style>
