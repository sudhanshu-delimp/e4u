<style type="text/css">
    span.select2.select2-container.select2-container--default {
    width: 100% !important;
    }
    .select2-container--default .select2-selection--single{
    border: 1px solid #d1d3e2;
    }
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto auto auto;
        gap: 10px;
    }
    .grid-container > div {
        background-color: rgba(255, 255, 255, 0.8);
    }
    .modalPopup > .item4 {
        cursor: pointer;
    }
    .modalPopup > .item2 {
        cursor: pointer;
    }
</style>

@php
    /*$positionImages = [];
    foreach ($defaultImages as $image) {
        $positionImages[$image['position']] = $image;
    }*/
    /*$mediaLinks = $media->pluck('path', 'id');
    $imagesToDisplay = [];
    $positions = [1,2,3,4,5,6,7,9];
    foreach($positions as $position) {
        if(isset($mediaLinks[$position]) && $mediaLinks[$position]) {
            $imagesToDisplay[$position] = $mediaLinks[$position];
        } else {
            $imagesToDisplay[$position] = $positionImages[$position]->path;
        }
    }*/
@endphp
<div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
    {{-- <form id="update_about_me" action="{{ route('escort.about.me',[$escort->id])}}" method="POST" enctype="multipart/form-data">
        @csrf   --}}
        <div class="row pl-3">
        <div class="col-lg-3">
            <div class="member-id pl-0 pb-2 pt-3">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0" />
                </svg>
                <span>Member ID: {{auth()->user()->member_id}}</span>

                {{-- @if(!empty($escort->available_to)) @if(in_array($key , $escort->available_to)) checked @endif @endif --}}
            </div>
        </div>
        <div class="col-lg-6">

            <div class="member-id pl-0 pb-2 pt-3">

{{--                <span>Save as Draft : </span><input type="checkbox" class="form-check-input draft mt-0" id="draftId" name="draft" @if(!empty($escort->enabled)) @if($escort->enabled == 2)) checked @endif @endif>--}}

                {{-- @if(!empty($escort->available_to)) @if(in_array($key , $escort->available_to)) checked @endif @endif --}}
            </div>
        </div>
    </div>
