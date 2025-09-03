<link rel="stylesheet" href="{{ asset('assets/richtexteditor/rte_theme_default.css') }}" />
<script type="text/javascript" src="{{ asset('assets/richtexteditor/rte.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/richtexteditor/plugins/all_plugins.js') }}"></script>
<style>
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

   textarea {
   resize: none;
   }
   #count_message {
   background-color: smoke;
   margin-top: -20px;
   margin-right: 5px;
   }
   .fill_profile_headings_global{
      border-bottom: 1px solid #0c223d;
   }
   
   .upld-img {
      height: 82px !important;
      }
</style>
<div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
      <div class="col-lg-12">
         <div class="member-id pl-0 pb-2 pt-3">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0"></path>
            </svg>
            <span>Member ID: {{auth()->user()->member_id}} </span>
         </div>
      </div>
      {{-- <div class="about_me_drop_down_info profile-sec">
         <div class="row tab-input- pl-2 pt-4">            
            <div class="col-lg-4 col-md-12 col-sm-12">
               <div class="form-group row tab-about-me-row-padding">
                  <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">
                  Profile Name:</label>
                  <div class="col-sm-7">
                     <input type="text" value="{{ $escort->profile_name}}" name="profile_name" class="form-control form-control-sm select_tag_remove_box_sadow" id="profile_name" required data-parsley-required-message="Enter profile name" data-parsley-group="goup_one">
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
               <div class="form-group row tab-about-me-row-padding">
                  <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Profile start date:</label>
                  <div class="col-sm-7">
                     <input type="date" name="start_date" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{ $escort->start_date ? date('Y-m-d',strtotime($escort->start_date)) : ''}}" id="start_date" onkeydown="return false" required data-parsley-required-message="-select date-" data-parsley-group="goup_one">
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
               <div class="form-group row tab-about-me-row-padding">
                  <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Profile end date:</label>
                  <div class="col-sm-7">
                     <input type="date" name="end_date" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{ $escort->end_date ? date('Y-m-d',strtotime($escort->end_date)) : ''}}" id="end_date" onkeydown="return false" required data-parsley-required-message="-select date-" data-parsley-group="goup_one">
                  </div>
               </div>
            </div>
         </div>
      </div> --}}
      {{-- Our Business --}}
      <div class="about_me_drop_down_info profile-sec p-4">
         <div class="fill_profile_headings_global">
            <h2 class="m-0">Our Business</h2>
         </div>
         <div class="row">
            <div class="col-md-6">
               <div class="col-lg-12">
                  <div class="row">
                     <div class="col-lg-12 my-4">
                        <div class="form-group row tab-about-me-row-padding">
                           <label class="col-sm-5 font-weight-500" for="profile_name">
                           Profile Name:</label>
                           <div class="col-sm-7">
                              <input type="text" name="profile_name" class="form-control form-control-sm select_tag_remove_box_sadow" id="profile_name" required data-parsley-required-message="Enter profile name" data-parsley-group="goup_one">
                           </div>
                        </div>

                        <div class="form-group row tab-about-me-row-padding">
                           <label class="col-sm-5 font-weight-500" for="business_name">
                           Business Name:</label>
                           <div class="col-sm-7">
                              <input type="text" name="business_name" class="form-control form-control-sm select_tag_remove_box_sadow" id="business_name" required data-parsley-required-message="Enter business name" data-parsley-group="goup_one">
                           </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                           <label class="col-sm-5 font-weight-500" for="address">
                          Address:</label>
                           <div class="col-sm-7">
                              <input type="text" name="address" class="form-control form-control-sm select_tag_remove_box_sadow" id="address" required data-parsley-required-message="Enter address" data-parsley-group="goup_one">
                           </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                           <label class="col-sm-5 font-weight-500" for="business_no">
                           Business No:</label>
                           <div class="col-sm-7">
                              <input type="text" name="business_no" class="form-control form-control-sm select_tag_remove_box_sadow" id="business_no" required data-parsley-required-message="Enter business number" data-parsley-group="goup_one">
                           </div>
                        </div>
                        <div class="form-group row tab-about-me-row-padding">
                           <label class="col-sm-5 font-weight-500" for="mobile_no">
                           Mobile No:</label>
                           <div class="col-sm-7">
                              <input type="text" name="mobile_no" class="form-control form-control-sm select_tag_remove_box_sadow" id="mobile_no" required data-parsley-required-message="Enter mobile number" data-parsley-group="goup_one">
                           </div>
                        </div>
                        {{-- <div class="about-me-box-one-name stage_name pt-3" style={{ $escort->name ? '' : "color:#9A9B9C;" }} >
                            {{$escort->name ? $escort->name  : 'Stage Name'}}
                           
                        </div>
                        
                        <div class="about-me-box-one-name show_input_box mt-3"  style="display: none">
                          
                                <input type="text" name="name" class="form-control form-control-sm select_tag_remove_box_sadow" placeholder="Enter Your Stage Name" value="{{$escort->name ? $escort->name : '' }}">
                       
                        </div> --}}
                        {{-- <span id="stageName-errors"></span> 
                        <div class="about-me-box-one-number mobile_num" style={{ $escort->city ? '' : "color:#C4C4C4;" }}>
                            {{ $escort->city ? $escort->city->name : "Location -"}}{{$escort->phone ? ' - '.$escort->phone : auth()->user()->phone}}
                        
                        </div> --}}
                        {{-- <div class="about-me-box-one-number show_input_box" style="display: none">
                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="state_id" name="state_id" required="" data-parsley-required-message="-select location-" data-parsley-group="goup_one" data-parsley-errors-container="#locationState-errors">
                              
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
                        <span id="locationState-errors"></span>
                        <div class="about-me-box-one-number show_input_box" style="display: none">
                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="city_id" name="city_id" required="" data-parsley-required-message="-select city-" data-parsley-group="goup_one" data-parsley-errors-container="#locationName-errors">
                             
                                @if($escort->city_id)
                                <option id="{{$escort->city_id}}" value="{{$escort->city_id}}" selected>{{$escort->city->name}}</option>
                                @else 
                               
                                @foreach(config('escorts.profile.states')[auth()->user()->state_id]['cities'] as $key =>$city)
                                <option id="{{$key}}" value="{{$key}}"  selected >{{$city['cityName']}}</option>
                                @endforeach 
                                
                                
                               
                                @endif
                            </select>
                         
                            <input type="text" name="phone" class="form-control form-control-sm select_tag_remove_box_sadow mt-2" value="{{$escort->phone ? $escort->phone : auth()->user()->phone  }}" placeholder="Mobile Number">
                        </div> --}}
                        
                        {{-- <div class="about-me-box-one-map add_class" style={{ $escort->
                            state ? '' : "color:#C4C4C4;" }}>
                            <svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F" />
                            </svg>
                            {{ $escort->address ? $escort->address.',' : "Address" }} {{ $escort->state ? $escort->state->name : null }} {{ $escort->pincode }}
                        </div>
                        <div class="about-me-box-one-name show_input_box mt-3"  style="display: none">
                            <input type="text" name="address" placeholder="Where are you staying" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{$escort->address }}">
                        </div> --}}
                        {{-- <div class="about-md-box-social">@if(!empty($escort->social_links)) @foreach($escort->social_links as $key=>$val)
                            <a href="{{ $val }}">
                            <img src="{{ asset('assets/dashboard/img/'.$key.'.svg') }}" />
                            </a>@endforeach @endif
                        </div> --}}
                    </div>    
                     {{-- <div class="col-lg-4">
                        <div class="pull-right pt-5" style="text-align: end;">
                           <a href="#" id="new_saveProfilename">
                              <span class="pr-2">Edit</span> 
                              <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M13.5325 3.77992C13.825 3.48742 13.825 2.99992 13.5325 2.72242L11.7775 0.967422C11.5 0.674922 11.0125 0.674922 10.72 0.967422L9.34 2.33992L12.1525 5.15242L13.5325 3.77992ZM0.25 11.4374V14.2499H3.0625L11.3575 5.94742L8.545 3.13492L0.25 11.4374Z" fill="#90A0B7"></path>
                              </svg>
                           </a>
                        </div>
                     </div> --}}
                  </div>
               </div>
            </div>
         </div>
      </div>
      {{-- media --}}
      
      <div class="about_me_drop_down_info profile-sec p-4">
         <div class="fill_profile_headings_global">
            <h2 class="m-0">Media</h2>
         </div>
         <div class="row  mt-3">
            <div class="col-md-12 mb-3 d-flex justify-content-end">
               <button type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal">Add Photos</button>
           </div>
            <div class="col-md-4">
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
                     <div class="col-lg-4">
                        <h2 class="banner-sub-heading my-2">Thumbnail</h2>
                        <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                           <img class="img-fluid" id="img1" src="{{ asset($escort->imagePosition(1)) }}" style="object-fit: cover;width: 167px;height: 172px;">
                           </label>
                        </div>
                     </div>
                     <div class="col-8">
                        <div class="row" style="">
                           <div class="col-lg-12">                                            
                              <h2 class="banner-sub-heading my-2">Gallery Image</h2>
                          </div>
                           <div class="col">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img" id="img2" src="{{  asset($escort->imagePosition(2))  }}">
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img"  id="img3" src="{{ asset($escort->imagePosition(3))   }}">
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img"  id="img4" src="{{ asset($escort->imagePosition(4))   }}">
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="row" style="">
                           <div class="col">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img"  id="img5" src="{{ asset($escort->imagePosition(5))  }}">
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img"  id="img6" src="{{ asset($escort->imagePosition(6)) }}">
                                 </label>
                              </div>
                           </div>
                           <div class="col">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img"  id="img7" src="{{ asset($escort->imagePosition(7)) }}">
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row px-3">
                     <div class="about_me_drop_down_info add_banner_pic col-lg-12">
                        <h2 class="banner-sub-heading my-2">Banner Image</h2>
                        <label class="newbtn" data-toggle="modal" data-target="#upload-sec-banner">
                        <img class="img-fluid"  id="img9" src="{{  asset($escort->imagePosition(9)) }}" style="height: 167.578px;width: 1066.640px;object-fit: cover;">
                        </label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-8">
               <div class="photo-top-header">
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
                                         <div class="progress-bar bg-success" role="progressbar" style="width: 72.6%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                     </div>
                                 </div>
                                 <div class="col-md-2">
                                     <div style="display: flex;gap: 15px;">
                                         <p>22/30</p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="custom-img-filter-header">
                         <div class="row">
                             <ul class="nav nav-tabs border-0">
                                
                                 <li class="nav-item">
                                     <a class="nav-link active" id="gallery_img" data-toggle="tab" href="#Gallery">Gallery</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link " id="banner_img" data-toggle="tab" href="#Banner">Banner</a>
                                 </li>
                                
                                 
                             </ul>
                         </div>
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
                               <li class="page-item  active" id="pageItem_0" data-id="0">
                                  <a data-target="#carouselExampleIndicators" data-slide-to="0" class="page-link" href="#">1</a>
                               </li>
                               <li class="page-item " id="pageItem_1" data-id="1">
                                  <a data-target="#carouselExampleIndicators" data-slide-to="1" class="page-link" href="#">2</a>
                               </li>
                                                           <li class="page-item " id="pageItem_2" data-id="2">
                                  <a data-target="#carouselExampleIndicators" data-slide-to="2" class="page-link" href="#">3</a>
                               </li>
                               
                               <li class="page-item nextOne">
                               <a class="page-link" href="#carouselExampleIndicators" id="nextId">››</a>
                               </li>
                            </ul>
                            <div class="container pt-2" style="padding-left: 0.75rem;padding-right: 0.75rem;">
                               <div class="carousel-inner" id="view_all">
                                   <div class="carousel-item active" id="cItem_0" data-id="0">
                                     <div class="grid-container" id="dvSource">
                                                                                                               
                                           <div class="item4" id="dm_760">
                                               <img class="img-thumbnail defult-image ui-draggable" src="http://127.0.0.1:8000/escorts/images/203/3e4f5b4696fa7d6346476a73c.jpg" alt=" " data-id="760" data-position="9">
                                               <i class="fa fa-trash deleteimg" data-id="760" title="Remove this media"></i>                                        
                                                                                   <span class="badge badge-red">Banner</span>
                                           </div>
                                       </div>
                                   </div>
   
                                   <div class="carousel-item" id="cItem_1" data-id="1">
                                     <div class="grid-container" id="dvSource">
                                           <div class="item4" id="dm_802">
                                               <img class="img-thumbnail defult-image ui-draggable" src="http://127.0.0.1:8000/escorts/images/203/82894e8c00df224c31749890d.jpg" alt=" " data-id="802" data-position="">
                                               <i class="fa fa-trash deleteimg" data-id="802" title="Remove this media"></i>                                        
                                                                                       <span class="badge badge-red">Gallery</span>
                                           </div>
                                       </div>
                                   </div>  
                                   
                                   <div class="carousel-item" id="cItem_2" data-id="2">
                                    <div class="grid-container" id="dvSource">
                                          <div class="item4" id="dm_802">
                                              <img class="img-thumbnail defult-image ui-draggable" src="http://127.0.0.1:8000/escorts/images/203/82894e8c00df224c31749890d.jpg" alt=" " data-id="802" data-position="">
                                              <i class="fa fa-trash deleteimg" data-id="802" title="Remove this media"></i>                                        
                                                                                      <span class="badge badge-red">Gallery</span>
                                          </div>
                                      </div>
                                  </div>  
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
      {{-- about us--}}
      <div class="about_me_drop_down_info profile-sec p-4">
         <div class="fill_profile_headings_global mb-4">
            <h2>About Us</h2>
         </div>
         <div class="">
            <div class="card" style="border: #90A0B7 solid 0px;padding: 0;margin-top: -10px;">
               <div>
                  <div class="card-body pb-0">
                     <div>
                        <!-- upload video  -->
                        <div class="about_me_drop_down_info ">
                           <div class="padding_20_all_side pb-0">
                              <!--New Row from here-->
                              <div class="row">
                                 <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding">
                                       <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">
                                       Building<span style="color:red">*</span></label>
                                       <div class="col-sm-8">
                                          <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="" name="building" required="">
                                             <option value="" selected="">-- Not Set --</option>
                                             @foreach(config('escorts.profile.Building') as $key =>$buldingName)
                                             <option value="{{$key}}" {{ ($escort->building == $key)? 'selected' : ''}}>{{$buldingName}}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding">
                                       <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Parking</label>
                                       <div class="col-sm-8">
                                          <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="parking" name="parking">
                                             <option value="" selected="">-- Not Set --</option>
                                             @foreach(config('escorts.profile.Parking') as $key =>$ParkingName)
                                             <option value="{{$key}}" {{ ($escort->parking == $key)? 'selected' : ''}} >{{$ParkingName}}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding">
                                       <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Entry</label>
                                       <div class="col-sm-8">
                                          <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="entry" name="entry">
                                             <option value="" selected="">-- Not Set --</option>
                                             @foreach(config('escorts.profile.Entry') as $key =>$EntryName)
                                             <option value="{{$key}}" {{ ($escort->entry == $key)? 'selected' : ''}}>{{$EntryName}}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding">
                                       <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Type</label>
                                       <div class="col-sm-8">
                                          <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Type" name="furniture_types">
                                             <option value="" selected="">-- Not Set --</option>
                                             @foreach(config('escorts.profile.furniture_types') as $key =>$furniture_type)
                                             <option value="{{$key}}" {{ ($escort->furniture_types == $key)? 'selected' : ''}} >{{$furniture_type}}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding">
                                       <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">
                                       Shower</label>
                                       <div class="col-sm-8">
                                          <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="" name="shower" required="">
                                             <option value="" selected="">-- Not Set --</option>
                                             @foreach(config('escorts.profile.Shower') as $key =>$Type)
                                             <option value="{{$key}}" {{ ($escort->shower == $key)? 'selected' : ''}} >{{$Type}}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding">
                                       <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Ambiance</label>
                                       <div class="col-sm-8">
                                          <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="ambiance" name="ambiance">
                                             <option value="" selected="">-- Not Set --</option>
                                             @foreach(config('escorts.profile.Ambiance') as $key =>$AmbianceName)
                                             <option value="{{$key}}" {{ ($escort->ambiance == $key)? 'selected' : ''}} >{{$AmbianceName}}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding">
                                       <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Security</label>
                                       <div class="col-sm-8">
                                          <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="security" name="security">
                                             <option value="" selected="">-- Not Set --</option>
                                             @foreach(config('escorts.profile.Security') as $key =>$SecurityName)
                                             <option value="{{$key}}" {{ ($escort->security == $key)? 'selected' : ''}} data-name="{{$SecurityName}}">{{$SecurityName}}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                      
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding">
                                       <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Payment</label>
                                       <div class="col-sm-8">
                                          <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="payment" name="payment">
                                             <option value="" selected="">-- Not Set --</option>
                                             @foreach(config('escorts.profile.Payments') as $key =>$PaymentType)
                                             <option value="{{$key}}" {{ ($escort->payment == $key)? 'selected' : ''}} data-name="{{$PaymentType}}">{{$PaymentType}}</option>
                                             @endforeach>
                                          </select>
                                       </div>
                                       @if(!empty($escort->payment)) 
                                       <div class='select_pay'>
                                           <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.payments.$escort->payment") !!}</span>
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
                                 <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding">
                                       <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Loyalty program
                                       </label>
                                       <div class="col-sm-8">
                                          <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="loyalty" name="loyalty">
                                             <option value="" selected="">-- Not Set --</option>
                                             @foreach(config('escorts.profile.Loyalty') as $key =>$LoyaltyType)
                                             <option value="{{$key}}" {{ ($escort->loyalty == $key)? 'selected' : ''}} >{{$LoyaltyType}}</option>
                                             @endforeach>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding">
                                       <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Languages
                                       </label>
                                       <div class="col-sm-8">
                                          <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="language" >
                                             <option value="" selected="">-- Not Set --</option>
                                             @foreach(config('escorts.profile.languages') as $key =>$language)
                                             <option value="{{$key}}"  @if(!empty($massage_profile->language)) @if(in_array($key ,$escort->language)) selected @endif @endif data-name="{{ $language }}">{{$language}}</option>
                                             @endforeach>
                                          </select>
                                          <div id="show_language">
                                             <div class='selecated_languages'>
                                                @if(!empty($escort->language)) 
                                                @foreach($escort->language as $language)
                                                <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.languages.$language") !!}<small class="remove-lang">×</small></span>
                                                <input type='hidden' name='language[]' value="{{$language}}">
                                                @endforeach
                                                @endif
                                             </div>
                                             <div id="container_language">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>


                                 
                              </div>
                              {{-- <div class="row">
                                 <div class="col-md-12 text-right">
                                    <button id="read-more" type="button" class="save_profile_btn">Update</button>
                                 </div>
                              </div> --}}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      {{-- who are we --}}
      <div class="about_me_drop_down_info profile-sec p-4">
         <div class="fill_profile_headings_global">
            <h2>Who are We ?</h2>
         </div>
         <div class="padding_20_all_side">
            <input type="text" name="about_title" value="{{$escort->about_title ? $escort->about_title : null }}" class="whoiamtitle mb-3" placeholder="Enter Your Title Here">
               <div class="row">
                  <div class="col-12">
                     <textarea id="editor1" name="about" data-parsley-maxlength="257" data-parsley-maxlength-message="You can't enter more than 250 characters .." data-parsley-group="ckeditor">@if(!empty($escort->about)) {{ $escort->about}} @endif</textarea>
                     <span class="theme-text-color text-capitalize">max limit 2500 characters</span>
                  </div>
               
               </div>

               {{-- <div class="row pt-3">
                  <div class="col-md-12 text-right" style="padding-right: 1.8rem;">
                        <button id="update_who_am_i" type="button" class="save_profile_btn who_am_i">Update</button>
                  </div>
               </div> --}}
      </div>

      </div>
      <div class="tab_btm_btns_preview_and_next py-3">
         <div class="row pt-3 pb-2">
            <div class="col-md-12 text-right mb-2 a_text_white_hover">
               <a class="nex_sterp_btn" id="profile-tab" data-toggle="tab" href="#services" role="tab" aria-controls="profile" aria-selected="false">              
                  Next Step <i class="fas fa-arrow-right"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
   
