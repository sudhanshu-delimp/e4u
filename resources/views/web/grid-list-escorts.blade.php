@extends('layouts.web')
@section('content')
   <section class="">
      <div class="container">
         <div class="search_filters">
            <div class="search_filters_inside">
               <div class="row">
                  <div class="col-md-7">
                     <h5 class="normal_heading">Search Filters</h5>
                  </div>
                  <div class="col-md-5">
                     <div class="display_inline_block">
                           <div class="input-group custome_form_control managefilter_search_btn_style rounded mb-2">
                              <button class="input-group-text border-0 remove_bg_color_of_search_btn" id="search-addon" type="submit">
                              <i class="fa fa-search" aria-hidden="true"></i>
                              </button>
                              <input type="search" class="form-control remove_border_btm rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                           </div>
                     </div>
                     <div class="display_inline_block">
                           <div class="margin_btn_reset">
                              <button type="reset" class="btn reset_filter">
                              <i class="fa fa-repeat" aria-hidden="true"></i>
                              </button>
                           </div>
                     </div>
                     <div class="display_inline_block">
                           <div class="margin_btn_reset">
                              <button type="button" class="btn reset_filter">
                              <i class="fa fa-list" aria-hidden="true"></i>
                              </button>
                           </div>
                     </div>
                     <div class="display_inline_block helpquation">
                           <a href="#">
                           Help <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                           </a>
                     </div>
                  </div>
               </div>
               <div class="fiter_btns">
                  <div class="display_inline_block mb-1 mr-2">
                     <select class="custome_form_control_border_radus padding_five_px" id="select2-dropdown">
                           <option>All Cities</option>
                     </select>
                  </div>
                  <div class="display_inline_block mb-1 mr-2">
                     <select class="custome_form_control_border_radus padding_five_px" id="">
                           <option value="" selected>Gender</option>
                           <option value="1">Male</option>
                           <option value="0">Female</option>
                           <option value="2">Other</option>
                     </select>
                  </div>
                  <div class="display_inline_block mb-1 mr-2">
                     <div class="slider-area">
                           <span class="slider-title">Select Age</span>
                           <div class="slider-area-wrapper-for-age">
                              <span id="skip-value-lower-age"></span>
                              <div id="skipstepage" class="slider"></div>
                              <span id="skip-value-upper-age"></span>
                           </div>
                     </div>
                  </div>
                  <div class="display_inline_block mb-1 mr-2">
                     <div class="slider-area">
                           <span class="slider-title">Select Rate</span>
                           <div class="slider-area-wrapper-for-price">
                              <span class="d-inline-flex">$<span id="skip-value-lower"></span></span>
                              <div id="skipstep" class="slider"></div>
                              <span class="d-inline-flex">$<span id="skip-varesponsive_colums_in_lg_nine_collue-upper"></span></span>
                           </div>
                     </div>
                  </div>
                  <div class="display_inline_block mb-1 mr-2">
                     <select class="custome_form_control_border_radus padding_five_px with_eight_em" id="">
                           <option>All services</option>
                           @foreach($services as $key => $service)
                           <option value="{{$service->id}}">{{$service->name}}</option>
                           @endforeach
                     </select>
                  </div>
                  <div class="display_inline_block mb-1 mr-2">
                     <button type="button" class="btn verified_btn_bg_color verified_text_color">
                     <img src="{{ asset('assets/app/img/protected2.png')}}"> Verified
                     </button>
                  </div>
                  <div class="display_inline_block mb-1 mr-2">
                     <button type="button" class="btn reset_filter">
                     Apply Filters
                     </button>
                  </div>
               </div>
               <div class="service_tags">
                  <form id="sercieTags" action="">
                     <div class="row">
                           <div class="col-md-3">
                              <h5 class="normal_heading">Service Tags</h5>
                           </div>
                           <div class="col-md-7">
                              <div class="display_inline_block mb-1 mr-3">
                                 <select class="custome_form_control_border_radus padding_five_px" id="">
                                       <option value="">Fun Stuff - On Viewer</option>
                                       @foreach($service_one as $key => $service)
                                       <option value="{{$service->id}}">{{$service->name}}</option>
                                       @endforeach
                                 </select>
                              </div>
                              <div class="display_inline_block mb-1 mr-3">
                                 <select class="custome_form_control_border_radus padding_five_px" id="">
                                       <option value="">Kinky Stuff - On Viewer</option>
                                       @foreach($service_two as $key => $service)
                                       <option value="{{$service->id}}">{{$service->name}}</option>
                                       @endforeach
                                 </select>
                              </div>
                              <div class="display_inline_block mb-1 mr-3">
                                 <select class="custome_form_control_border_radus padding_five_px" id="">
                                       <option value="">Fun Stuff - On Me</option>
                                       @foreach($service_three as $key => $service)
                                       <option value="{{$service->id}}">{{$service->name}}</option>
                                       @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <input type="reset" class="text_decoration_under_line" value="Clear Tags">
                           </div>
                     </div>
                  </form>
                  <div class="row">
                     <div class="col-md-12">
                           <div class="selected_service_tag">
                              <ul>
                                 <li class="seleceted_service_text_and_icon">
                                       <p>Massage Thai</p>
                                       <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                 </li>
                                 <li class="seleceted_service_text_and_icon">
                                       <p>Happy Ending</p>
                                       <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                 </li>
                              </ul>
                           </div>
                     </div>
                  </div>
               </div>
         </div>
         </div>
      <!-- ================     service provider start here     ========================= -->
         <div class="row">
            <div class="col-12">
                  <div class="grid_list_icon_box display_inline_block">
                     <a href="#" class="active" data-toggle="tooltip" title="Grid view"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                  </div>
                  <div class="grid_list_icon_box display_inline_block">
                     <a href="#" class="inactive" data-toggle="tooltip" title="List view"><i class="fa fa-bars" aria-hidden="true"></i></a>
                  </div>
            </div>
         </div>
        
      <!--  ==============     5 items column start here  ==================  -->
         
         @foreach($escorts as $plan_type => $members)
            @switch($plan_type)
               @case(1)
                  @foreach($members as $escort)
                     <div class="listview_each_section_border_btm">
                        <div class="manage_listview_margin_gold_section padding_20_all_side_service_provider_list_view box_shdow_service_provider_list_view">
                           <div class="row">
                              <div class="col-md-12 col-lg-8 col-sm-12">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="section_wise_level_icon_img">
                                       <img src="{{ asset('assets/app/img/profile/list.png')}}" class="img-fluid">
                                       <div class="siliver_logo_icon"><img src="{{ asset('assets/app/img/profile/image36.png')}}"></div>
                                       <div class="add_to_fab_list_view_each_sec">
                                          <span class="add_to_favrate">
                                             <i class="fa fa-heart" aria-hidden="true"></i>
                                          </span>
                                       </div>
                                       <div class="verify_image">
                                          <img src="{{ asset('assets/app/img/verifyimage.png')}}">
                                       </div>                              
                                       </div>
                                    </div>
                                    <div class="col-md-9 p-0">

                                       <div class="d-flex justify-content-between mb-3 flex_directiom_warp">
                                          <div class="free_profile_name_and_color manage_name_responsive_in_gold">{{$escort->name}}</div>
                                          <div class="age">
                                             <span class="margin_and_font_size_color_for_free manage_age_responsive_in_gold">AGE:</span><span class="free_profile_age_color_and_font">{{$escort->age}}</span>
                                          </div>

                                          <div class="add_to_shortlist_btn manage_btn_gor_gold_in_responsive">                                           
                                                      <button type="button" class="btn btn_for_profile_list_view min_width_hundredpresent custom-view-profile">
                                                      <img class="listiconprofilelistview" src="{{ asset('assets/app/img/listiconprofilelistview.png') }}">Add to Shortlist</button>
                                                </div>

                                       </div>

                                       
                                       <div class="d-flex justify-content-between mb-4 flex_directiom_warp_but_list_child_not_hundred_present">
                                          <div class="gender">
                                             <span>Gander:</span>
                                             <span>{{$escort->city->gender}}</span>
                                          </div>
                                          <div class="give_rating_after_get_servive">
                                          <span>{{$escort->city->name}}</span>
                                             <span class="give_rating_after_get_servive">
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                          </span>
                                          </div>
                                          <div class="available padding_top_ten_px">
                                             <span>Available:</span>
                                             <span>                                     
                                             @if($escort->available_to) 
                                                @foreach($escort->available_to as $key => $available_to)
                                                   <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}">
                                                @endforeach
                                             @endif  
                                             </span>
                                          </div>
                                          <div class="video_icon padding_top_ten_px">
                                             <a href="#">
                                             <img src="{{ asset('assets/app/img/videoiconlistviewimg.png') }}">
                                             </a>
                                          </div>
                                       </div>

                                       <div class="row mb-2 margin_lft_rgt_one_five">
                                          <div class="col-xl-3 col-md-3 col-sm-6 col-6 p-1">
                                             <div class="d-flex align-items-center manage_gap_text_img-profile">
                                                <img src="{{ asset('assets/app/img/handwithhart.png')}}">
                                                <div class="div_contain_text">
                                                   <div class="profile_message">
                                                      <h4>Massage</h4>
                                                   </div>
                                                   <div class="profile_hr">
                                                      <h4>{{ $escort->durations->pluck('pivot')->min('massage_price') }}/hr</h4>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xl-3 col-md-3 col-sm-6 col-6 p-1">
                                             <div class="d-flex align-items-center manage_gap_text_img-profile">
                                                <img src="{{ asset('assets/app/img/areodownimg.png')}}">
                                                <div class="div_contain_text">
                                                   <div class="profile_message">
                                                      <h4>Incalls</h4>
                                                   </div>
                                                   <div class="profile_hr">
                                                      <h4>{{ $escort->durations->pluck('pivot')->min('incall_price') }}/hr</h4>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xl-3 col-md-3 col-sm-6 col-6 p-1">
                                             <div class="d-flex align-items-center manage_gap_text_img-profile">
                                                <img src="{{ asset('assets/app/img/aeroupimg.png')}}">
                                                <div class="div_contain_text">
                                                   <div class="profile_message">
                                                      <h4>Outcalls</h4>
                                                   </div>
                                                   <div class="profile_hr">
                                                      <h4>{{ $escort->durations->pluck('pivot')->min('outcall_price') }}/hr</h4>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col">
                                          <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                             consequat.
                                          </p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 col-lg-4 col-sm-12">
                                 <table class="table">
                                    <thead class="table_heading_bgcolor_color">
                                       <tr>
                                          <th scope="col">Service</th>
                                          <th scope="col">Massage</th>
                                          <th scope="col">Incalls</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($escort->durations))
                                    @foreach($escort->durations as $key => $duration)
                                    <tr>
                                       <td>{{ $duration->name }}</td>
                                       <td>{!! ($duration->pivot->massage_price) ? $duration->pivot->massage_price : "<span class='if_data_not_available'>N/A</span>" !!}
                                       </td>
                                       <td>{!! ($duration->pivot->incall_price) ? $duration->pivot->incall_price : "<span class='if_data_not_available'>N/A</span>" !!}
                                       </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                    <thead class="table_heading_bgcolor_color">
                                       <tr>
                                          <th class="payment_accept_text_color" scope="col" colspan="3">Available: <span class="date_from_available">{{$escort->start_date}}</span>to<span class="date_from_available">{{$escort->end_date}}</span></th>
                                       </tr>
                                    </thead>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  @endforeach
               @break
               @case(2)
                  @foreach($members as $escort)
                     <div class="listview_each_section_border_btm">
                        <div class="manage_listview_margin_gold_section padding_20_all_side_service_provider_list_view box_shdow_service_provider_list_view">
                           <div class="row">
                              <div class="col-md-12 col-lg-8 col-sm-12">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="section_wise_level_icon_img">
                                       <img src="{{ asset('assets/app/img/profile/list.png')}}" class="img-fluid">
                                       <div class="siliver_logo_icon"><img src="{{ asset('assets/app/img/profile/image36.png')}}"></div>
                                       <div class="add_to_fab_list_view_each_sec">
                                          <span class="add_to_favrate">
                                             <i class="fa fa-heart" aria-hidden="true"></i>
                                          </span>
                                       </div>
                                       <div class="verify_image">
                                          <img src="{{ asset('assets/app/img/verifyimage.png')}}">
                                       </div>                              
                                       </div>
                                    </div>
                                    <div class="col-md-9 p-0">

                                       <div class="d-flex justify-content-between mb-3 flex_directiom_warp">
                                          <div class="free_profile_name_and_color manage_name_responsive_in_gold">{{$escort->name}}</div>
                                          <div class="age">
                                             <span class="margin_and_font_size_color_for_free manage_age_responsive_in_gold">AGE:</span><span class="free_profile_age_color_and_font">{{$escort->age}}</span>
                                          </div>

                                          <div class="add_to_shortlist_btn manage_btn_gor_gold_in_responsive">                                           
                                                      <button type="button" class="btn btn_for_profile_list_view min_width_hundredpresent">
                                                      <img class="listiconprofilelistview" src="{{ asset('assets/app/img/listiconprofilelistview.png')}}">Add to Short list</button>
                                                </div>

                                       </div>

                                       
                                       <div class="d-flex justify-content-between mb-4 flex_directiom_warp_but_list_child_not_hundred_present">
                                          <div class="gender">
                                             <span>Gander:</span>
                                             <span>{{$escort->city->gender}}</span>
                                          </div>
                                          <div class="give_rating_after_get_servive">
                                          <span>{{$escort->city->name}}</span>
                                             <span class="give_rating_after_get_servive">
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                          </span>
                                          </div>
                                          <div class="available padding_top_ten_px">
                                             <span>Available:</span>
                                             <span>                                     
                                             @if($escort->available_to)
                                             @foreach($escort->available_to as $key => $available_to)
                                             <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}">
                                             @endforeach
                                             @endif  
                                             </span>
                                          </div>
                                          <div class="video_icon padding_top_ten_px">
                                             <a href="#"><img src="{{ asset('assets/app/img/videoiconlistviewimg.png')}}"></a>
                                          </div>
                                       </div>

                                       <div class="row mb-2 margin_lft_rgt_one_five">
                                          <div class="col-xl-3 col-md-3 col-sm-6 col-6 p-1">
                                             <div class="d-flex align-items-center manage_gap_text_img-profile">
                                                <img src="{{ asset('assets/app/img/handwithhart.png')}}">
                                                <div class="div_contain_text">
                                                   <div class="profile_message">
                                                      <h4>Massage</h4>
                                                   </div>
                                                   <div class="profile_hr">
                                                      <h4>{{ $escort->durations->pluck('pivot')->min('massage_price') }}/hr</h4>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xl-3 col-md-3 col-sm-6 col-6 p-1">
                                             <div class="d-flex align-items-center manage_gap_text_img-profile">
                                                <img src="{{ asset('assets/app/img/areodownimg.png')}}">
                                                <div class="div_contain_text">
                                                   <div class="profile_message">
                                                      <h4>Incalls</h4>
                                                   </div>
                                                   <div class="profile_hr">
                                                      <h4>{{ $escort->durations->pluck('pivot')->min('incall_price') }}/hr</h4>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xl-3 col-md-3 col-sm-6 col-6 p-1">
                                             <div class="d-flex align-items-center manage_gap_text_img-profile">
                                                <img src="{{ asset('assets/app/img/aeroupimg.png')}}">
                                                <div class="div_contain_text">
                                                   <div class="profile_message">
                                                      <h4>Outcalls</h4>
                                                   </div>
                                                   <div class="profile_hr">
                                                      <h4>{{ $escort->durations->pluck('pivot')->min('outcall_price') }}/hr</h4>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col">
                                          <p class="list_view_profile_pera_font_size">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                             consequat.
                                          </p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 col-lg-4 col-sm-12">
                                 <table class="table">
                                    <thead class="table_heading_bgcolor_color">
                                       <tr>
                                          <th scope="col">Service</th>
                                          <th scope="col">Massage</th>
                                          <th scope="col">Incalls</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($escort->durations))
                                    @foreach($escort->durations as $key => $duration)
                                    <tr>
                                       <td>{{ $duration->name }}</td>
                                       <td>{!! ($duration->pivot->massage_price) ? $duration->pivot->massage_price : "<span class='if_data_not_available'>N/A</span>" !!}
                                       </td>
                                       <td>{!! ($duration->pivot->incall_price) ? $duration->pivot->incall_price : "<span class='if_data_not_available'>N/A</span>" !!}
                                       </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                    <thead class="table_heading_bgcolor_color">
                                       <tr>
                                          <th class="payment_accept_text_color" scope="col" colspan="3">Available: <span class="date_from_available">{{$escort->start_date}}</span>to<span class="date_from_available">{{$escort->end_date}}</span></th>
                                       </tr>
                                    </thead>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  @endforeach
               @break
               @case(3)
               <div class="listview_each_section_border_btm">
                  <div class="row">
                     @foreach($members as $escort)
                        <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                           <div class="manage_listview_margin_siliver_section padding_20_all_side_service_provider_list_view box_shdow_service_provider_list_view">
                              <div class="row">
                                 <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                 <div class="section_wise_level_icon_img">
                                    <img src="{{ asset('assets/app/img/profile/list.png')}}" class="img-fluid">
                                    <div class="siliver_logo_icon"><img src="{{ asset('assets/app/img/profile/image36.png')}}"></div>
                                    <div class="add_to_fab_list_view_each_sec">
                                    <span class="add_to_favrate">
                                          <i class="fa fa-heart" aria-hidden="true"></i>
                                    </span>
                                 </div>
                                 <div class="verify_image">
                                       <img src="{{ asset('assets/app/img/verifyimage.png')}}">
                                 </div>                              
                                    </div>
                                 </div>
                                 <div class="col-lg-8 col-md-12 col-sm-12 col-12 pt-1">
                                    <div class="d-flex justify-content-between">
                                       <div class="name">
                                          <h5>{{$escort->name}}</h5>
                                       </div>
                                       <div class="age"><span class="margin_and_font_size_color_for_free">AGE:</span><span class="free_profile_age_color_and_font">{{$escort->age}}</span></div>
                                       <div class="give_rating_after_get_servive">
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                       </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                       <div class="parth">
                                          <p>{{$escort->city->name}}</p>
                                       </div>
                                       <div class="age"><span>Avilable to:</span></div>
                                       <div class="free_profile_avilabletoimg_size">
                                       @if($escort->available_to)
                                       @foreach($escort->available_to as $key => $available_to)
                                       <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}">
                                       @endforeach
                                       @endif                            
                                       </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                       <div class="parth_icons">
                                          <img class="list_view_free_img_height_width" src="{{ asset('assets/app/img/handwithhart.png')}}">
                                          <img class="list_view_free_img_height_width" src="{{ asset('assets/app/img/aeroupimg.png')}}">
                                          <img class="list_view_free_img_height_width" src="{{ asset('assets/app/img/areodownimg.png')}}">
                                       </div>
                                       <div class="video_icon">
                                             <a href="#"><img src="{{ asset('assets/app/img/videoiconlistviewimg.png')}}"></a>
                                          </div>
                                    </div>
                                    <div class="mt-1">
                                       <p class="list_view_profile_pera_font_size">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                          tempor incididunt ut labore et dolore magna aliqua.
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     @endforeach
                  </div>
               </div>
               @break
               @case(4)
               <div class="manage_listview_margin_siliver_section">
                  <div class="row">  
                     @foreach($members as $escort)
                        <div class="col-md-4 col-lg-4 col-sm-12 col-12 mb-4">
                           <div class="box_shdow_service_provider_list_view freelist_view_padding">
                              <div class="d-flex freelist_view_flex_gap flex_direction_column_in_responsive" >
                                 <div><img src="{{ asset('assets/app/img/profile/dd.png')}}" class="img-fluid"></div>
                                 <div>
                                    <div class="d-flex justify-content-between">
                                       <div class="free_profile_name_and_color">{{$escort->name}}</div>
                                       <div class="age"><span class="margin_and_font_size_color_for_free">AGE:</span><span class="free_profile_age_color_and_font">{{$escort->age}}</span></div>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2">
                                       <div class="perth"><p>{{$escort->city->name}} :</p></div>
                                       <div class="parth_icons">
                                          <img class="list_view_free_img_height_width" src="{{ asset('assets/app/img/handwithhart.png')}}">
                                          <img class="list_view_free_img_height_width" src="{{ asset('assets/app/img/aeroupimg.png')}}">
                                          <img class="list_view_free_img_height_width" src="{{ asset('assets/app/img/areodownimg.png')}}">
                                       </div>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2">
                                       <div class="avilableto">avilable To:</div>
                                       <div class="free_profile_avilabletoimg_size d-flex align-items-center">
                                       @if($escort->available_to)
                                       @foreach($escort->available_to as $key => $available_to)
                                       <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}">
                                       @endforeach
                                       @endif                           
                                       </div>
                                    </div>
                                    <p class="list_view_profile_pera_font_size pt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                       tempor
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     @endforeach
                  </div>
               </div>
               @default
                  <div class="row responsive_colums_in_lg_nine_col">
                  </div>
            @endswitch
         @endforeach
      
         {!! $escorts->links() !!}
      </div>
   </section>
