@php
    $escortName = ($escort->gender == 'Transgender')? 'TS-' . $escort->name : $escort->name;
@endphp

<div class="listview_each_section_border_btm silver-sec brb--listing">
    <div class="manage_listview_margin_gold_section padding_20_all_side_service_provider_list_view box_shdow_service_provider_list_view list_provide_cruise plat_list_frame">
        <div class="row plat_num_row">
            <div class="col-md-12 col-lg-8 col-xl-8 col-sm-12 self-w-73">
                <div class="row plat-inner mr-0 ml-0">
                    <div class="col-md-4 pl-0">
                        
                            <div class="section_wise_level_icon_img all-escort-profile-pic">
                            <a href="{{ route('profile.description',[$escort->id,$escort->city_id])}}?list">
                            @if($escort->latestActiveBrb)
                            <div class="brb--content">
                                <div class="brb--wrappr">
                                    <span class="brb-text">BRB</span> at <span class="brb-time">{{date('h:i A',strtotime($escort->latestActiveBrb->selected_time))}}</span> <span class="brb-date">{{date('d-m-Y',strtotime($escort->latestActiveBrb->selected_time))}}</span>
                                </div>
                            </div>
                            @endif
                                <img src="{{ $escort->default_image ? $escort->default_image : asset('assets/app/img/service-provider/Frame-408.png') }}" class="img-fluid" title="View Profile">
                            </a>
                            <div class="siliver_logo_icon"><img src="{{ asset('images/platinum_membership.png')}}"></div>
                                <div class="add_to_fab_list_view_each_sec">
                                    @if(auth()->user())
                                        @if(auth()->user()->type == 0)
                                        <span class="add_to_favrate custom--favourite @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray())){{'null'}}@else{{'fill'}}@endif legboxClass_{{$escort->id}}" id="legboxId_{{$escort->id}}"  data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}" data-name="{{$escortName}}">
                                            @if(!empty($user_type))
                                                @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray()))
                                                    <i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i>
                                                    <span class="custom-heart-text list-tool remove-tool">Remove from My Legbox</span>
                                                @else
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                    <span class="custom-heart-text list-tool">Add to My Legbox</span>
                                                @endif
                                            @endif
                                        </span>
                                        @else
                                        <span class="add_to_favrate custom--favourite" data-name="{{$escortName}}"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="custom-heart-text list-tool">Add to My Legbox </span></span>
                                        @endif
                                    @else
                                    {{-- <span class="add_to_favrate"  data-escortId="{{$escort->id}}" data-name="{{$escortName}}"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i></span> --}}
                                    <span class="add_to_favrate custom--favourite" data-escortId="{{$escort->id}}" data-name="{{$escortName}}"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="custom-heart-text list-tool">Add to My Legbox</span></span>
                                    @endif
                                </div>
                                <div class="verify-image-custom">
                                    <img src="{{ asset('assets/app/img/verify/unverified_light.png')}}">
                                </div>
                            </div>
                        {{-- </a> --}}
                    </div>
                    <div class="col-md-8 p-0 all-escort-view-profile-box">
                        <div class="mb-3 list_cruise pr-0 platinum-escort-list-view-custom">
                            <div class="list_view_pla_name manage_name_responsive_in_gold">{{$escortName}}</div>
                            <div class="age" style="margin-top: 13px;">
                                <span class="margin_and_font_size_color_for_free manage_age_responsive_in_gold">AGE:</span><span class="free_profile_age_color_and_font">{{$escort->age}}</span>
                            </div>
                            <div class="add_to_shortlist_btn manage_btn_gor_gold_in_responsive">
                                @if(Request::path() == "showList")
                                <button type="button" class="btn btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn removeshortlist custom-sort-filter"  data-name="{{$escortName}}"  data-escortId="{{$escort->id}}"><img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_view.png') }}">
                                Remove from Shortlist</button>
                                @else


                                <button type="button" class="btn custom-sort-filter btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn shortlist myescort_{{$escort->id}}" id="escort_{{$escort->id}}" data-name="{{$escortName}}" data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}"><img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_view.png') }}">
                                    @if(!empty($escortId))
                                         @if(in_array($escort->id,$escortId))
                                        Remove from Shortlist
                                        @else
                                        Add to Shortlist
                                        @endif
                                    @else
                                        Add to Shortlist
                                    @endif
                                    </img>
                                </button>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-4 flex_directiom_warp_but_list_child_not_hundred_present list_gender_area  pr-0">
                            <div class="custom--gender--area">
                                <div class="gender">
                                    <span class="filter-pad">Gender:</span>
                                    <span>{{$escort->gender ? $escort->gender : ''}}</span>
                                </div>
                                <div class="give_rating_after_get_servive">
                                    <span class="filter-pad">Location:</span><span> {{$escort->city ? $escort->city->name : ''}}</span>
                                </div>
                                <div class="give_rating_after_get_servive">
                                    <span class="filter-pad">Rating:</span>
                                    <span class="give_rating_after_get_servive">
                                    @for($i=1; $i<= 5; $i++)
                                        @if($escort->star_rating && $escort->star_rating > 0 && $i <= $escort->star_rating)
                                            <i class="fa fa-star" aria-hidden="true" ></i>
                                        @else
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endif
                                    @endfor
                                    </span>
                                </div>
                            </div>
                            <div class="custom--available-section">
                                <div class="available custom-gender-type-icon">
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

                                 @if($escort->escort_videos->count()>0)
                                <div class="video_icon">
                                    <a href="#">
                                    <img src="{{ asset('assets/app/img/video_play.svg') }}">
                                    <span class="custom--tooltip">Escort has video to view</span>
                                    </a>
                                </div>
                                @endif

                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 custom-rate-type">
                                <div class="d-flex align-items-center manage_gap_text_img-profile">
                                    <img src="{{ asset('assets/app/img/handwithhart.png')}}">
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Massage</h4>
                                        </div>
                                        <div class="profile_hr">
                                        <h4>
                                        @php  
                                        $massage_price = $escort->durations()->where('name', '1 Hour')->first()? $escort->durations()->where('name','1 Hour')->first()->pivot->massage_price:0;
                                        @endphp
                                        {{ $massage_price ? '$'. number_format($massage_price).'/hr' : 'N/A' }}
                                        </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center manage_gap_text_img-profile">
                                    <img src="{{ asset('assets/app/img/areodownimg.png')}}">
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Incalls</h4>
                                        </div>
                                        <div class="profile_hr">
                                        <h4>
                                            @php  
                                            $incall_price = $escort->durations()->where('name', '1 Hour')->first()? $escort->durations()->where('name','1 Hour')->first()->pivot->incall_price:0;
                                            @endphp
                                            {{ $incall_price ? '$'. number_format($incall_price).'/hr' : 'N/A' }}
                                        </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center manage_gap_text_img-profile">
                                    <img src="{{ asset('assets/app/img/aeroupimg.png')}}">
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Outcalls</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>
                                            @php  
                                            $outcall_price = $escort->durations()->where('name', '1 Hour')->first()? $escort->durations()->where('name','1 Hour')->first()->pivot->outcall_price:0;
                                            @endphp
                                            {{ $outcall_price ? '$'. number_format($outcall_price).'/hr' : 'N/A' }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $plainTextAbout = strip_tags($escort->about);
                            $limitText = Str::limit($plainTextAbout, 210, '...');
                        @endphp
                        <div class="col pr-1">
                            <p class="list_view_profile_pera_font_size">{!! $limitText !!}
                                @if(strlen($plainTextAbout) > 210)
                                    <a href="{{ route('profile.description', $escort->id) }}?list&brb={{isset($escort->latestActiveBrb->id) ? $escort->latestActiveBrb->id : ''}}" class="h6 text-danger">Read More</a>
                            @endif
                            </p>
                        </div>
                        <div class="col pr-1 all-escort-view-profile-btn">
                            {{-- social-media icon --}}
                            <div class="social_media_icons">                               
                               <div class="social_media_wrapper">
                                    <div class="s_icon ec_playbox_icon">
                                        <a href="{{ url('playbox') }}" target="_blank"><img src="{{ asset('assets/app/img/MyPlaybox.png') }}" alt="logo"></a>
                                        <div class="custom-tooltip">I don't have any Playbox.</div>
                                    </div> 
                                    <div class="d-flex justify-content-between gap-10">
                                        @if(!empty($escort->user->profile_creator) && in_array(3,$escort->user->profile_creator))
                                            @if($escort->user->social_links && $escort->user->social_links['facebook'] !== null)
                                                <div class="s_icon">
                                                    <a href="{{ ($escort->user->social_links && $escort->user->social_links['facebook'] != '') ? $escort->user->social_links['facebook'] : 'https://www.facebook.com/' }}" target="_blank"><img src="{{ asset('assets/app/img/facebook.png') }}" alt="logo"></a>
                                                </div>
                                            @endif
                                            @if($escort->user->social_links && $escort->user->social_links['insta'] !== null)
                                                <div class="s_icon">
                                                        <a href="{{ ($escort->user->social_links && $escort->user->social_links['insta'] != '') ? $escort->user->social_links['insta'] : 'https://www.instagram.com/' }}" target="_blank"><img src="{{ asset('assets/app/img/instagram.png') }}" alt="logo"></a>
                                                </div>
                                            @endif
                                            @if($escort->user->social_links && $escort->user->social_links['twitter'] !== null)
                                                <div class="s_icon">
                                                    <a href="{{ ($escort->user->social_links && $escort->user->social_links['twitter'] != '') ? $escort->user->social_links['twitter'] : 'https://x.com/' }}" target="_blank"><img src="{{ asset('assets/app/img/twitter-x.png') }}" alt="logo"></a>
                                                </div>
                                            @else
                                            <div class="s_icon">
                                                <a href="https://x.com/NMugs32853" target="_blank"><img src="{{ asset('assets/app/img/twitter-x.png') }}" alt="logo"></a>
                                            </div> 
                                            
                                            @endif    
                                        @else
                                            <div class="s_icon">
                                                <a href="https://x.com/NMugs32853" target="_blank"><img src="{{ asset('assets/app/img/twitter-x.png') }}" alt="logo"></a>
                                            </div>                                     
                                        @endif
                                    </div>
                                   
                                </div>
                            </div>
                            <a  href="{{ route('profile.description',$escort->id)}}?list&brb={{isset($escort->latestActiveBrb->id) ? $escort->latestActiveBrb->id : ''}}" class="btn btn_for_profile_list_view min_width_hundredpresent custom-view-profile" style="float: right;">View Profile</a>
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
                            <td>{!! ($duration->pivot->massage_price) ? "<div class='public-num-value-table'> <span>$ </span>" . $duration->pivot->massage_price . "</div>" : "<span class='if_data_not_available'>N/A</span>" !!}
                            </td>
                            <td>{!! ($duration->pivot->incall_price) ? "<div class='public-num-value-table'> <span>$ </span>" . $duration->pivot->incall_price . "</div>" : "<span class='if_data_not_available'>N/A</span>" !!}
                            </td>
                        </tr>
                        @if($loop->index == 5)
                            @break
                        @endif

                        @endforeach
                        @endif
                    </tbody>
                    <thead class="table_heading_bgcolor_color available_footer">
                        <tr>
                            <th class="payment_accept_text_color" scope="col" colspan="3">Available: <span class="date_from_available">{{ date('d-m-Y',strtotime($escort->start_date))}}</span>   to   <span class="date_from_available">{{date('d-m-Y',strtotime($escort->end_date))}}</span></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