<div class="modal fade upload-modal" id="upload-sec" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="width: 800px;position: absolute;">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle"> <img class="custompopicon" src="{{  asset('assets/dashboard/img/upload-photos.png') }}"> Manage Photos</h5>               

               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="container p-0">
                        <div class="row pr-2 modal_inner_area">
                           <div class="col-4 full_pic">
                              <div class="plate"><label class="newbtn">
                                 <img id="blah1" class="img-fluid" src="{{ asset($escort->imagefrontPosition(1))  }}" style="width: 171px;object-fit: cover;height: 308px;">
                                 <input name="img[1]" id="pic1" data-id="1" class="pis" onchange="readURL(this);" type="file">
                                 <input type="hidden" name="position[]" id="mediaId1">
                                 </label>
                              </div>
                           </div>
                           <div class="col-8 pl-0">
                              <div class="row" style="">
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah2" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(2))   }}">
                                       <input name="img[2]" id="pic2" data-id="2" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId2">    
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah3" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(3))   }}">
                                       <input name="img[3]" id="pic3" data-id="3" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId3">
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah4" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(4))   }}">
                                       <input name="img[4]" id="pic4" data-id="4" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId4">
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="row" style="">
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah5" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(5))   }}">
                                       <input name="img[5]" id="pic5" data-id="5" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId5">
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah6" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(6))   }}">
                                       <input name="img[6]" id="pic6" data-id="6" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId6">
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah7" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(7)) }}">
                                       <input name="img[7]" id="pic7" data-id="7" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId7">
                                       </label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row pt-1 varify_box" style="border: 1px dotted;">
                           <div class="col-6 pt-4 pb-4">
                              <h4>Verify these photos</h4>
                              <p>Upload a picture of your ID with your most recent photo for verification.</p>
                           </div>
                           <div class="col-6">
                              <div class="plate"><label class="newbtn">
                                 <img class="img-fluid" id="blah8" src="{{ asset($escort->imagefrontPosition(8)) }}" style="height: 138px;object-fit: cover;width: 370px;">
                                 <input name="img[8]" id="pic8" data-id="8" class="pis" onchange="readURL(this);" type="file">
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
            <h5 class="modal-title" style="color: white;" id="exampleModalLongTitle"> <img src="{{ asset('assets/dashboard/img/banner.png')}}" class="custompopicon">Manage Banner</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="container p-0">
                     <div class="row">
                        <div class="col-12">
                           <div class="plate"><label class="newbtn">
                              <img id="blah9" class="img-fluid" src="{{ asset($escort->imagefrontPosition(9)) }}" style="height: 118px;object-fit: cover;width: 618px;">
                              <input name="img[9]" id="pic9" class="pis" onchange="readURL(this);" type="file">
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
                              <img class="img-fluid" id="blah0" src="{{  asset($escort->imagefrontPosition(10)) }}" style="height: 138px;object-fit: cover;width: 291px;">
                              <input name="img[10]" id="pic0" class="pis" onchange="readURL(this);" type="file">
                              <input type="hidden" name="position[]" id="mediaId10">
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



