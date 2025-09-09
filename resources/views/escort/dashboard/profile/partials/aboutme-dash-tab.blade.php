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
    .media-profile{margin-bottom: 20px}


    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
    .modalPopup > .item4 {
        cursor: pointer;
    }
    .modalPopup > .item2 {
        cursor: pointer;
    }
    .ui-draggable-dragging {
        width: 82px !important;
        height: 82px !important;
        opacity: 0.8;
    }
    .draggable
    {
    filter: alpha(opacity=60);
    opacity: 0.6;
    }
    .dropped
    {
    position: static !important;
    }
    .pis{
    display: none;
    }
    .newbtn{
    cursor: pointer;
    }
    .grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    gap: 10px;
    }
    .grid-container > div {
    background-color: rgba(255, 255, 255, 0.8);
    }
    .item1 {
    grid-column: 3 / span 3;
    }
    .item4{
        width: 100%;
        object-fit: cover;
    }
    img.img-thumbnail.defult-image {
        width: 190px;
        height: 135px;
        object-fit: cover;
    }
    img.img-thumbnail.defult-image-3 {
    width: 585px;
    height: 202px;
    object-fit: cover;
    position: absolute;
    }
    img#blah8 {
    width: 425px !important;
    }
    .leftLst.over {
    pointer-events: none;
}
    .item4 .fa-trash {
        position: absolute;
        right: 10px;
        top: 10px;
        color: #e73b3b;
        display: none;
    }
    .item4:hover .fa-trash {
         display: block;
     }
    .item4 {
        position: relative;
    }
    .item2{
        height: 100% !important;
        width: 100%;
    }
    .item2 img{
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
    }
    .modal-tab {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
}
    .my-custompop-tabs .nav-item{
        margin-bottom: 0px !important;
    }
    .my-custompop-tabs .nav-item .nav-link.active{
    color: #fff;
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
        <div class="row pl-3">
        <div class="col-lg-3">
            <div class="member-id pl-0 pb-2 pt-3">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0" />
                </svg>
                <span>Member ID: {{auth()->user()->member_id}}</span>
            </div>
        </div>
        <div class="col-lg-6">

            <div class="member-id pl-0 pb-2 pt-3">

            </div>
        </div>
    </div>
        <div class="about_me_drop_down_info profile-sec">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-lg-12  padding_20_all_side p-2 pb-2">
                        <div class="border_covid covid_heading  ">
                            <h2>Location Information</h2>
                        </div>
                        <div class="">

                             @if(request()->segment(2) == 'profile' && request()->segment(3))
                            <form id="LocationInformation" action="{{ route('escort.update_escort', $escort->id) }}" method="Post" data-parsley-validate>
                                @csrf
                            @endif

                            <div class="col-lg-12 pt-4">
                                <div class="form-group row tab-about-me-row-padding">
                                    <label class="col-sm-2 font-weight-500 small-icon" for="profile_name">
                                        Profile Name:
                                        <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="Be consistent when naming your Profiles, like Sydney01, Sydney 02, Perth01, Perth02 etc." data-boundary="window">
                                        <span style='color:red'>*</span>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Enter your Profile Name (your internal reference)" value="{{ $escort->profile_name}}" title="(your use only)"  name="profile_name" class="form-control form-control-sm select_tag_remove_box_sadow" id="profile_name"
                                         required
                                         data-parsley-group="group_one" 
                                         data-parsley-required-message="Enter profile name."
                                         data-parsley-remote="{{ (request()->segment(2) == 'profile')?route('escort.checkProfileName', ['escort_id' => $escort->id]):route('escort.checkProfileName')}}"
                                         data-parsley-remote-message="This profile name already exists." 
                                         data-parsley-trigger="blur"
                                         data-parsley-errors-container="#profile_name-errors">
                                    </div>
                                    <div class="col-sm-4">
                                        <span id="profile_name-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row tab-about-me-row-padding">
                                    <label class="col-sm-2 font-weight-500" for="stageName">Stage Name:<span style='color:red'>*</span></label>
                                    <div class="col-sm-6">
                                        @php
                                            $profile_type = isset($profile_type);
                                            $routeIsNewprofile = Str::contains(request()->path(), 'create-profile');
                                        @endphp
                                        @if( !empty($user->profile_creator) && in_array(1,$user->profile_creator) && $routeIsNewprofile)
                                            <select onclick="stageNameInput(this)" class=" form-control form-control-sm select_tag_remove_box_sadow" title="(for public display)" id="stageName" name="name" required="required" data-parsley-required-message="Select stage name" data-parsley-group="group_one" data-parsley-errors-container="#stageName-errors">
                                                <option value="" selected>-Choose Your Stage Name-</option>
                                                {{-- <option value="" selected disabled>-Not Set-</option> --}}
                                                @if(!empty(auth()->user()->escorts_names))
                                                    @foreach(auth()->user()->escorts_names as $key => $name)
                                                        <option value='{{ $name}}' {{ ($escort->name == $name)? 'selected' : ''}}>{{ $name}}</option>
                                                    @endforeach
                                                @endif
                                                <option value="new">Add a new Stage Name</option>
                                            </select>
                                            <input type="hidden" id="stageNameInp" required="required" name="" title="(for public display)" class="change_default form-control form-control-sm select_tag_remove_box_sadow" data-parsley-required-message="Enter stage name" data-parsley-group="group_one" placeholder="Choose your Stage Name (for public display)"  data-parsley-errors-container="#stageName-errors">
                                        @else

                                            @if($profile_type && !$routeIsNewprofile)
                                                <select onclick="stageNameInput(this)" style="display: block" class=" change_default_select form-control form-control-sm select_tag_remove_box_sadow" title="(for public display)" id="stageName" name="name" required="required" data-parsley-required-message="Select stage name" data-parsley-group="group_one" data-parsley-errors-container="#stageName-errors">
                                                    <option value="" selected>-Choose Your Stage Name-</option>
                                                    {{-- <option value="" selected disabled>-Not Set-</option> --}}
                                                    @if(!empty(auth()->user()->escorts_names))
                                                        @foreach(auth()->user()->escorts_names as $key => $name)
                                                            <option value='{{ $name}}' {{ ($escort->name == $name)? 'selected' : ''}}>{{ $name}}</option>
                                                        @endforeach
                                                    @endif
                                                    <option value="new">Add a new Stage Name</option>
                                                </select>
                                                <input type="hidden" id="stageNameInp" required="required" name="" title="(for public display)" value="{{$escort->name ? $escort->name : '' }}-edit" class="change_default form-control form-control-sm select_tag_remove_box_sadow" data-parsley-required-message="Enter stage name" data-parsley-group="group_one" placeholder="Choose your Stage Name (for public display)"  data-parsley-errors-container="#stageName-errors">
                                            @endif

                                            
                                            {{-- <input type="text" id="stageName" required="required" name="name" title="(for public display)" class="change_default stageNameOnBlank form-control form-control-sm select_tag_remove_box_sadow" value="{{$escort->name ? $escort->name : '' }}" data-parsley-required-message="Enter stage name" data-parsley-group="group_one" placeholder="Choose your Stage Name (for public display)" data-parsley-errors-container="#stageName-errors"> --}}
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
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow change_default {{$routeIsNewprofile?'js_profile_current_location':''}}" id="state_id" name="state_id" required="required" data-parsley-required-message="-select location-" data-parsley-group="group_one" data-parsley-errors-container="#locationState-errors">
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
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow" id="city_id" name="city_id" required="required" data-parsley-required-message="-select city-" data-parsley-group="group_one" data-parsley-errors-container="#locationName-errors">
                                            {{-- <required data-parsley-required-message="-select city-" data-parsley-group="group_one"> --}}
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
                                        <input type="text" id="phone" required name="phone" class="form-control form-control-sm select_tag_remove_box_sadow mt-2" value="{{$escort->phone ? $escort->phone : auth()->user()->phone  }}" placeholder="Mobile Number"  data-parsley-required-message="Enter mobile number" data-parsley-group="group_one"  data-parsley-errors-container="#mobile-errors">
                                    </div>
                                    <div class="col-sm-4">
                                        <span id="phone-errors"></span>
                                    </div>
                                </div>
                            </div>
                             @if(request()->segment(2) == 'profile' && request()->segment(3))
                                  <div class="col-md-12 text-right">
                                <button id="location-info" type="submit" class="save_profile_btn">Update</button>
                            </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about_me_drop_down_info profile-sec">
              @if (request()->segment(2) == 'profile' && request()->segment(3))
                <form id="myProfileMediaForm" name="myProfileMediaForm"
                    action="{{ route('escort.profile.media', [$escort->id]) }}" method="POST" enctype="multipart/form-data">
                    @CSRF
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="col-lg-12 py-3">
                        <div class="border_covid covid_heading ">
                            <h2>Media
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="You can move your photos into any order you like by picking up and dropping into the preferred position." data-boundary="window">

                            </h2>
                            
                        </div>
                      <div class="row  mt-3">
                        
                        <div class="col-md-12 mb-3 d-flex justify-content-end">
                            <button type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal">Add Photos</button>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="upload-banner p-0">
                                <div class="photo-top-header">                    
                                    <div class="custom-img-filter-header border-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h3 class="gallery-head">Your Default Images</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col-4">                                          
                                        <h2 class="banner-sub-heading my-2">Thumbnail</h2>
                                        <div class="plate"><label class="newbtn dvDest" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(1)">
                                        <img class="img-fluid upld-img profile-gallery" data-type="gallery" id="img1" src="{{asset($escort->imagePosition(1))}}" style="object-fit: cover;width: 167px;height: 172px;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-12">                                            
                                                <h2 class="banner-sub-heading my-2">Gallery Images</h2>
                                            </div>
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(2)">
                                                        <img class="img-fluid upld-img profile-gallery" data-type="gallery" id="img2" src="{{asset($escort->imagePosition(2))}}">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(3)">
                                                        <img class="img-fluid upld-img profile-gallery" data-type="gallery" id="img3" src="{{asset($escort->imagePosition(3))}}">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(4)">
                                                        <img class="img-fluid upld-img profile-gallery" data-type="gallery" id="img4" src="{{asset($escort->imagePosition(4))}}">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="">
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(5)">
                                                        <img class="img-fluid upld-img profile-gallery" data-type="gallery" id="img5" src="{{asset($escort->imagePosition(5))}}">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(6)">
                                                        <img class="img-fluid upld-img profile-gallery" data-type="gallery" id="img6" src="{{asset($escort->imagePosition(6))}}">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(7)">
                                                        <img class="img-fluid upld-img profile-gallery" data-type="gallery" id="img7" src="{{asset($escort->imagePosition(7))}}">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-3 pb-2">
                                    <div class="col-lg-12">
                                        <h2 class="banner-sub-heading my-2">Banner Image</h2>
                                        <label class="newbtn dvDest" data-toggle="modal" data-target="#photo_gallery_banner" onclick="positionToUpdate(9)">
                                            <img class="img-fluid profile-gallery" data-type="banner"  id="img9" src="{{asset($escort->imagePosition(9))}}" style="height: 167.578px;width: 1066.640px;object-fit: cover;">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-8" id="js_profile_media_gallery">
                            <div class="photo-top-header">
                                <div class="photo-header custom-photo-header">
                                    <div class="modal-header border-0 p-0" style="display: block;position: relative;top: 30%;">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <ul class="nav nav-tabs border-0">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="menu_all" data-toggle="tab" href="#home">All</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="menu_varified" data-toggle="tab" href="#menu1">Verified</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="menu_unverified" data-toggle="tab" href="#menu2">Unverified</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2 pt-1">
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$media->count() * 3.3}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div style="display: flex;gap: 15px;">
                                                    <p>{{ $media->count() }}/30</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-img-filter-header">
                                    <div class="row">
                                        <ul class="nav nav-tabs border-0 js_gallery_category">
                                           
                                            <li class="nav-item">
                                                <a class="nav-link active" data-type="gallery" data-toggle="tab" href="#Gallery">Gallery</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-type="banner" data-toggle="tab" href="#Banner">Banner</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="archive-photo-sec">
                                <div class="row">
                                   <div class="col-md-12">
                                      <div id="pagination-container"></div>
                                      <div id="carouselExampleIndicators" class="carousel slide" data-bs-wrap="false" data-bs-ride="carousel">
                                      
                                         <ul class="pagination ml-2 pl-1">
                                            <!-- Declare the item in the group -->
                                            <li class="page-item preview">
                                               <!-- Declare the link of the item -->
                                            <a class="page-link" href="#carouselExampleIndicators" id="preId">‹‹</a>
                
                                            </li>
                                            @for($i = 0; $i < ceil(collect($media)->whereNotIn('position',[9, 10])->count()/10); $i++ )
                                            <li class="page-item" id="pageItem_{{$i}}" data-id="{{$i}}">
                                               <a data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="page-link" href="#">{{$i + 1}}</a>
                                            </li>
                                            @endfor
                                            <li class="page-item nextOne">
                                            <a class="page-link" href="#carouselExampleIndicators" id="nextId">››</a>
                                            </li>
                                         </ul>
                                         <div class="container pt-2" style="padding-left: 0.75rem;padding-right: 0.75rem;">
                                            <div class="carousel-inner" id="view_all">
                                            @foreach(collect($media)->whereNotIn('position',[9, 10])->chunk(10)  as $keyId => $images)
                                                <div class="carousel-item" id="cItem_{{$loop->index}}" data-id="{{$loop->index}}">
                                                  <div class="grid-container" id="dvSource">  
                                                  @foreach($images as $image)    
                                                  @if(!in_array($image->position, [8]))                                               
                                                        <div class="item4" id="dm_{{$image->id}}">
                                                            <img class="img-thumbnail defult-image ui-draggable" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                                                            <i class="fa fa-trash deleteimg" data-id="{{$image->id}}" title="Remove this media"></i>                                        
                                                            @switch($image->position)
                                                                @case(9)
                                                                    <span class="badge badge-red">Banner</span>
                                                                @break
                                                                @case(10)
                                                                    <span class="badge badge-red">Pin Up</span>
                                                                @break
                                                                @default
                                                                    <span class="badge badge-red">Gallery</span>
                                                            @endswitch
                                                        </div>
                                                    @endif    
                                                    @endforeach   
                                                    </div>
                                                </div>
                                            @endforeach                     
                                            </div>
                                            <!--.Carousel-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            