<!-- ================       service provider end here        ========================= -->
<!-- ==============        pagination start here            ====================-->
   <section class="padding_ninty_btm_ninty_px">
      <!--<div class="container">
         <div class="space_between_row">
            <nav aria-label="Page navigation example">
               <ul class="pagination justify-content-center">
                  <li class="page-item change_pagination_style">
                     <a class="page-link" href="#" aria-label="Previous">
                     <span aria-hidden="true">&laquo;</span>
                     <span class="sr-only">Previous</span>
                     </a>
                  </li>
                  <li class="page-item change_pagination_style"><a class="page-link" href="#">1</a></li>
                  <li class="page-item change_pagination_style"><a class="page-link" href="#">2</a></li>
                  <li class="page-item change_pagination_style"><a class="page-link" href="#">3</a></li>
                  <li class="page-item change_pagination_style">
                     <a class="page-link" href="#" aria-label="Next">
                     <span aria-hidden="true">&raquo;</span>
                     <span class="sr-only">Next</span>
                     </a>
                  </li>
               </ul>
            </nav>
         </div>
         </div>-->
   </section>
<!-- =============       pagination end here            ====================-->
@endsection
@push('scripts')
<script>
    var skipSliderage = document.getElementById("skipstepage");
    var skipValuesage = [
    document.getElementById("skip-value-lower-age"),
    document.getElementById("skip-value-upper-age")
    ];
    
    noUiSlider.create(skipSliderage, {
    start: [0, 30],
    connect: true,
    behaviour: "drag",
    step: 1,
    range: {
       min: 18,
       max: 60
    },
    format: {
       from: function (value) {
          return parseInt(value);
       },
       to: function (value) {
          return parseInt(value);
       }
    }
    });
    
    skipSliderage.noUiSlider.on("update", function (values, handle) {
    skipValuesage[handle].innerHTML = values[handle];
    });
    
</script>
<script>
    var skipSlider = document.getElementById("skipstep");
    var skipValues = [
    document.getElementById("skip-value-lower"),
    document.getElementById("skip-value-upper")
    ];
    
    noUiSlider.create(skipSlider, {
    start: [0, 200],
    connect: true,
    behaviour: "drag",
    step: 1,
    range: {
       min: 150,
       max: 300
    },
    format: {
       from: function (value) {
          return parseInt(value);
       },
       to: function (value) {
          return parseInt(value);
       }
    }
    });
    
    skipSlider.noUiSlider.on("update", function (values, handle) {
    skipValues[handle].innerHTML = values[handle];
    });
    
</script>
@endpush