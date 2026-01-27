<link rel="stylesheet" href="{{ asset('assets/richtexteditor/rte_theme_default.css') }}" />
<script type="text/javascript" src="{{ asset('assets/richtexteditor/rte.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/richtexteditor/plugins/all_plugins.js') }}"></script>
<style>
   textarea {
   resize: none;
   }
   #count_message {
   background-color: smoke;
   margin-top: -20px;
   margin-right: 5px;
   }
</style>
<div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
   {{-- 
   <form id="update_about_me" action="{{ route('center.about.me',[$escort->id])}}" method="POST" enctype="multipart/form-data">
      @csrf   --}}
      <div class="col-lg-12">
         <div class="member-id pl-0 pb-2 pt-3">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0"></path>
            </svg>
            <span>Member ID: {{auth()->user()->member_id}} </span>
         </div>
      </div>
      {{-- 
      <div class="about_me_drop_down_info ">
         <div class="row tab-input-">
            <div class="col-md-12 input-in-row">
               <div class="d-flex align-item-center"><span>Profile Name:</span>
                  <input type="text" placeholder="Melbourne" id="profile_name" name="profile_name" value="{{ $escort->profile_name}}">
               </div>
               <div class="d-flex"><span>Profile start date:</span> <input type="date" name="start_date" value="{{ $escort->start_date ? date('Y-m-d',strtotime($escort->start_date)) : ''}}" id="start_date">             </div>
               <div class="d-flex"><span>Profile end date:</span> <input type="date" name="end_date" value="{{ $escort->end_date ? date('Y-m-d',strtotime($escort->end_date)) : ''}}" id="end_date"></div>
            </div>
         </div>
      </div>
      --}}
      <div class="about_me_drop_down_info profile-sec">
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
      </div>
      <div class="about_me_drop_down_info profile-sec">
         <div class="row">
            <div class="col-md-6" style="border-right: 10px solid #eee;">
               <div class="col-lg-12">
                  <div class="row">
                     {{-- <div class="col-lg-8 pl-1">
                        <div class="about-me-box-one-name stage_name pt-3" style={{ $escort->name ? '' : "color:#9A9B9C;" }} >{{$escort->name ? $escort->name : 'New Harmony Nature Massage'}}
                        </div>
                        <div class="about-me-box-one-name show_input_box mt-3"  style="display: none">
                           <input type="text" name="name" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{$escort->name }}">
                        </div>
                        <div class="about-me-box-one-number mobile_num" style={{ $escort->city ? '' : "color:#C4C4C4;" }}>{{ $escort->city ? $escort->city->name : "Location - "}}{{$escort->phone ? ' - '.$escort->phone : "Mobile Number"}}
                        </div>
                        <div class="about-me-box-one-number show_input_box" style="display: none">
                           <select class="form-control form-control-sm select_tag_remove_box_sadow" id="city_id" name="city_id">
                              {{-- 
                              <required data-parsley-required-message="-select city-" data-parsley-group="goup_one">
                              --||}}
                              <option value="" selected="">-- Not Set --</option>
                              @foreach(config('escorts.profile.cities') as $key =>$city)
                              <option id="{{$city}}" value="{{$key}}" {{ ($escort->city_id == $key)? 'selected' : ''}} >{{$city}}</option>
                              @endforeach
                           </select>
                           <input type="text" name="phone" class="form-control form-control-sm select_tag_remove_box_sadow mt-2" value="{{$escort->phone }}" placeholder="Mobile Number">
                        </div>
                        <div class="about-me-box-one-map add_class" style={{ $escort->
                           state ? '' : "color:#C4C4C4;" }}>
                          
                           <svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F" />
                           </svg>
                           
                           {{ $escort->address ? $escort->address.',' : "Address" }} {{ $escort->state ? $escort->state->name : null }} {{ $escort->pincode }}
                        </div>
                        <div class="about-me-box-one-name show_input_box mt-3"  style="display: none">
                           <input type="text" name="address" placeholder="Address" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{$escort->address }}">
                        </div>
                        <div class="about-md-box-social pb-4">
                           <a class="ml-0" href="#">
                              <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <rect width="22" height="22.1078" rx="11" fill="#0C223D"/>
                                 <g clip-path="url(#clip0_2816_3394)">
                                    <path d="M11.6 16.0537V11.0537H12.98L13.17 9.32371H11.6L11.61 8.46371C11.61 8.01371 11.65 7.77371 12.29 7.77371H13.16V6.05371H11.78C10.12 6.05371 9.53 6.88371 9.53 8.29371V9.32371H8.5V11.0537H9.53V16.0537H11.6Z" fill="#FF3C5F"/>
                                 </g>
                                 <defs>
                                    <clipPath id="clip0_2816_3394">
                                       <rect width="10" height="10" fill="white" transform="translate(6 6.05371)"/>
                                    </clipPath>
                                 </defs>
                              </svg>
                           </a>
                           <a href="#">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <rect width="24" height="23.6712" rx="11.8356" fill="#0C223D"/>
                                 <g clip-path="url(#clip0_2816_3398)">
                                    <path d="M9.9 6.83545H14.1C15.7 6.83545 17 8.13545 17 9.73545V13.9354C17 14.7046 16.6945 15.4422 16.1506 15.9861C15.6068 16.5299 14.8691 16.8354 14.1 16.8354H9.9C8.3 16.8354 7 15.5354 7 13.9354V9.73545C7 8.96632 7.30553 8.2287 7.84939 7.68484C8.39325 7.14098 9.13087 6.83545 9.9 6.83545ZM9.8 7.83545C9.32261 7.83545 8.86477 8.02509 8.52721 8.36266C8.18964 8.70022 8 9.15806 8 9.63545V14.0354C8 15.0304 8.805 15.8354 9.8 15.8354H14.2C14.6774 15.8354 15.1352 15.6458 15.4728 15.3082C15.8104 14.9707 16 14.5128 16 14.0354V9.63545C16 8.64045 15.195 7.83545 14.2 7.83545H9.8ZM14.625 8.58545C14.7908 8.58545 14.9497 8.6513 15.0669 8.76851C15.1842 8.88572 15.25 9.04469 15.25 9.21045C15.25 9.37621 15.1842 9.53518 15.0669 9.65239C14.9497 9.7696 14.7908 9.83545 14.625 9.83545C14.4592 9.83545 14.3003 9.7696 14.1831 9.65239C14.0658 9.53518 14 9.37621 14 9.21045C14 9.04469 14.0658 8.88572 14.1831 8.76851C14.3003 8.6513 14.4592 8.58545 14.625 8.58545ZM12 9.33545C12.663 9.33545 13.2989 9.59884 13.7678 10.0677C14.2366 10.5365 14.5 11.1724 14.5 11.8354C14.5 12.4985 14.2366 13.1344 13.7678 13.6032C13.2989 14.0721 12.663 14.3354 12 14.3354C11.337 14.3354 10.7011 14.0721 10.2322 13.6032C9.76339 13.1344 9.5 12.4985 9.5 11.8354C9.5 11.1724 9.76339 10.5365 10.2322 10.0677C10.7011 9.59884 11.337 9.33545 12 9.33545ZM12 10.3354C11.6022 10.3354 11.2206 10.4935 10.9393 10.7748C10.658 11.0561 10.5 11.4376 10.5 11.8354C10.5 12.2333 10.658 12.6148 10.9393 12.8961C11.2206 13.1774 11.6022 13.3354 12 13.3354C12.3978 13.3354 12.7794 13.1774 13.0607 12.8961C13.342 12.6148 13.5 12.2333 13.5 11.8354C13.5 11.4376 13.342 11.0561 13.0607 10.7748C12.7794 10.4935 12.3978 10.3354 12 10.3354Z" fill="#FF3C5F"/>
                                 </g>
                                 <defs>
                                    <clipPath id="clip0_2816_3398">
                                       <rect width="10" height="10" fill="white" transform="translate(7 6.83545)"/>
                                    </clipPath>
                                 </defs>
                              </svg>
                           </a>
                           <a href="#">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <rect width="24" height="24" rx="12" fill="#0C223D"/>
                                 <g clip-path="url(#clip0_2816_3402)">
                                    <path d="M11.86 10.4098L11.88 10.7598L11.52 10.7198C10.2 10.5498 9.05 9.97978 8.08 9.02978L7.6 8.54978L7.48 8.89978C7.22 9.67978 7.38 10.5098 7.93 11.0598C8.21 11.3698 8.15 11.4098 7.65 11.2298C7.48 11.1698 7.33 11.1298 7.31 11.1498C7.26 11.1998 7.43 11.8698 7.57 12.1298C7.76 12.4898 8.14 12.8498 8.56 13.0598L8.92 13.2298L8.5 13.2398C8.09 13.2398 8.08 13.2398 8.12 13.3998C8.26 13.8698 8.84 14.3698 9.47 14.5898L9.92 14.7498L9.53 14.9798C8.95 15.3198 8.27 15.5098 7.59 15.5198C7.27 15.5298 7 15.5598 7 15.5798C7 15.6498 7.88 16.0598 8.4 16.2198C9.93 16.6998 11.76 16.4898 13.14 15.6798C14.11 15.0998 15.09 13.9598 15.54 12.8498C15.79 12.2598 16.03 11.1798 16.03 10.6598C16.03 10.3298 16.05 10.2798 16.46 9.87978C16.7 9.64978 16.92 9.38978 16.96 9.31978C17.04 9.17978 17.03 9.17978 16.66 9.29978C16.05 9.51978 15.96 9.48978 16.26 9.16978C16.49 8.92978 16.76 8.50978 16.76 8.38978C16.76 8.35978 16.65 8.39978 16.52 8.46978C16.39 8.53978 16.1 8.64978 15.89 8.70978L15.5 8.83978L15.14 8.59978C14.95 8.46978 14.67 8.31978 14.53 8.27978C14.16 8.16978 13.6 8.18978 13.27 8.30978C12.36 8.62978 11.79 9.47978 11.86 10.4098Z" fill="#FF3C5F"/>
                                 </g>
                                 <defs>
                                    <clipPath id="clip0_2816_3402">
                                       <rect width="10" height="10" fill="white" transform="translate(7 7)"/>
                                    </clipPath>
                                 </defs>
                              </svg>
                           </a>
                        </div>
                     </div> --}}
                     <div class="col-lg-8 pl-1">
                        <div class="about-me-box-one-name stage_name pt-3" style={{ $escort->name ? '' : "color:#9A9B9C;" }} >
                            {{$escort->name ? $escort->name  : 'Stage Name'}}
                           
                        </div>
                        
                        <div class="about-me-box-one-name show_input_box mt-3"  style="display: none">
                            {{-- <input type="text" name="name" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{$escort->name }}"> --}}
                            {{-- @if( !empty($user->profile_creator) && in_array(1,$user->profile_creator)) 
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="stageName" name="name" required="" data-parsley-required-message="-select name-" data-parsley-group="goup_one" data-parsley-errors-container="#stageName-errors">
                                    <option value="" selected>-Select Your Stage Name-</option>
                                    
                                    @if(!empty(auth()->user()->escorts_names))
                                    @foreach(auth()->user()->escorts_names as $key => $name)
                                        <option value='{{ $name}}' {{ ($escort->name == $name)? 'selected' : ''}}>{{ $name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            @else --}}
                                <input type="text" name="name" class="form-control form-control-sm select_tag_remove_box_sadow" placeholder="Enter Your Stage Name" value="{{$escort->name ? $escort->name : '' }}">
                           {{--  @endif                             --}}
                        </div>
                        <span id="stageName-errors"></span> 
                        <div class="about-me-box-one-number mobile_num" style={{ $escort->city ? '' : "color:#C4C4C4;" }}>
                            {{ $escort->city ? $escort->city->name : "Location -"}}{{$escort->phone ? ' - '.$escort->phone : auth()->user()->phone}}
                        
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
                                    {{ auth()->user()->state_id == $key ? 'selected' : '' }} 
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
                               
                                @foreach(config('escorts.profile.states')[auth()->user()->state_id]['cities'] as $key =>$city)
                                <option id="{{$key}}" value="{{$key}}"  selected >{{$city['cityName']}}</option>
                                @endforeach 
                                
                                
                               
                                @endif
                            </select>
                            {{-- <span id="locationName-errors"></span> --}}
                            <input type="text" name="phone" class="form-control form-control-sm select_tag_remove_box_sadow mt-2" value="{{$escort->phone ? $escort->phone : auth()->user()->phone  }}" placeholder="Mobile Number">
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
                  </div>
               </div>
            </div>
            <div class="col-md-6" style="padding-right: 25px;">
               <div class="container p-0">
                  <div class="row pt-3">
                     <div class="col-4 pr-0 full_height_pic">
                        <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                           {{-- <img class="img-fluid modal-image-first" id="img1" src="{{ asset('assets/app/img/upload-1.png')}}" style="height: 284px;object-fit: cover;"> --}}
                           <img class="img-fluid" id="img1" src="{{ asset($escort->imagePosition(1)) }}" style="height: 284px;object-fit: cover;width: 167px;">
                           </label>
                        </div>
                     </div>
                     <div class="col-8 half_heght_pic">
                        <div class="row" style="">
                           <div class="col-4 pr-0">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img" id="img2" src="{{  asset($escort->imagePosition(2))  }}">
                                 </label>
                              </div>
                           </div>
                           <div class="col-4 pr-0">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img"  id="img3" src="{{ asset($escort->imagePosition(3))   }}">
                                 </label>
                              </div>
                           </div>
                           <div class="col-4 pr-0">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img"  id="img4" src="{{ asset($escort->imagePosition(4))   }}">
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="row" style="">
                           <div class="col-4 pr-0">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img"  id="img5" src="{{ asset($escort->imagePosition(5))  }}">
                                 </label>
                              </div>
                           </div>
                           <div class="col-4 pr-0">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img"  id="img6" src="{{ asset($escort->imagePosition(6)) }}">
                                 </label>
                              </div>
                           </div>
                           <div class="col-4 pr-0">
                              <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid upld-img"  id="img7" src="{{ asset($escort->imagePosition(7)) }}">
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row pt-3">
                     <div class="about_me_drop_down_info add_banner_pic">
                        <label class="newbtn" data-toggle="modal" data-target="#upload-sec-banner">
                        <img class="img-fluid"  id="img9" src="{{  asset($escort->imagePosition(9)) }}" style="height: 167.578px;width: 1066.640px;object-fit: cover;">
                        </label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      {{-- 
      <!-- add banner image -->
      <!-- upload video  -->
      {{-- 
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
      --}}
      <!--         <div class="about_me_drop_down_info profile-sec p-3">
         <div class="about_me_drop_down_info ">
             <label class="newbtn" data-toggle="modal" data-target="#upload-sec-banner">
             <img class="img-fluid"  id=" " src="{{ asset('assets/app/img/upload-7.png') }}" style="height: 167.578px;width: 1066.640px;object-fit: cover;">
             </label>
         </div>
         </div> -->
      <!-- upload video blow about me -->
      <div class="about_me_drop_down_info profile-sec p-4">
         <div class="about_me_heading_in_first_tab fill_profile_headings_global border-0">
            <h2 class="m-0">About me</h2>
         </div>
         <div class="myacording-design mb-5">
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
                                       Shower<span style="color:red">*</span></label>
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
                                 <div class="col-lg-4 col-md-12 col-sm-12" style="margin-top: -20px;">
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
                                                <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.languages.$language") !!}</span>
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
                              <div class="row">
                                 <div class="col-md-12 text-right">
                                    <!--  <button id="read-more" type="submit" class="save_profile_btn">Reset</button> -->
                                    <button id="read-more" type="button" class="save_profile_btn">Update</button>
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
      {{-- 
   </form>
   --}}
   {{-- 
   <div class="about_me_drop_down_info ">
      <div class="about_me_heading_in_first_tab fill_profile_headings_global">
         <h2>Read more</h2>
      </div>
      <div class="padding_20_all_side">
         <form id="read_more" action="{{ route('center.read.more',[$escort->id])}}" method="POST">
            @csrf
            <div class="row">
               <div class="col-lg-4">
                  <div class="form-group row tab-about-me-row-padding">
                     <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Piercing:</label>
                     <div class="col-sm-7">
                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Piercing" name="piercing">
                           <option value="" selected disabled>-Not Set-</option>
                           @foreach(config('escorts.profile.piercing') as $key => $piercing)
                           <option value='{{ $key}}' {{ ($escort->piercing == $key) ? 'selected' : ''}}>{{ $piercing }}</option>@endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group row tab-about-me-row-padding">
                     <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Drugs:</label>
                     <div class="col-sm-7">
                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Drugs" name="drugs">
                           <option value="" selected disabled>-Not Set-</option>
                           @foreach(config('escorts.profile.drugs') as $key => $drug)
                           <option value='{{ $key}}' {{ ($escort->drugs == $key) ? 'selected' : ''}}>{{ $drug }}</option>@endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group row tab-about-me-row-padding">
                     <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Language:</label>
                     <div class="col-sm-7">
                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="language">
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
                     <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Tattoos:</label>
                     <div class="col-sm-7">
                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Tattoos" name="tattoos">
                           <option value="" selected disabled>-Not Set-</option>
                           @foreach(config('escorts.profile.tattooes') as $key => $tattoos)
                           <option value='{{ $key}}' {{ ($escort->tattoos == $key) ? 'selected' : ''}}>{{ $tattoos }}</option>@endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group row tab-about-me-row-padding">
                     <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Smoke:</label>
                     <div class="col-sm-7">
                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Smoke" name="smoke">
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
                        <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Payment" name="payment_type">
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
                  <button id="read-more" type="submit" class="save_profile_btn">Update</button>
               </div>
            </div>
         </form>
      </div>
   </div>
   --}}
   <div class="about_me_drop_down_info profile-sec p-4">
      <div class="about_me_heading_in_first_tab fill_profile_headings_global">
         <h2>Who am I ?</h2>
      </div>
      <div class="padding_20_all_side">
         <input type="text" name="about_title" value="{{$escort->about_title ? $escort->about_title : null }}" class="whoiamtitle mb-3" placeholder="Enter Your Title Here">
            <div class="row">
               <div class="col-12">
                  <textarea id="editor1" name="about" data-parsley-maxlength="257" data-parsley-maxlength-message="You can't enter more than 250 characters .." data-parsley-group="ckeditor">@if(!empty($escort->about)) {{ $escort->about}} @endif</textarea>
                  <span class="theme-text-color text-capitalize">max limit 250 characters</span>
               </div>
            
            </div>

             <div class="row pt-3">
                 <div class="col-md-12 text-right" style="padding-right: 1.8rem;">
                     <button id="update_who_am_i" type="button" class="save_profile_btn who_am_i">Update</button>
                 </div>
             </div>
     </div>
      {{-- <div class="padding_20_all_side">
         <input type="text" name="about_title" value="" class="whoiamtitle mb-3" placeholder="Enter Your Title Here">
         <form action="" method="post">
            <input name="htmlcode" id="inp_htmlcode" type="hidden" />
            <div id="div_editor1" class="richtexteditor">
            </div>
            <script>
               var editor1 = new RichTextEditor(document.getElementById("div_editor1"));
               editor1.attachEvent("change", function () {
                   document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
               });
            </script>
            <div class="row pt-3">
               <div class="col-md-12 text-right">
                  <button id="update_who_am_i" type="button" class="save_profile_btn">Update</button>
               </div>
            </div>
         </form>
      </div> --}}
   </div>
   {{-- 
   <div class="about_me_drop_down_info play-mets">
      <div class="padding_20_all_side">
         <div class="row">
            <div class="col-md-12 col-sm-12 mb-12">
               @include('agent.dashboard.partials.playmates-edit')
               <input type="hidden" name="h_escort_id" vlaue="{{ $escort->id }}">
            </div>
         </div>
         <div id="playmate-template" class="row text-center">
            @foreach($escort->playmates as $playmate)
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
            @endforeach
         </div>
      </div>
   </div>
   --}}
   <div class="tab_btm_btns_preview_and_next">
      <div class="row pt-3 pb-2">
         <div class="col-md-12 text-right mb-2 a_text_white_hover">
            <a href="#" class="save_profile_btn" >Preview</a>
            <a href="#services" class="nex_sterp_btn" id="profile-tab" data-toggle="tab" href="#services" role="tab" aria-controls="profile" aria-selected="false">Next Step
            <i class="fas fa-arrow-right"></i>
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
               <h5 class="modal-title" id="exampleModalLongTitle">Manage Photos</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/cross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="container p-0">
                        <div class="row pr-2 modal_inner_area">
                           <div class="col-4 full_pic">
                              <div class="plate"><label class="newbtn">
                                 <img id="blah1" class="img-fluid" src="{{ asset($escort->imagefrontPosition(1))  }}" style="width: 171px;object-fit: cover;height: 284px;">
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
                        <!-- <div class="row pr-2 modal_inner_area full_with_pic">
                           <div class="col-12 pr-0" style="">
                           
                               <div class="plate"><label class="newbtn">
                               <img class="img-fluid" id="blah8" src="{{ asset('assets/app/img/full_width_frame.png') }}" style="">
                                   <input name="img[8]" id="pic8" data-id="8" class="pis" onchange="readURL(this);" type="file">
                                   <input type="hidden" name="position[]" id="mediaId8">
                                   </label>
                               </div>
                           
                             </div>
                           
                           </div> -->
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