<div class="modal" id="photo_gallery_banner" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" style="color: white;"> <img src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross"> Select Banner</h5>
               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">
             <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
             </span>
                </button>
            </div>
            <div class="modal-body">
             <!-- Nav tabs -->
             <ul class="nav nav-tabs my-custompop-tabs" id="myTab" role="tablist">
                 
                 <li class="nav-item">
                     <a class="nav-link active" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="false">
                         Upload Banner
                     </a>
                     </li>
                 <li class="nav-item">
                 <a class="nav-link" id="default-tab" data-toggle="tab" href="#default" role="tab" aria-controls="default" aria-selected="true">
                     Default Template
                 </a>
                 </li>
             </ul>
                <div class="modalPopup" style="max-height: 500px; overflow-y:scroll;">
                     
                     <div class="tab-content mt-3">
                         <!-- Tab panes -->
                         <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                             <div id="banner_modal_container" class="modal-tab">
                                 @foreach($media  as $keyId => $image)
                                     @if(!$image->template && in_array($image->position, [9])/*$image->position != 8*/)                                    
                                     <!-- upload Template Tab -->
                                             <div class="item2">
                                                 <img class="img-thumbnail defult-image select_image"
                                                     src="{{ asset($image->path) }}"
                                                     alt=" "
                                                     data-id="{{$image->id}}"
                                                     data-position="{{$image->position ? $image->position : ''}}">
                                             </div>              
                                                 
                                     @endif
                                 @endforeach                                     
                             </div>                           
                         </div>     
                         <!-- default Banner Tab -->
                         <div class="tab-pane fade" id="default" role="tabpanel" aria-labelledby="default-tab">
                            @php  
                            $bannerTemplates = getBannerTemplates();
                            @endphp 
                            <div class="modal-tab">
                                @if(!empty($bannerTemplates))
                                    @foreach($bannerTemplates as $keyId => $image)
                                        <div class="item2">
                                            <img src="{{ asset($image->path) }}" data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}" class="img-thumbnail defult-image select_image">
                                        </div>
                                    @endforeach
                                @endif
                             </div>
                         </div>
                     </div>    
                </div>
            </div>
        </div>
    </div>
 </div>
            <div class="modal fade upload-modal" id="upload-sec" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"> <img src="{{ asset('assets/dashboard/img/banner.png') }}" class="custompopicon"> Manage Photos</h5>
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
                                <button type="button" class="btn-success-modal" id="defaultImg">Use Default</button>
                                <button type="button" class="btn-success-modal" id="manageImgId">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade upload-modal" id="upload-sec-banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"> <img src="{{ asset('assets/dashboard/img/banner.png') }}" class="custompopicon"> Manage Banner</h5>
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
                                                   
                                                    <input name="img[9]" id="pic9" class="pis" onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[9]" id="mediaId9">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-success-modal" id="defaultImg2">Use Default</button>
                            <button type="button" class="btn-success-modal" id="manageImgId">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            @if (request()->segment(2) == 'profile' && request()->segment(3))
                <div class="row">
                    <div class="col-md-12 text-right media-profile">
                        <button id="mediaProfileBtn" type="submit" class="save_profile_btn">Update</button>
                    </div>
                </div>
                </form>
            @endif
        </div>

        <div class="about_me_drop_down_info profile-sec">
            <div class="padding_20_all_side p-2 pb-4">
                <!--New Row from here-->
                <!--New Row end here-->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="border_covid covid_heading ">
                            <h2>About Me</h2>
                        </div>

                        <div class="card-body pb-0">
                            <div class="tab-pane fade show active" id="aboutme" role="tabpanel"
                                 aria-labelledby="home-tab">
                                <!-- upload video  -->
                                <div class="about_me_drop_down_info ">
                                    <div class="padding_20_all_side pb-0">
                                   @if (request()->segment(2) == 'profile' && request()->segment(3))
                                       <form id="update_about_me" action="{{ route('escort.about.me',[$escort->id])}}" method="POST" enctype="multipart/form-data">
                                            @CSRF
                                    @endif
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
                                                            data-parsley-group="group_one">

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
                                            @php
                                            $countrys = getCountryList();
                                            @endphp
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group row tab-about-me-row-padding">
                                                    <label class="col-sm-4 font-weight-500"
                                                           for="exampleFormControlSelect1">Nationality:</label>
                                                    <div class="col-sm-8">

                                                        <select style="border: 1px solid #d5d7e5 !important;"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow nationality-sec change_default" id="select2_country" data-parsley-required-message="Select nationality"
                                                                name="nationality_id"
                                                                data-parsley-errors-container="#nationality-errors">
                                                                @if(count($countrys) > 0)
                                                                @foreach($countrys as $ckey => $cname)
                                                            <option
                                                                value="{{ old('nationality_id',$ckey)}}" @if($ckey ==$escort->nationality_id) selected="selected" @endif>{{$cname}}</option>
                                                                @endforeach
                                                                @endif
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
                                                               data-parsley-group="group_one">
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
                                                               class="form-control form-control-sm  removebox_shdow change_default"
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
                                        @if (request()->segment(2) == 'profile' && request()->segment(3))
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button id="aboutMeBtn" type="submit" class="save_profile_btn">Update</button>
                                                </div>
                                            </div>
                                            </form>
                                        @endif
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
                             @if (request()->segment(2) == 'profile' && request()->segment(3))
                                <form id="read_more" name="read_more" action="{{ route('escort.read.more',[$escort->id])}}" method="POST">
                                    @CSRF
                            @endif
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
                                                class="change_default form-control form-control-sm select_tag_remove_box_sadow"
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
                                                <input class="lang languageInput" type="hidden" name="language[]"
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
                                                            <input type="checkbox" class="change_default form-check-input available_to"
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
                                                   id="SWA License" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group row tab-about-me-row-padding">
                    <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Play types:</label>
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
                                                            <input type="checkbox" class="change_default form-check-input playType"
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
                             @if(request()->segment(2) == 'profile' && request()->segment(3))
                            <div class="row">
                                <div class="col-md-12 text-right">
                                <button id="read-more" type="submit" class="save_profile_btn">Update</button>
                                </div>
                            </div>
                            </form>
                             @endif
                        </div>


                        <div class="border_covid covid_heading mt-2">
                            <h2>COVID -19</h2>
                        </div>
                        <div class="pt-2 pb-3" data-i="{{$escort->covidreport}}">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input covidreport change_default" type="radio" name="covidreport" id="inlineRadio1" required
           data-parsley-group="group_one"
           data-parsley-required-message="Please select a COVID vaccination status"
           data-parsley-errors-container="#covidreport-errors" value="1" {{ $escort->getRawOriginal('covidreport') == 1 ? ' checked' : null }} >
                                <label class="form-check-label" for="inlineRadio1">Vaccinated, not up to date</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input covidreport change_default" type="radio" name="covidreport" id="inlineRadio2" value="2" {{ $escort->getRawOriginal('covidreport') == 2 ? ' checked' : null }}>
                                <label class="form-check-label" for="inlineRadio2">Vaccinated, up to date</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input covidreport change_default" type="radio" name="covidreport" id="inlineRadio3" value="3" {{ $escort->getRawOriginal('covidreport') == 3 ? ' checked' : null }}>
                                <label class="form-check-label" for="inlineRadio3">Not Vaccinated</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                                        <span id="covidreport-errors"></span>
                        </div>
                        
                        
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

    <div class="about_me_drop_down_info profile-sec pl-4 pr-4 p-2 pt-4">
        <div class="about_me_heading_in_first_tab fill_profile_headings_global text-capitalize">
            <h2>Who am I ?</h2>
        </div>
        <div class="padding_20_all_side">
           
             @if(request()->segment(2) == 'profile' && request()->segment(3))
            <form id="update_abut_who_am_i" action="{{ route('escort.about',[$escort->id])}}" method="POST">
                @csrf
            @endif
             <input type="text" name="about_title" value="{{$escort->about_title ? $escort->about_title : null }}" class="whoiamtitle mb-3" placeholder="Enter Your Title Here" required
                                         data-parsley-group="group_one" 
                                         data-parsley-required-message="Enter title">
                <div class="row">
                    <div class="col-12">
                        <textarea id="editor1" name="about" data-parsley-maxlength="2500" data-parsley-maxlength-message="You can't enter more than 2500 characters." required
                                         data-parsley-group="group_one" 
                                         data-parsley-required-message="Enter content."
                                         data-parsley-errors-container="#editor1-errors">@if(!empty($escort->about)) {{ $escort->about}} @endif</textarea>
                        <span class="theme-text-color text-capitalize">max limit 2500 characters</span>
                    </div>
                    <div class="col-sm-4">
                            <span id="editor1-errors"></span>
                    </div>

                </div>
                @if(request()->segment(2) == 'profile' && request()->segment(3))
                <div class="row pt-3">
                    <div class="col-md-12 text-right" style="padding-right: 1.8rem;">
                       
                        <button id="update_who_am_i" type="sumbit" class="save_profile_btn who_am_i">Update</button>
                        
                    </div>
                </div>
                </form>
            @endif
        </div>
    </div>
    <div class="tab_btm_btns_preview_and_next pb-2">
        <div class="row pt-3 pb-2">
            <div class="col-md-12 text-right mb-2 a_text_white_hover">
                @if(request()->segment(2) == 'profile')
                <a data-toggle="modal"  data-id="{{$escort->id}}" data-target="#view-listing"  class="save_profile_btn preview-profile" href="#">Preview</a>
                @endif
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
                <h5 class="modal-title" style="color: white;"><img src="{{ asset('assets/dashboard/img/banner.png') }}" class="custompopicon"> Select Photo</h5>
                <div class="uploadModalTrigger" style="display: inline-block;position: absolute;right: 200px;">
                    <button type="button" data-toggle="modal" data-target="empty" class="btn-cancel-modal" style=" padding: 5px 10px;">Upload from device</button>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div id="gallery_modal_container" class="grid-container modalPopup" style="max-height: 500px; overflow-y:scroll;">
                    
                    @foreach($media  as $keyId => $image)
                        @if(!in_array($image->position, [9, 10]))
                            <div class="item4">
                                <img class="img-thumbnail defult-image select_image" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="modal programmatic" id="setAsDefaultForMainAccount" style="display: none">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white"> <img src="{{ asset('assets/dashboard/img/banner.png') }}" class="custompopicon">Update Media</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    </span>
                    </button>
                </div>
                <div class="modal-body">
                    Would you like to update Media in your My Information page for future Profiles? 
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close" id="close_change">No</button>
                        <button type="button" class="btn-success-modal" onclick="setAsDefultImages()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('script')
