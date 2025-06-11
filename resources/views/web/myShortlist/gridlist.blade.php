<div class="listview_each_section_border_btm">
    <div class="manage_listview_margin_gold_section padding_20_all_side_service_provider_list_view box_shdow_service_provider_list_view gold_list_frame">
        <div class="row plat_num_row">
            <div class="col-md-12 col-lg-8 col-xl-8 col-sm-12 pr-3 pr-lg-0 self-w-73">
                <div class="row plat-inner mr-0 ml-0">
                    <div class="col-md-4 pl-0">
                        <a href="{{ route('profile.description',$escort->id)}}?list">
                            <div class="section_wise_level_icon_img">
                                <img src="{{ $escort->default_image ? $escort->default_image : asset('assets/app/img/service-provider/Frame-408.png') }}" class="img-fluid height_for_platinum">

                                <div class="verify_image">
                                    <img src="{{ asset('assets/app/img/verifyimage.png')}}">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-8 p-0">
                        <div class="d-flex justify-content-between mb-3 flex_directiom_warp list_cruise pr-0">
                            <div class="free_profile_name_and_color profile-text">{{$escort->name}}</div>
                            <div class="age" style="text-align: end;">
                                <span class="margin_and_font_size_color_for_free manage_age_responsive_in_gold">AGE:</span><span class="free_profile_age_color_and_font">{{$escort->age}}</span>
                            </div>
                            <div class="add_to_shortlist_btn manage_btn_gor_gold_in_responsive">

                                <button type="button" class="btn btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn removeshortlist"  data-name="{{$escort->name}}"  data-escortId="{{$escort->id}}"><img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_btn.svg') }}">
                                    Remove from Shortlist</button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-4 flex_directiom_warp_but_list_child_not_hundred_present list_gender_area  pr-0">
                            <div class="gender">
                                <span class="filter-pad">Gender:</span>
                                <span>{{$escort->gender ? $escort->gender : ''}}</span>
                            </div>
                            <div class="give_rating_after_get_servive">
                                <span class="filter-pad">{{$escort->city ? $escort->city->name : ''}}</span>
                                <span class="give_rating_after_get_servive">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="available padding_top_ten_px custom-gender-type-icon">
                                <span class="filter-pad">Available:</span>
                                <span>
                                    @if($escort->available_to)
                                    @foreach($escort->available_to as $key => $available_to)
                                        <div class="icon-with-tooltip position-relative">
                                            <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}">                                        
                                            <span class="custom-icon-hover-tooltip">
                                            {{ config('escorts.profile.available-to')[$available_to] }}
                                            </span>                                        
                                        </div>
                                    @endforeach
                                    @endif
                                </span>
                            </div>
                            <div class="video_icon padding_top_ten_px">
                                <a href="#">
                                <img src="{{ asset('assets/app/img/video_play.svg') }}">
                                </a>
                            </div>
                        </div>
                        <div class="row mb-2 margin_lft_rgt_one_five  pr-0">
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
            <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 self-w-26">
                <table class="table table-striped">
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
                            <td>{{ $duration->name }} </td>
                            <td>{!! ($duration->pivot->massage_price) ? $duration->pivot->massage_price : "<span class='if_data_not_available'>N/A</span>" !!}
                            </td>
                            <td>{!! ($duration->pivot->incall_price) ? $duration->pivot->incall_price : "<span class='if_data_not_available'>N/A</span>" !!}
                            </td>
                        </tr>
                        @if($loop->index == 5)
                            @break
                        @endif

                        @endforeach
                        @endif
                    </tbody>
                    <thead class="table_heading_bgcolor_color">
                        <tr>
                            <th class="payment_accept_text_color" scope="col" colspan="3">Available: <span class="date_from_available">{{ date('d-m-Y',strtotime($escort->start_date))}}</span>   to   <span class="date_from_available">{{date('d-m-Y',strtotime($escort->end_date))}}</span></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