<div class="about_me_drop_down_info profile-sec">
{{--            <div class="row tab-input- pl-2 pt-4">--}}
{{--                <div class="col-lg-3 col-md-12 col-sm-12">--}}
{{--                    <div class="form-group row tab-about-me-row-padding">--}}
{{--                        <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">--}}
{{--                            Profile Name:</label>--}}
{{--                        <div class="col-sm-7">--}}
{{--                            <input type="text" placeholder="Melbourne" value="{{ $escort->profile_name}}" name="profile_name"--}}
{{--                                   class="form-control form-control-sm select_tag_remove_box_sadow" id="profile_name"--}}
{{--                                   required="" data-parsley-required-message="Enter profile name" data-parsley-group="goup_one">--}}
{{--        --}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-12 col-sm-12">--}}
{{--                    <div class="form-group row tab-about-me-row-padding saveDraft">--}}
{{--                        <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Profile start date:</label>--}}
{{--                        <div class="col-sm-7 pl-0">--}}
{{--                            <input type="date" name="start_date"--}}
{{--                                   class="form-control form-control-sm select_tag_remove_box_sadow"--}}
{{--                                   value="{{ $escort->start_date ? date('Y-m-d',strtotime($escort->start_date)) : ''}}"--}}
{{--                                   id="start_date" onkeydown="return false" required=""--}}
{{--                                   data-parsley-required-message="-select date-" data-parsley-group="goup_one">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-12 col-sm-12">--}}
{{--                    <div class="form-group row tab-about-me-row-padding saveDraft">--}}
{{--                        <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Profile end date:</label>--}}
{{--                        <div class="col-sm-7 pl-0">--}}
{{--                            <input type="date" name="end_date" class="form-control form-control-sm select_tag_remove_box_sadow"--}}
{{--                                   value="{{ $escort->end_date ? date('Y-m-d',strtotime($escort->end_date)) : ''}}"--}}
{{--                                   id="end_date" onkeydown="return false" required=""--}}
{{--                                   data-parsley-required-message="-select date-" data-parsley-group="goup_one">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-12 col-sm-12">--}}
{{--                    <div class="form-group row tab-about-me-row-padding saveDraft">--}}
{{--                        <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Membership Type:</label>--}}
{{--                        <div class="col-sm-7">--}}
{{--                            <select name="membership" id="membership" required--}}
{{--                                    data-parsley-required-message="-select membership-" data-parsley-group="goup_one"--}}
{{--                                    style="width: 100%;">--}}
{{--                                --}}{{-- <option value="" selected="">-Not Set-</option> --}}
{{--                                <option value="1" {{($escort->membership == 1) ? 'selected' : ''}}>Platinum</option>--}}
{{--                                <option value="2" {{($escort->membership == 2) ? 'selected' : ''}}>Gold</option>--}}
{{--                                <option value="3" {{($escort->membership == 3) ? 'selected' : ''}}>Silver</option>--}}
{{--                                <option value="4" {{($escort->membership == 4) ? 'selected' : ''}}>Free</option>--}}
{{--                            </select>--}}
{{--        --}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>

        <div class="about_me_drop_down_info profile-sec">
            <div class="row">
                <div class="col-md-12" style="border-right: 10px solid #eee;">
                    <div class="col-lg-12  padding_20_all_side p-2 pb-2">
                        <div class="border_covid covid_heading  ">
                            <h2>Location Information</h2>
                        </div>
                        <div class="">
                            {{--<div class="col-lg-8 pl-1">
                                <div class="about-me-box-one-name stage_name pt-3" style={{ $escort->name ? '' : "color:#9A9B9C;" }} title="Todo:: This is where we display stage name while editing profile, I think we should add an input for stage name while creating (can't a stage name is editable)">
                                {{$escort->name ? $escort->name  : 'Stage Name'}}
                            </div>--}}



                            <div class="col-lg-12 pl-1 pt-4">
                                <div class="form-group row tab-about-me-row-padding">
                                    <label class="col-sm-2 font-weight-500 small-icon" for="profile_name">
                                        Profile Name:
                                        <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="Be consistent when naming your Profiles, like Sydney01, Sydney 02, Perth01, Perth02 etc." data-boundary="window">
                                        <span style='color:red'>*</span>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{ $escort->profile_name}}" title="(your use only)"  name="profile_name" class="form-control form-control-sm select_tag_remove_box_sadow" id="profile_name" required="required" data-parsley-required-message="Enter profile name" data-parsley-group="goup_one" placeholder="Enter your Profile Name (your internal reference)" data-parsley-errors-container="#profile_name-errors">
                                    </div>
                                    <div class="col-sm-4">
                                        <span id="profile_name-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row tab-about-me-row-padding">
                                    <label class="col-sm-2 font-weight-500" for="stageName">Stage Name:<span style='color:red'>*</span></label>
                                    <div class="col-sm-6">
                                        @if( !empty($user->profile_creator) && in_array(1,$user->profile_creator))
                                            <select onclick="stageNameInput(this)" class="form-control form-control-sm select_tag_remove_box_sadow" title="(for public display)" id="stageName" name="name" required="required" data-parsley-required-message="Select stage name" data-parsley-group="goup_one" data-parsley-errors-container="#stageName-errors">
                                                <option value="" selected>-Choose Your Stage Name-</option>
                                                {{-- <option value="" selected disabled>-Not Set-</option> --}}
                                                @if(!empty(auth()->user()->escorts_names))
                                                    @foreach(auth()->user()->escorts_names as $key => $name)
                                                        <option value='{{ $name}}' {{ ($escort->name == $name)? 'selected' : ''}}>{{ $name}}</option>
                                                    @endforeach
                                                @endif
                                                <option value="new">Add a new Stage Name</option>
                                            </select>
                                            <input type="hidden" id="stageNameInp" required="required" name="" title="(for public display)" class="form-control form-control-sm select_tag_remove_box_sadow" data-parsley-required-message="Enter stage name" data-parsley-group="goup_one" placeholder="Choose your Stage Name (for public display)"  data-parsley-errors-container="#stageName-errors">
                                        @else
                                            <input type="text" id="stageName" required="required" name="name" title="(for public display)" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{$escort->name ? $escort->name : '' }}" data-parsley-required-message="Enter stage name" data-parsley-group="goup_one" placeholder="Choose your Stage Name (for public display)" data-parsley-errors-container="#stageName-errors">
                                        @endif
                                    </div>
                                    <div class="col-sm-4">
                                        <span id="stageName-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row tab-about-me-row-padding">
                                    <label class="col-sm-2 font-weight-500 small-icon" for="state_id">
                                        Location:
                                        <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="This is the Location you want the Profile to be saved to, like Western Australia, Victoria etc. Make sure the Profile Name matches up." data-boundary="window">
                                    </label>
                                    <div class="col-sm-6">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow" id="state_id" name="state_id" required="required" data-parsley-required-message="-select location-" data-parsley-group="goup_one" data-parsley-errors-container="#locationState-errors">
                                            {{-- <required data-parsley-required-message="-select city-" data-parsley-group="goup_one"> --}}
                                            <option value="" selected="">-- Select States--</option>
                                            @foreach(config('escorts.profile.states') as $key => $state)
                                                <option style="font-weight: 500;" value="{{$key}}"
                                                @if($escort->state_id != null)
                                                    {{ $escort->state_id != null && $escort->state_id == $key ? 'selected' : '' }}
                                                    @else
                                                    {{ auth()->user()->state_id == $key ? 'selected' : '' }}
                                                    @endif
                                                > {{$state['stateName']}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <span id="state_id-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row tab-about-me-row-padding">
                                    <label class="col-sm-2 font-weight-500" for="profile_name">City: <span style='color:red'>*</span></label>
                                    <div class="col-sm-6">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow" id="city_id" name="city_id" required="required" data-parsley-required-message="-select city-" data-parsley-group="goup_one" data-parsley-errors-container="#locationName-errors">
                                            {{-- <required data-parsley-required-message="-select city-" data-parsley-group="goup_one"> --}}
                                            {{-- <option value="" selected="">-- Select cites--</option> --}}
                                            @if($escort->city_id)
                                                <option id="{{$escort->city_id}}" value="{{$escort->city_id}}" selected>{{$escort->city->name}}</option>
                                            @else

                                                @foreach(config('escorts.profile.states')[auth()->user()->state_id]['cities'] as $key =>$city)
                                                    <option id="{{$key}}" value="{{$key}}"  selected >{{$city['cityName']}}</option>
                                                @endforeach



                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <span id="city_id-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row tab-about-me-row-padding">
                                    <label class="col-sm-2 font-weight-500 small-icon" for="address">
                                        Street Address:
                                        <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="Include your street address (no street number) to help Viewers know where you are staying." data-boundary="window">
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{ $escort->address}}" name="address" placeholder="Street Address" class="form-control form-control-sm select_tag_remove_box_sadow" id="address">
                                    </div>
                                    <div class="col-sm-4">
                                        <span id="address-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row tab-about-me-row-padding">
                                    <label class="col-sm-2 font-weight-500" for="phone">Mobile: <span style='color:red'>*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" id="phone" required name="phone" class="form-control form-control-sm select_tag_remove_box_sadow mt-2" value="{{$escort->phone ? $escort->phone : auth()->user()->phone  }}" placeholder="Mobile Number"  data-parsley-required-message="Enter mobile number" data-parsley-group="goup_one"  data-parsley-errors-container="#mobile-errors">
                                    </div>
                                    <div class="col-sm-4">
                                        <span id="phone-errors"></span>
                                    </div>
                                </div>
                            </div>


                                {{--<div class="about-me-box-one-number mobile_num" style={{ $escort->city ? '' : "color:#C4C4C4;" }}>
                                    {{ $escort->city ? $escort->city->name : "Location -"}}{{$escort->phone ? ' - '.$escort->phone : auth()->user()->phone}}

                                </div>--}}
                                {{-- {{  dd(config('escorts.profile.states')[3910]['cities']) }} --}}

                                {{--<div class="about-me-box-one-map add_class" style={{ $escort->
                                    state ? '' : "color:#C4C4C4;" }}>
                                    --}}{{-- @php //if($escort->address || $escort->state || $escort->pincode) { @endphp --}}{{--
                                    <svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F" />
                                    </svg>
                                    --}}{{-- @php  } @endphp --}}{{--
                                    {{ $escort->address ? $escort->address.',' : "Address" }} {{ $escort->state ? $escort->state->name : null }} {{ $escort->pincode }}
                                </div>--}}


                                {{--<div class="mt-5"   style="display: block">
                                    <input type="checkbox" class="form-controll" value="Y" id="playmate" name="playmate" @php echo (($escort->playmate == 'Y') ? "checked" : '' ) @endphp/> <label for="playmate" style="display: inline;">I am available as a playmate</label>
                                </div>--}}

                                {{--<div class="about-md-box-social">
                                    @if(!empty($escort->social_links))
                                        @foreach($escort->social_links as $key=>$val)
                                        <a href="{{ $val }}">
                                            <img src="{{ asset('assets/dashboard/img/'.$key.'.svg') }}"/>
                                        </a>
                                        @endforeach
                                    @endif
                                </div>--}}
                            {{--<div class="col-lg-4">
                                <div class="pull-right pt-5" style="text-align: end;">
                                    <a href="#" id="new_saveProfilename">
                                        <span class="pr-2">Edit</span>
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.5325 3.77992C13.825 3.48742 13.825 2.99992 13.5325 2.72242L11.7775 0.967422C11.5 0.674922 11.0125 0.674922 10.72 0.967422L9.34 2.33992L12.1525 5.15242L13.5325 3.77992ZM0.25 11.4374V14.2499H3.0625L11.3575 5.94742L8.545 3.13492L0.25 11.4374Z" fill="#90A0B7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>--}}
                            {{--<div class="col-lg-12 pt-5 p-0 pb-3">
                                <div class="plate">
                                    <label class="newbtn p-0 m-0 d-flex">
                                    --}}{{-- <img id="blah1" class="img-fluid" src="{{ asset('assets/app/img/new-upload.png')}}" style="width: 100%;object-fit: cover;height: 188px;"> --}}{{--
                                    --}}{{-- <input name="img[10]" id="imgx" class="pis" onchange="readURL(this);" type="file"> --}}{{--
                                    <input type="hidden" name="position[]" value="1">

                                    --}}{{--<video poster="{{ asset('assets/app/img/video-play-button.jpg') }}" controls="" style="background: #0000006b;width: 520px;height: 190px;object-fit: cover;" id="akhVideo">
                                    <source id="imgx" src="{{ asset('assets/app/img/mov_bbb.mp4') }}" type="video/mp4">
                                    </video>--}}{{--

                                    <!-- <video width="100%" height="240" controls>
                                    <source id="imgx" src="{{ asset($escort->imagePosition(10)) }}" type="video/mp4">
                                        <source id="imgx" src="{{ asset($escort->imagePosition(10)) }}" type="video/mp4">
                                    </video> -->
                                </div>
                            </div>--}}
                            @if(request()->segment(2) == 'profile' && request()->segment(3))
                            <div class="col-md-12 text-right">
                                <button id="location-info" type="button" class="save_profile_btn">Update</button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about_me_drop_down_info profile-sec">
            <div class="row">
                <div class="col-md-12" style="border-right: 10px solid #eee;">
                    <div class="col-lg-12  padding_20_all_side p-2 pb-2">
                        <div class="border_covid covid_heading  ">
                            <h2>Media
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="You can move your photos into any order you like by picking up and dropping into the preferred position." data-boundary="window">
{{--                                <span style='color:red'>*</span>--}}
                            </h2>
                        </div>
                        <div class="col-lg-8 pl-1">
                            <div class="row pt-3">
                                <div class="col-4 pr-0 ">
                                    <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(1)">
                                            {{-- <img class="img-fluid modal-image-first" id="img1" src="{{ asset('assets/app/img/upload-1.png')}}" style="height: 284px;object-fit: cover;"> --}}

                                            <img class="img-fluid upld-img" id="img1" src="{{asset($escort->imagePosition(1))}}" style="height: 220px;object-fit: cover;width: 167px;">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row" style="">
                                        <div class="col-4 pr-0">
                                            <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(2)">
                                                    <img class="img-fluid upld-img" id="img2" src="{{asset($escort->imagePosition(2))}}">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4 pr-0">
                                            <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(3)">
                                                    <img class="img-fluid upld-img" id="img3" src="{{asset($escort->imagePosition(3))}}">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4 pr-0">
                                            <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(4)">
                                                    <img class="img-fluid upld-img" id="img4" src="{{asset($escort->imagePosition(4))}}">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="">
                                        <div class="col-4 pr-0">
                                            <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(5)">
                                                    <img class="img-fluid upld-img" id="img5" src="{{asset($escort->imagePosition(5))}}">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4 pr-0">
                                            <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(6)">
                                                    <img class="img-fluid upld-img" id="img6" src="{{asset($escort->imagePosition(6))}}">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4 pr-0">
                                            <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(7)">
                                                    <img class="img-fluid upld-img" id="img7" src="{{asset($escort->imagePosition(7))}}">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="about_me_drop_down_info add_banner_pic pb-0">
                                    <label class="newbtn" data-toggle="modal" data-target="#photo_gallery_banner" onclick="positionToUpdate(9)">
                                        <img class="img-fluid"  id="img9" src="{{asset($escort->imagePosition(9))}}" style="height: 167.578px;width: 1066.640px;object-fit: cover;">
                                    </label>
                                </div>
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
                        {{--<div>
                            <div class="border_covid covid_heading ">
                                <h2>Playmates</h2>
                            </div>
                            <div class="card-body pb-0">
                                <div class="card-body border-0 pt-0 mt-2">
                                    <form class="at-sec" method="post" action="" id="playmate_search" style="display: none;">
                                        <div class="at-lable">
                                            <label for="Student">Search for playmate</label>
                                            <input  name="q" placeholder="Search by name / Member ID" autocomplete="off" class="" id="search-playmate-input">
                                            <input type="hidden" name="h_escort_id" id="h_escort_id" value="{{auth()->user()->id}}">
                                            <ul class="results showPlaymates">
                                                --}}{{-- {{ dd(auth()->user()->playmates()->pluck('playmate_id'))}} --}}{{--
                                                @foreach($users_for_available_playmate as $allUser)
                                                    @if(!is_null($allUser->escorts))
                                                        @foreach($allUser->escorts as $escort)
                                                            @if(!in_array($escort->id,auth()->user()->playmates()->pluck('playmate_id')->toArray()))
                                                                @if($escort->membership != null && $escort->start_date != null)
                                                                    --}}{{-- @if($escort->membership == 4 && Carbon\Carbon::parse($escort->start_date)->diffInDays(Carbon\Carbon::parse(now())) <= 14) --}}{{--
                                                                    --}}{{-- {{ dd($escort->DefaultImage )}} --}}{{--
                                                                    <li  id="list_{{$escort->id}}">

                                                                        <img src="{{ $escort->DefaultImage }}" class="img-profile rounded-circle playmats-img " >
                                                                        {{ $escort->name }}
                                                                        <span class="playmates_id" value="{{$escort->id}}" data-path="{{$escort->DefaultImage}}" data-name="{{$escort->name}}">Add</span>
                                                                        --}}{{-- <span>{{Carbon\Carbon::parse($escort->start_date)->format('d/m/Y')}}</span>
                                                                        <span>{{Carbon\Carbon::now()->format('d/m/Y')}}</span> --}}{{--

                                                                    </li>
                                                                    --}}{{-- @endif  --}}{{--
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                --}}{{-- @foreach($allEscorts as $escort)
                                                <li>

                                                   <img src="{{ $escort->default_image }}" class="img-profile rounded-circle playmats-img" >
                                                   {{ $escort->name }} <span class="playmates_id2" value="{{$escort->id}}">Add</span>

                                                </li>
                                                @endforeach --}}{{--
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>--}}





                        <div class="border_covid covid_heading ">
                            <h2>About Me</h2>
                        </div>

                        <div class="card-body pb-0">
                            <div class="tab-pane fade show active" id="aboutme" role="tabpanel"
                                 aria-labelledby="home-tab">
                                <!-- upload video  -->
                                <div class="about_me_drop_down_info ">
                                    <div class="padding_20_all_side pb-0">
                                        <!--New Row from here-->
                                        @php

                                            $escort->gender ? $escortGender = $escort->getRawOriginal('gender') : $escortGender = auth()->user()->gender;
                                            // dd($escort);
                                            // if(empty($escort->gender)){
                                            //     $escortGender = auth()->user()->gender;
                                            // }
                                        @endphp
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">
                                                        Gender:<span style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="Gender" name="gender" required
                                                            data-parsley-group="goup_one">

                                                            <option value='' selected>-Not Set-</option>
                                                            @foreach(config('escorts.profile.genders') as $key => $gender)
                                                                <option
                                                                    value="{{ $key }}" {{ ($escortGender == $key) ? 'selected' : ''}}>{{$gender}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Orientation:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="Orientation" name="orientation">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.orientation') as $key => $orientate)
                                                                <option
                                                                    value='{{ $key}}' {{ ($escort->orientation == $key) ? 'selected' : ''}}>{{ $orientate}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Ethnicity</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="Ethnicity" name="ethnicity">
                                                            <option value="">-Not Set-</option>
                                                            @foreach(config('escorts.profile.ethnicities') as $key => $ethnicity)
                                                                <option
                                                                    value="{{ $key }}" {{ ($escort->ethnicity == $key) ? 'selected' : ''}}>{{ $ethnicity }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Nationality:</label>
                                                    <div class="col-sm-8">
                                                        <select style="border: 1px solid #d5d7e5 !important;"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow nationality-sec"
                                                                id="select2-dropdown"
                                                                data-parsley-required-message="Select nationality"
                                                                name="nationality_id"
                                                                data-parsley-errors-container="#nationality-errors">
                                                            <option
                                                                value="{{ old('nationality_id',$escort->nationality_id)}}">{{($escort->nation) ? $escort->nation->name : ''}}</option>
                                                        </select>
                                                        <span id="nationality-errors"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">
                                                        Age:<span style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input data-parsley-type="digits"
                                                               class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                               id="age" required="" name="age" value="{{$escort->age}}"
                                                               data-parsley-min="18" data-parsley-max="70"
                                                               data-parsley-group="goup_one">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Body type:
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="Body type" name="body_type">
                                                            <option value="" selected="" disabled="">-Not Set-</option>
                                                            @foreach(config('escorts.profile.body-type') as $key => $body_type)
                                                                <option
                                                                    value='{{ $key}}' {{ ($escort->body_type == $key) ? 'selected' : ''}}>{{ $body_type}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-5 font-weight-500"
                                                           for="exampleFormControlSelect1" style="font-size: 18px;
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
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Hair colour:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="Hair colour" name="hair_color">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.hair-colour') as $key => $colour)
                                                                <option
                                                                    value='{{ $key}}' {{ ($escort->hair_color == $key) ? 'selected' : ''}}>{{ $colour}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Hair style:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="Hair style" name="hair_style">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.hair-style') as $key => $hair_style)
                                                                <option
                                                                    value='{{ $key}}' {{ ($escort->hair_style == $key) ? 'selected' : ''}}>{{ $hair_style }}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Height:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            name="height" id="Height">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.heights') as $key => $height)
                                                                <option
                                                                    value="{{ $key }}" {{ ($escort->height == $key) ? 'selected' : ''}}>{{ $height}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1"> Eyes:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            name="eyes" id="Eyes">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.eye-colors') as $key => $color)
                                                                <option
                                                                    value="{{ $key }}" {{ ($escort->eyes == $key) ? 'selected' : ''}}>{{ $color}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Skin tone:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="Skin tone" name="skin_tone">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.skin-tone') as $key => $colour)
                                                                <option
                                                                    value='{{ $key}}' {{ ($escort->skin_tone == $key) ? 'selected' : ''}}>{{ $colour}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Weight(Kgs):</label>
                                                    <div class="col-sm-8">
                                                        <input data-parsley-type="digits"
                                                               class="form-control form-control-sm  removebox_shdow"
                                                               placeholder="Enter Your Weight"
                                                               value="{{$escort->weight}}" name="weight"
                                                               data-parsley-min="30" data-parsley-max="150"
                                                               vlaue="{{ $escort->weight}}" id="Weight">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Shaved:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            name="shaved" id="Shaved">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.shaved-type') as $key => $type)
                                                                <option
                                                                    value='{{ $key}}' {{ ($escort->shaved == $key) ? 'selected' : ''}}>{{ $type}}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

{{--                                            @if(in_array($escortGender, [6,2,3]))--}}
                                            <div class="col-lg-4 col-md-12 col-sm-12 femaleFields">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Breast:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="Breast" name="breast">
                                                            <option value="" selected disabled>-Not Set-</option>
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
                                            <div class="col-lg-4 col-md-12 col-sm-12 femaleFields">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Dress size:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="Dress size" name="dress_size">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.dress-size') as $key => $dress_size)
                                                                <option
                                                                    value='{{ $key}}' {{ ($escort->dress_size == $key) ? 'selected' : ''}}>{{ $dress_size }}</option>@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endif--}}
{{--                                            @if(in_array($escortGender, [1,2,3]))--}}
                                            <div class="col-lg-4 col-md-12 col-sm-12 maleFields">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Endowment:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="endowment" name="endowment">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.endowments') as $key => $endowment)
                                                                <option value='{{ $key}}' {{ ($escort->endowment == $key) ? 'selected' : ''}}>{{ $endowment }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 maleFields">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Thickness:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="thickness" name="thickness">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.thicknesses') as $key => $thickness)
                                                                <option value='{{ $key}}' {{ ($escort->thickness == $key) ? 'selected' : ''}}>{{ $thickness }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 maleFields">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Circumcised:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="circumcised" name="circumcised">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.circumcises') as $key => $circumcised)
                                                                <option value='{{ $key}}' {{ ($escort->circumcised == $key) ? 'selected' : ''}}>{{ $circumcised }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 maleFields">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Butt:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="butt" name="butt">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.butts') as $key => $butt)
                                                                <option value='{{ $key}}' {{ ($escort->butt == $key) ? 'selected' : ''}}>{{ $butt }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 maleFields">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Preference:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="preference" name="preference">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.preferences') as $key => $preference)
                                                                <option value='{{ $key}}' {{ ($escort->preference == $key) ? 'selected' : ''}}>{{ $preference }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endif--}}
                                        </div>
                                        <div class="row">
{{--                                            @if(in_array($escortGender, [1,2,3]))--}}
                                            <div class="col-lg-4 col-md-12 col-sm-12 maleFields">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Hormones:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="hormones" name="hormones">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.hormones') as $key => $hormone)
                                                                <option value='{{ $key}}' {{ ($escort->hormones == $key) ? 'selected' : ''}}>{{ $hormone }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endif--}}
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Contact me:</label>
                                                    <div class="col-sm-8">
                                                        <select
                                                            class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                            id="Contact me" name="contact">
                                                            <option value="" selected disabled>-Not Set-</option>
                                                            @foreach(config('escorts.profile.contact-me') as $key => $contact)
                                                                <option
                                                                    value='{{ $key}}' {{ ($escort->contact == $key) ? 'selected' : ''}}>{{ $contact}}</option>@endforeach
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
                            <h2>Read more
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="This section will only appear in your Profile if the Viewer clicks it to view." data-boundary="window">
{{--                                <span style='color:red'>*</span>--}}
                            </h2>
                        </div>


                        <div class="card-body pb-0">
                            {{-- <form id="read_more" action="{{ route('escort.read.more',[$escort->id])}}" method="POST">
                                @csrf --}}
                            <div class="row" id="read-more-area">
                                <div class="col-lg-4">
                                    <div class="form-group row tab-about-me-row-padding">
                                        <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Piercing:</label>
                                        <div class="col-sm-8">
                                            <select
                                                class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                id="Piercing" name="piercing">
                                                <option value="" selected disabled>-Not Set-</option>
                                                @foreach(config('escorts.profile.piercing') as $key => $piercing)
                                                    <option
                                                        value='{{ $key}}' {{ ($escort->piercing == $key) ? 'selected' : ''}}>{{ $piercing }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row tab-about-me-row-padding">
                                        <label class="col-sm-4 font-weight-500"
                                               for="exampleFormControlSelect1">Drugs:</label>
                                        <div class="col-sm-8">
                                            <select
                                                class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                id="Drugs" name="drugs">
                                                <option value="" selected disabled>-Not Set-</option>
                                                @foreach(config('escorts.profile.drugs') as $key => $drug)
                                                    <option
                                                        value='{{ $key}}' {{ ($escort->drugs == $key) ? 'selected' : ''}}>{{ $drug }}</option>@endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row tab-about-me-row-padding">
                                        <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Language:</label>
                                        <div class="col-sm-8">
                                            <select
                                                class=" form-control form-control-sm select_tag_remove_box_sadow"
                                                id="language">
                                                <option value="" selected disabled>-Not Set-</option>
                                                @foreach(config('escorts.profile.languages') as $key => $language)
                                                    <option value='{{ $key}}'
                                                            @if(!empty($escort->language)) @if(in_array($key ,$escort->language)) selected
                                                            @endif @endif data-name="{{ $language }}">{{ $language }}</option>@endforeach
                                            </select>
                                        </div>
                                        @if(!empty($escort->language)) @foreach($escort->language as $language)
                                            <div class='selecated_languages select_lang'>
                                                <span
                                                    class='languages_choosed_from_drop_down'>{!!config("escorts.profile.languages.$language") !!}</span>
                                                <input class="lang" type="hidden" name="language[]"
                                                       value="{{$language}}">
                                            </div>
                                        @endforeach @endif
                                        <div id="container_language">
                                        </div>
                                        <div id="show_language" style="display:none">
                                        </div>
                                    </div>
                                    <div class="form-group row tab-about-me-row-padding">
                                        <label class="col-sm-4 font-weight-500"
                                               for="exampleFormControlSelect1">Travel:</label>
                                        <div class="col-sm-8">
                                            <select
                                                class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                id="Travel" name="travel">
                                                <option value="" selected disabled>-Not Set-</option>
                                                @foreach(config('escorts.profile.travels') as $key => $travel)
                                                    <option
                                                        value='{{ $key}}' {{ ($escort->travel == $key) ? 'selected' : ''}}>{{ $travel }}</option>@endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group row tab-about-me-row-padding">
                                        <label class="col-sm-4 font-weight-500"
                                               for="exampleFormControlSelect1">Tattoos:</label>
                                        <div class="col-sm-8">
                                            <select
                                                class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                id="Tattoos" name="tattoos">
                                                <option value="" selected disabled>-Not Set-</option>
                                                @foreach(config('escorts.profile.tattooes') as $key => $tattoos)
                                                    <option
                                                        value='{{ $key}}' {{ ($escort->tattoos == $key) ? 'selected' : ''}}>{{ $tattoos }}</option>@endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row tab-about-me-row-padding">
                                        <label class="col-sm-4 font-weight-500"
                                               for="exampleFormControlSelect1">Smoke:</label>
                                        <div class="col-sm-8">
                                            <select
                                                class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                id="Smoke" name="smoke">
                                                <option value="" selected disabled>-Not Set-</option>
                                                @foreach(config('escorts.profile.smokes') as $key => $smoke)
                                                    <option
                                                        value='{{ $key}}' {{ ($escort->smoke == $key) ? 'selected' : ''}}>{{ $smoke }}</option>@endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row tab-about-me-row-padding">
                                        <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Available
                                            to:</label>
                                        <div class="col-sm-8">
                                            <div class="form-control form-control-sm dropdown dropdown-with-checkbox">
                                                <button
                                                    class="btn toggle_custome_btn_style custome_button_style dropdown-toggle"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Select
                                                </button>
                                                <div class="dropdown-menu padding_three_px_all"
                                                     aria-labelledby="dropdownMenuButton">
                                                    @foreach(config('escorts.profile.available-to') as $key => $available_to)
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input available_to"
                                                                   id="" name="available_to[]" value='{{ $key}}'
                                                                   @if(!empty($escort->available_to)) @if(in_array($key , $escort->available_to)) checked @endif @endif>
                                                            <label class="form-check-label"
                                                                   for="exampleCheck1">{{ $available_to }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="selecated_languages available">
                                            <img src="{{ asset('assets/dashboard/img/woman-avatar.png')}}" id="1"
                                                 style="display:@if(!empty($escort->available_to)) {{ (in_array(1 , $escort->available_to)) ? 'inline-block' : 'none' }}; @else none @endif">
                                            <img src="{{ asset('assets/dashboard/img/male-user.png')}}" id="2"
                                                 style="display:@if(!empty($escort->available_to)) {{(in_array(2 , $escort->available_to)) ? 'inline-block' : 'none'}};@else none @endif">
                                            <img src="{{ asset('assets/dashboard/img/trans.png')}}" id="3"
                                                 style="display:@if(!empty($escort->available_to)) {{ (in_array(3 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                                            <img src="{{ asset('assets/dashboard/img/couple.png')}}" id="4"
                                                 style="display:@if(!empty($escort->available_to)) {{ (in_array(4 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                                            <img src="{{ asset('assets/dashboard/img/disabilities.png')}}" id="5"
                                                 style="display:@if(!empty($escort->available_to)) {{ (in_array(5 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                                            <img src="{{ asset('assets/dashboard/img/group.png')}}" id="6"
                                                 style="display:@if(!empty($escort->available_to)) {{ (in_array(6 , $escort->available_to)) ? 'inline-block' : 'none' }};@else none @endif">
                                        </div>
                                    </div>
                                    <div class="form-group row tab-about-me-row-padding">
                                        <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">SWA
                                            License:</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{ $escort->license}}" name="license"
                                                   class="form-control form-control-sm select_tag_remove_box_sadow change_default"
                                                   id="SWA License" @if(auth()->user()->state_id == 3903) required
                                                   data-parsley-group="goup_one" @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group row tab-about-me-row-padding">
                                        <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Play
                                            types:</label>
                                        <div class="col-sm-8">
                                            <div class="form-control form-control-sm dropdown dropdown-with-checkbox">
                                                <button
                                                    class="btn custome_button_style dropdown-toggle toggle_custome_btn_style"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Select
                                                </button>
                                                <div class="dropdown-menu padding_three_px_all"
                                                     aria-labelledby="dropdownMenuButton">
                                                    @foreach(config('escorts.profile.play-types') as $key => $play_type)
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input playType"
                                                                   name="play_type[]" value='{{ $key}}'
                                                                   @if(!empty($escort->play_type)) @if(in_array($key , $escort->play_type)) checked
                                                                   @endif @endif data-name="{{$play_type}}">
                                                            <label class="form-check-label"
                                                                   for="exampleCheck1">{{ $play_type }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div id="show_playType" style="display:block">
                                            @isset($escort->play_type)
                                                @foreach($escort->play_type as $play_type)
                                                    <div class='selecated_languages playT' style='display: inline-block'
                                                         id="{{$play_type}}"><span
                                                            class='languages_choosed_from_drop_down'>{{ config('escorts.profile.play-types')["$play_type"] }} </span>
                                                    </div>
                                                @endforeach
                                            @endisset
                                        </div>
                                    </div>
                                    <div class="form-group row tab-about-me-row-padding">
                                        <label class="col-sm-4 font-weight-500"
                                               for="exampleFormControlSelect1">Payment:</label>
                                        <div class="col-sm-8">
                                            <select
                                                class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                id="payment" name="payment_type">
                                                <option value="" selected disabled>-Not Set-</option>
                                                @foreach(config('escorts.profile.Payments') as $key => $Payment)
                                                    <option value='{{ $key}}'
                                                            {{ ($escort->payment_type == $key) ? 'selected' : ''}} data-name="{{ $Payment }}">{{ $Payment }}</option>@endforeach
                                            </select>
                                        </div>
                                        @if(!empty($escort->payment_type))
                                            <div class='select_pay'>
                                                <span
                                                    class='languages_choosed_from_drop_down'>{!!config("escorts.profile.Payments.$escort->payment_type") !!}</span>
                                            </div>
                                        @endif

                                        <div class="col-sm-12">

                                            <div id="show_payment_type" style="display:none">
                                                <div class='select_pay' style='display: inline-block'>
                                                    <span class='languages_choosed_from_drop_down'> </span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    @if(request()->segment(2) == 'profile' && request()->segment(3))
{{--                                        <button id="read-more" type="button" class="save_profile_btn">Update</button>--}}
                                    @endif
                                </div>
                            </div>
                            {{-- </form> --}}
                        </div>


                        <div class="border_covid covid_heading mt-2">
                            <h2>COVID -19</h2>
                        </div>
                        <div class="pt-2 pb-3" data-i="{{$escort->covidreport}}">
                            <div class="form-check form-check-inline">
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
                        @if(request()->segment(2) == 'profile' && request()->segment(3))
                        <button type="button" id="updateVaccineStatus" class="save_profile_btn">Update</button>
                        @endif
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
                        <textarea id="editor1" name="about" data-parsley-maxlength="2500" data-parsley-maxlength-message="You can't enter more than 2500 characters." data-parsley-group="ckeditor">@if(!empty($escort->about)) {{ $escort->about}} @endif</textarea>
                        <span class="theme-text-color text-capitalize">max limit 2500 characters</span>
                    </div>

                </div>

                <div class="row pt-3">
                    <div class="col-md-12 text-right" style="padding-right: 1.8rem;">
                        @if(request()->segment(2) == 'profile' && request()->segment(3))
                        <button id="update_who_am_i" type="button" class="save_profile_btn who_am_i">Update</button>
                        @endif
                    </div>
                </div>
            {{-- </form> --}}
        </div>
    </div>
    <div class="tab_btm_btns_preview_and_next pb-2">
        <div class="row pt-3 pb-2">
            <div class="col-md-12 text-right mb-2 a_text_white_hover">
                <a href="{{ route('profile.description',$escort->id ? $escort->id : '' )}}" class="save_profile_btn" target="_blank">Preview</a>
                <a href="#services" class="nex_sterp_btn " id="profile-tab" data-toggle="tab" href="#services" role="tab" aria-controls="profile" aria-selected="false">Next Step
                <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="photo_gallery" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" style="color: white;">Select Photo</h5>
                <div class="uploadModalTrigger" style="display: inline-block;position: absolute;right: 200px;">
                    <button type="button" data-toggle="modal" data-target="empty" class="btn btn-info" style=" padding: 5px;">Upload from device</button>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="grid-container modalPopup" id="profile_images" style="max-height: 500px; overflow-y:scroll;">
                    {{--                   <div class="col-sm-12">--}}
                    @foreach($media  as $keyId => $image)
                        @if(!in_array($image->position, [8, 9, 10])/*$image->position != 8*/)
                            <div class="item4">
                                <img class="img-thumbnail defult-image select_image" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                            </div>
                        @endif
                    @endforeach
                    {{--                   </div>--}}
                </div>
            </div>
            {{--<div class="modal-footer" style="justify-content: center;">
                <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal" id="close">Ok</button>
            </div>--}}
        </div>
    </div>
</div>
<style>
</style>
<div class="modal" id="photo_gallery_banner" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" style="color: white;">Select Banner</h5>
                <div class="uploadModalTrigger" style="display: inline-block;position: absolute;right: 200px;">
                    <button type="button" data-toggle="modal" data-target="empty" class="btn btn-info" style=" padding: 5px;">Upload from device</button>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="grid-container modalPopup" id="banner_images" style="max-height: 500px; overflow-y:scroll; grid-template-columns: auto;">
                    {{--                   <div class="col-sm-12">--}}
                    @foreach($media  as $keyId => $image)
                        @if(in_array($image->position, [9,10])/*$image->position != 8*/)
                            <div class="item2">
                                <img class="img-thumbnail defult-image select_image" style="height: 150px;" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                            </div>
                        @endif
                    @endforeach
                    {{--                   </div>--}}
                </div>
            </div>
            {{--<div class="modal-footer" style="justify-content: center;">
                <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal" id="close">Ok</button>
            </div>--}}
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
                                            <input type="hidden" name="position[1]" id="mediaId1">
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
                                                    <input type="hidden" name="position[2]" id="mediaId2">
                                                </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah3" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(3))   }}">
                                                    <input name="img[3]" id="pic3" data-id="3" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[3]" id="mediaId3">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah4" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(4))   }}">
                                                    <input name="img[4]" id="pic4" data-id="4" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[4]" id="mediaId4">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="">
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah5" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(5))   }}">
                                                    <input name="img[5]" id="pic5" data-id="5" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[5]" id="mediaId5">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah6" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(6))   }}">
                                                    <input name="img[6]" id="pic6" data-id="6" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[6]" id="mediaId6">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <div class="plate"><label class="newbtn">
                                                    <img id="blah7" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(7)) }}">
                                                    <input name="img[7]" id="pic7" data-id="7" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[7]" id="mediaId7">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row row pr-2 pt-2">
                                    <div class="col-12 pr-0">
                                        <div class="plate">
                                            <label class="newbtn">

                                            --}}{{-- <img id="blahx" class="img-fluid" style="width:870px; height:147px;object-fit: cover;"src="{{ asset($escort->imagefrontPosition(10)) }}"> --}}{{--
                                            <input name="img[11]" id="picx" class="pis" onchange="readURL(this);" type="file" accept="video/*">

                                            <video class="img-fluid" id="blahx" controls="" src="" style="width:870px; height:147px;object-fit: cover;">
                                                <source id="akhVideo" src="" type="video/mp4" >
                                            </video>
                                            <input type="hidden" name="position[]" id="mediaIdx">
                                            </label>
                                        </div>
                                    </div>
                                </div>--}}
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
                                            <input type="hidden" name="position[8]" id="mediaId8">
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
                                        <input type="hidden" name="position[9]" id="mediaId9">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="row mt-3" style="border: 1px dotted;">
                                <div class="col-6 pt-4 pb-4">
                                    <h4>Verify these photos</h4>
                                    <p>Upload a picture of your ID with your most recent photo for verification.</p>
                                </div>
                                <div class="col-6">
                                    <div class="plate"><label class="newbtn">
                                        <img class="img-fluid cl_blash10" id="blah10" src="{{ asset($escort->imagefrontPosition(10))}}" style="height: 138px;object-fit: cover;width: 291px;">
                                        --}}{{-- <img class="img-fluid" id="blah0" src="{{ asset('assets/app/img/upload-6.png')}}" style="height: 138px;object-fit: cover;width: 291px;"> --}}{{--
                                        <input name="img[10]" id="pic10" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                        <input type="hidden" name="position[]" id="mediaIdx">
                                        </label>
                                    </div>
                                </div>
                            </div>--}}
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
<div class="modal programmatic" id="setAsDefaultForMainAccount" style="display: none">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    {{-- <h5 class="modal-title" id="exampleModalLabel" style="color:white">Logout</h5> --}}
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    </span>
                    </button>
                </div>
                <div class="modal-body">
                    Would you like to update Media in your My Information page for future Profiles? 
                    <div class="modal-footer">
                        <button type="button" class="btn main_bg_color site_btn_primary" data-dismiss="modal" value="close" id="close_change">No</button>
                        <button type="button" class="btn main_bg_color site_btn_primary" onclick="setAsDefultImages()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('script')
<script>
    // $('.newbtn').bind("click" , function () {
    //        $('#pic').click();
    //        console.log($(this).attr('id'));
    // });

    var updatePosition = 0;
    $(document).ready(function(e) {
        _displayGenderDependentFields("{{$escortGender}}");

        $("#img1, #img2, #img3, #img4, #img5, #img6, #img7, #img9").on('click', function(e) {
            if($(this).attr('id') == 'img9') {
                $(".uploadModalTrigger").find("button").attr('data-target', '#upload-sec-banner');
                /*if($("#banner_images").find('.item2').length) {
                    $(".uploadModalTrigger").find("button").attr('data-target', '#upload-sec-banner');
                    $("#photo_gallery_banner").modal("hide");
                } else {
                    $("#upload-sec-banner").modal('show');
                }*/
            } else {
                $(".uploadModalTrigger").find("button").attr('data-target', '#upload-sec');
                /*if($("#profile_images").find('.item4').length) {
                    $(".uploadModalTrigger").find("button").attr('data-target', '#upload-sec');
                    $("#photo_gallery").modal("hide");
                } else {
                    $("#upload-sec").modal('show');
                }*/
            }
        });

        $(".uploadModalTrigger").on('click', 'button', function() {
            $("#photo_gallery").modal("hide");
            $("#photo_gallery_banner").modal("hide");
        });

        // $(".modalPopup .item4").on('click', function(e) {
        //     let imageSrc = $(this).find('img').attr('src');
        //     let mediaId = $(this).find('img').data('id');
        //     $("#blah"+updatePosition).attr('src',imageSrc);
        //     $("#img"+updatePosition).attr('src',imageSrc);
        //     $("#mediaId"+updatePosition).val(mediaId);
        //     $("#photo_gallery").modal("hide");
        // });
        
        $(".modalPopup .item2").on('click', function(e) {
            let imageSrc = $(this).find('img').attr('src');
            let mediaId = $(this).find('img').data('id');
            $("#blah9").attr('src',imageSrc);
            $("#img9").attr('src',imageSrc);
            $("#mediaId9").val(mediaId);

            $("#photo_gallery_banner").modal("hide");
        });
    });

    let profile_selected_images = [];

    $(".modalPopup .item4, .modalPopup .item2").on('click', function(e) {
       let imageSrc = $(this).find('img').attr('src');
       let mediaId = $(this).find('img').data('id');
       let img_target = $("#img"+updatePosition);
       let media_image_length = $(".upld-img").length;
       /**
        * Get existing profile image data to check duplicates
        */
        let srcArray = $(".upld-img").map(function() {
            return $(this).attr("src"); // Get the 'src' attribute of each <img>
        }).get();

       let newObject = { imageSrc: imageSrc, mediaId: mediaId, img_target: img_target, updatePosition: updatePosition };
       let duplicateImage = srcArray.findIndex(item => item === imageSrc);
       //let duplicateImage = profile_selected_images.findIndex(item => item.mediaId === mediaId);
       if(duplicateImage !== -1){
            swal.fire('', "<p>It's a duplicate image. Please select another image 001.</p>", 'error');
       }
       else{
            let index = profile_selected_images.findIndex(item => item.updatePosition === updatePosition);
            if (index !== -1) {
                profile_selected_images[index] = { ...profile_selected_images[index], ...newObject };
            }
            else{
                profile_selected_images.push(newObject);
            }
            $("#blah"+updatePosition).attr('src',imageSrc);
            $("#img"+updatePosition).attr('src',imageSrc);
            $("#mediaId"+updatePosition).val(mediaId);
            if(profile_selected_images.length > 0){
                $("#setAsDefaultForMainAccount").modal('show');
            }
       }
       $("#photo_gallery").modal("hide");
   });

    function setAsDefultImages(){
        if(profile_selected_images.length > 0){
            profile_selected_images.map((item,index)=>{
                updateDefaultImage(item.updatePosition, item.mediaId, item.img_target, item.imageSrc);
                if(profile_selected_images.length==(index+1)){
                    profile_selected_images = [];
                }
            });
            $("#setAsDefaultForMainAccount").modal('hide');
        }
    }   

    function updateDefaultImage(position, meidaId, img_target, media_src) {
        console.log({position:position,meidaId:meidaId});
        var url = "{{ route('escort.default.images') }} ";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                position: position,
                meidaId: meidaId
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success : function (data) {
                if(data.error == true) {
                    img_target.attr('data-id', meidaId);
                    img_target.attr('src', media_src);
                } else {
                    swal.fire('', "<p>"+data.msg+"</p>", 'error');
                    // $('.comman_msg').html();
                    // $("#comman_modal").modal('show');
                    $('#comman_modal').on('hidden.bs.modal', function () {
                        // location.reload();
                    });
                }
            }
        });
   }


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
            //consoleAge.log("src = "+src);
        })

    }



    $("body").on("click","#save_change",function(){
        console.log('hey jiten');
        let field = $("#trigger-element").val();
        let value = $("#current").val();
        update_escort_default($(this), {
            [field] : value
        });
    });
    // UPDATE BUTTONS
    $("body").on("click","#updateVaccineStatus",function(){
        if($("[name=covidreport]").is(':checked')) {
            update_escort($(this), {
                'covidreport' : $("[name=covidreport]:checked").val()
            });
        }
        /*$('.comman_msg').html("Updated");
        $("#comman_modal").modal('show');*/
    });
    $("body").on("click","#update_who_am_i",function(){
        let about = editor.getData();
        let about_title = $("[name=about_title]").val();
        if(about || about_title) {
            update_escort($(this), {
                'about' : about,
                'about_title' : about_title
            });
        }
    });
    $("body").on("click","#location-info",function(){
        var profile_name = $('#profile_name').val();
        var name = ($('#stageName').is(":visible")) ? $('#stageName').val() : $('#stageNameInp').val();
        var state_id = $('#state_id').val();
        var city_id = $('#city_id').val();
        var address = $('#address').val();
        var phone = $('#phone').val();
        if(profile_name != null && name != null && city_id != null && phone != null) {
            update_escort($(this), {
                'profile_name' : profile_name,
                'name' : name,
                'state_id' : state_id,
                'city_id' : city_id,
                'address' : address,
                'phone' : phone
            });
        }
        /*$('.comman_msg').html("Updated");
        $("#comman_modal").modal('show');*/
    });
    $("#read-more").on('click', function(e) {
       e.preventDefault();
       var inputFormData = {};
        $("#read-more-area").find("input, select, textarea").each(function(id, element) {
            if($(element).val()) {
                console.log($(element));
                inputFormData[$(element).attr('name')] = $(element).val();
            }
        });
        console.log(inputFormData);
    });











    {{--$('#search-playmate-input').select2({--}}
    {{--    //dropdownParent: $("#play-mates-modal"),--}}
    {{--    width: '100%',--}}
    {{--    dropdownCssClass: "bigdrop",--}}
    {{--    placeholder: {--}}
    {{--        id: 0, // the value of the option--}}
    {{--        text: "{{ asset('assets/app/img/service-provider/Frame-408.png') }}",--}}
    {{--        name: 'Search by name ',--}}
    {{--        member_id: 'Member ID',--}}
    {{--    },--}}
    {{--    allowClear: true,--}}
    {{--    language: {--}}
    {{--        inputTooShort: function() {--}}
    {{--            return 'Enter the Name';--}}
    {{--        }--}}
    {{--    },--}}
    {{--    createTag: function(params) {--}}
    {{--        var term = $.trim(params.term);--}}
    {{--        console.log(term);--}}
    {{--        if (term === '') {--}}
    {{--            return null;--}}
    {{--        }--}}
    {{--        return {--}}
    {{--            id: term,--}}
    {{--            text: term,--}}
    {{--            newTag: true // add additional parameters--}}
    {{--        }--}}
    {{--    },--}}
    {{--    tags: false,--}}
    {{--    minimumInputLength: 2,--}}
    {{--    tokenSeparators: [','],--}}
    {{--    ajax: {--}}

    {{--        url: "{{ route('escort.playmatesId.find') }}",--}}
    {{--        dataType: "json",--}}
    {{--        type: "POST",--}}
    {{--        data: function(params) {--}}

    {{--            var queryParameters = {--}}
    {{--                query: params.term,--}}
    {{--                escort_id: $('#h_escort_id').val()--}}
    {{--            }--}}

    {{--            return queryParameters;--}}
    {{--        },--}}
    {{--        processResults: function(data) {--}}
    {{--            return {--}}
    {{--                results: $.map(data, function(item) {--}}

    {{--                    return {--}}
    {{--                        text: item.default_image,--}}
    {{--                        name: item.name,--}}
    {{--                        member_id: item.member_id,--}}
    {{--                        id: item.id--}}
    {{--                    }--}}
    {{--                })--}}
    {{--            };--}}
    {{--        }--}}
    {{--    },--}}
    {{--    templateResult: formatEscortList,--}}
    {{--    templateSelection: $('#search-playmate-input').select2(--}}

    {{--});--}}
    function positionToUpdate(position) {
        updatePosition = position;
        return true;
    }
    function stageNameInput(ele) {
        if($(ele).val() == 'new') {
            $(ele).remove();
            $("#stageNameInp").attr('type', 'text');
            $("#stageNameInp").attr('name', 'name');
        }
        return true;
    }

</script>
@endpush
<style>
    .pis{
    display: none;
    }
    .newbtn{
    cursor: pointer;
    }
</style>