<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable" role="document"> {{--NOTE:: use  modal-dialog-scrollable instead of modal-dialog to make body scrollable only--}}
       <div class="modal-content" style="width: 900px;position: absolute;">
           {{-- {{ route('escort.upload.gallery') }} --}}
           <form id="mulitiImage" method="POST" action="{{route('escort.upload.gallery')}}" enctype="multipart/form-data">
               @csrf
               <div class="modal-content border-0">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLongTitle"><img src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross"> Upload Photos</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <div class="row">
                           <div class="col-md-12">
                               <div class="container p-0">
                                   <div class="row p-0">
                                       <div class="col-12 p-0">
                                           <div class="photo-sec-popup custom-upload-photo"  id="image_preview">
                                               <a href="#">
                                                   <div class="five_column_content_top img-title-sec justify-content-between wish_span rm" style="z-index: 1;">
                                                     
                                                   </div>
                                                   <label class="newbtn rm">
                                                       <img id="blah" class="item" src="{{ asset('assets/app/img/upload-thum-1.png')}}">
                                                       
                                                       <input name="img[]" id="upload_file" class="pis" onchange="preview_image(this);" type="file" multiple accept="image/*">
                                                   </label>
                                                   <div style="margin-top: -34px;">
                                                   </div>
                                               </a>
                                           </div>
                                           <div class="row mt-2">
                                               <div class="col-lg-6">
                                                   <div class="plate"><label class="newbtn">
                                                       <img id="blah9" class="img-fluid pl-2 pr-2" src="{{ asset('assets/app/img/upload-3.png')}}" style="height: 150px;object-fit: cover;width: 100%;">
                                                       <input name="img[9]" id="pic9" class="pis" onchange="readURL(this);" type="file" accept="image/*" >
                                                       <input type="hidden" name="position[]" id="mediaId9">
                                                       </label>
                                                   </div>
                                               </div>
                                               <div class="col-lg-6">
                                                   <div class="plate"><label class="newbtn">
                                                       <img id="blah10" class="img-fluid pl-2 pr-2" src="{{ asset('assets/app/img/add-pinup-banner-full.png')}}" style="height: 150px;object-fit: cover;width: 100%;">
                                                       <input name="img[10]" id="pic10" class="pis" onchange="readURL(this);" type="file" accept="image/*" >
                                                       <input type="hidden" name="position[]" id="mediaId10">
                                                       </label>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="row mt-4 pt-1" style="border: 1px dotted;">
                                       <div class="col-6 pt-4 pb-4">
                                           <h4>Verify these Photos</h4>

                                           <ul style="text-align: justify;">
                                             <li>Two (2) selfies with your User Name and Membership ID printed (can be handwritten) on a sheet of paper held up to the side of you and not obscuring any part of you</li>
                                             <li>A drivers licence which matches your User Name and Home State</li>
                                             <li>A passport which matches your User Name and Home State</li>
                                           </ul>
                                       </div>
                                       <div class="col-6">
                                           <div class="plate" style="position: relative;top: 30%;"><label class="newbtn">
                                               <img class="img-fluid" id="blah8" src="{{--- {{ asset($path->findByposition(auth()->user()->id,8)['path']) }} --}}" style="height: 138px;object-fit: cover;width: 370px;">
                                               <input name="img[8]" id="pic8" data-id="8" class="pis" onchange="readURL(this);" type="file">
                                               <input type="hidden" name="selected_files[]" value="8">
                                               </label>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn-success-modal">Verify Media</button>
                       <button type="submit" class="btn-success-modal">Upload</button>
                   </div>
               </div>
           </form>
       </div>
   </div>
</div>

<script>
   
   function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();
           
           reader.onload = function (e) {
               $('#blah'+input.id[3])
                   .attr('src', e.target.result);
               
           };
   
           reader.readAsDataURL(input.files[0]); 
           
       }
       $("body").on('click','#manageImgId',function(e){
           var src = $("#blah"+input.id[3]).attr('src');
           $('#img'+input.id[3])
                   .attr('src', src);
           $("#upload-sec").modal('hide');
           console.log("file = "+input.id[3]);
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