<script>
    function initDragDrop(){
        $("#dvSource img").draggable({
           revert: "invalid",
           helper: 'clone',
           appendTo: ".upload-banner",
           refreshPositions: false,
           drag: function (event, ui) {
               
           },
           stop: function (event, ui) {
           }
       });
       
       $(".dvDest").droppable({
           drop: function (event, ui) {
            let dropSlot = $(this);
            let dragSlot = ui.draggable;
            let dropSlotType = dropSlot.find('img').data('type');
            let dragSlotType = dragSlot.closest(".item4").find('span').text().toLowerCase();
            if(dropSlotType!=dragSlotType){
                let message = (dragSlotType=='gallery')?`The photo you selected is not a Banner image. Please select a Banner image from your repository.`:`The photo you selected is not a Gallery image. Please select a Gallery image from your repository.`;
                swal.fire('Media', message, 'error');
                return false;
            }
            else{
            $(this).trigger('click');
            let meidaId = dragSlot.data('id');
            let target;
            switch(dragSlotType){
                case 'gallery':{
                    target = $(".modalPopup .item4 img[data-id='" + meidaId + "']").closest(".item4");
                } break;
                case 'banner':{
                    target = $(".modalPopup .item2 img[data-id='" + meidaId + "']").closest(".item2");
                } break;
            }
            target.trigger('click');
            }
            
           }
       });
    }

  $(function () {
    initDragDrop();
  });

    var updatePosition = 0;
    $(document).ready(function(e) {
        _displayGenderDependentFields("{{$escortGender}}");

        $("#img1, #img2, #img3, #img4, #img5, #img6, #img7, #img9").on('click', function(e) {
            if($(this).attr('id') == 'img9') {
                $(".uploadModalTrigger").find("button").attr('data-target', '#upload-sec-banner');
               
            } else {
                $(".uploadModalTrigger").find("button").attr('data-target', '#upload-sec');
               
            }
        });

        $(".uploadModalTrigger").on('click', 'button', function() {
            $("#photo_gallery").modal("hide");
            $("#photo_gallery_banner").modal("hide");
        });

    });

    let profile_selected_images = [];
    let default_image_icons = ['img-11.png','img-12.png','img-13.png'];
    $(document).on('click','.modalPopup .item4, .modalPopup .item2', function(e) {
       let imageSrc = $(this).find('img').attr('src');
       let mediaId = $(this).find('img').data('id');
       let img_target = $("#img"+updatePosition);
       let targetImageSrc = img_target.attr('src');
       let targetImageName = targetImageSrc.split("/").pop();
       /**
        * Get existing profile image data to check duplicates
        */
        let srcArray = $(".upld-img").map(function() {
            return $(this).attr("src"); // Get the 'src' attribute of each <img>
        }).get();

       let newObject = { imageSrc: imageSrc, mediaId: mediaId, img_target: img_target, updatePosition: updatePosition };
       let duplicateImage = srcArray.findIndex(item => item === imageSrc);
       if(duplicateImage !== -1){
            swal.fire('', "<p>It's a duplicate image. Please select another image.</p>", 'error');
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
                let modalTitle = document.querySelector("#setAsDefaultForMainAccount .modal-title");
                let textNode = [...modalTitle.childNodes].find(
                    node => node.nodeType === Node.TEXT_NODE && node.textContent.trim() !== ""
                );
                if (textNode) {
                    textNode.textContent = default_image_icons.includes(targetImageName)?'Save to Default Media or Repository':'Replace Media';
                }
                $("#setAsDefaultForMainAccount").modal('show');
            }
       }
       $("#photo_gallery").modal("hide");
       $("#photo_gallery_banner").modal("hide");
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
        })

    }

    $("body").on("keyup change",".stageNameOnBlank",function(){
        let $this = $(this);

        if ($this.val().trim() === "") {
            console.log('heycdsd');
            $(".change_default_select").show();
            $(".stageNameOnBlank").hide();
            return true;
        }
    });

    
    // UPDATE BUTTONS
    var parsleyRadio = $('[name="covidreport"]').eq(0).parsley();
    $("body").on("click","#updateVaccineStatus",function(){
        if(parsleyRadio.isValid()){
            const selected = $('[name="covidreport"]:checked').val();
            update_escort($(this), {
                covidreport: selected
            });
        }
        else{
            parsleyRadio.validate();
        }
        
    });
   
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
