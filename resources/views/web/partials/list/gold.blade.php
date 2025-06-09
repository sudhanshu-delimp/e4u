<div class="listview_each_section_border_btm silver-sec brb--listing">
    <div
        class="manage_listview_margin_gold_section padding_20_all_side_service_provider_list_view box_shdow_service_provider_list_view gold_list_frame">
        <div class="row plat_num_row">
            <div class="col-md-12 col-lg-8 col-xl-8 col-sm-12 pr-3 pr-lg-0 self-w-73">
                <div class="row plat-inner  mr-0 ml-0">
                    <div class="col-md-4 featured-pic pl-0">

                        <div class="section_wise_level_icon_img all-escort-profile-pic">
                            <a href="{{ route('profile.description', [$escort->id,$escort->city_id]) }}?list">
                                @if ($escort->latestActiveBrb)
                                    <div class="brb--content">
                                        <div class="brb--wrappr">
                                            <span class="brb-text">BRB</span> at <span
                                                class="brb-time">{{ date('h:i A', strtotime($escort->latestActiveBrb->brb_time)) }}</span>
                                            <span
                                                class="brb-date">{{ date('d-m-Y', strtotime($escort->latestActiveBrb->brb_time)) }}</span>
                                        </div>
                                    </div>
                                @endif
                                <img src="{{ $escort->default_image ? $escort->default_image : asset('assets/app/img/service-provider/Frame-408.png') }}"
                                    class="img-fluid" title="View Profile">
                            </a>
                            <div class="siliver_logo_icon"><img src="{{ asset('assets/app/img/img_gold.png') }}"></div>
                            <div class="add_to_fab_list_view_each_sec">
                                @if (auth()->user())
                                    @if (auth()->user()->type == 0)
                                        <span
                                            class="add_to_favrate custom--favourite @if (in_array($escort->id, $user_type->myLegBox->pluck('id')->toArray())) {{ 'null' }}@else{{ 'fill' }} @endif legboxClass_{{ $escort->id }}"
                                            id="legboxId_{{ $escort->id }}" data-escortId="{{ $escort->id }}"
                                            data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}"
                                            data-name="{{ $escort->name }}">
                                            @if (!empty($user_type))
                                                @if (in_array($escort->id, $user_type->myLegBox->pluck('id')->toArray()))
                                                    <i class='fa fa-heart' style='color: #ff3c5f;'
                                                        aria-hidden='true'></i>
                                                    <span class="custom-heart-text">Remove from My Legbox</span>
                                                @else
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                    <span class="custom-heart-text">Add to My Legbox</span>
                                                @endif
                                            @endif
                                        </span>
                                    @else
                                        <span class="add_to_favrate custom--favourite" data-name="{{ $escort->name }}"><i
                                                class="fa fa-heart-o" aria-hidden="true"></i> <span class="custom-heart-text">Add to My Legbox</span></span>
                                    @endif
                                @else
                                    {{-- <span class="add_to_favrate" data-escortId="{{ $escort->id }}"
                                        data-name="{{ $escort->name }}"><i class="fa fa-heart-o" aria-hidden="true"
                                            title="Add to Legbox"></i></span> --}}
                                        <span class="add_to_favrate custom--favourite" data-escortId="{{$escort->id}}" data-name="{{$escort->name}}"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="custom-heart-text">Add to My Legbox</span></span>
                                @endif
                            </div>
                            <div class="verify_image verify-image-custom">
                                <img src="{{ asset('assets/app/img/verifyimage.png') }}">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8 p-0 gold-seven all-escort-view-profile-box">
                        <div class="d-flex justify-content-between mb-4 sm-my-2 gold-profile-details-custom">
                            <div class="free_profile_name_and_color">{{ $escort->name }}</div>
                            <div class="age" style="margin-top: 5px;display: flex;gap: 8px;">
                                <span class="margin_and_font_size_color_for_free">AGE:</span><span
                                    class="free_profile_age_color_and_font">{{ $escort->age }}</span>
                               
                            </div>
                            <div class="add_to_short_list_btn_custom">
                            @if (Request::path() == 'showList')
                                <button type="button"
                                    class="btn btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn removeshortlist"
                                    data-name="{{ $escort->name }}" data-escortId="{{ $escort->id }}">
                                    Remove from Shortlist</button>
                            @else
                                {{-- <button type="button" class="btn custom-sort-filter btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn shortlist" data-escortId="{{$escort->id}}">
                                <img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_view.png') }}">Add to shortlist</button> --}}
                                <button type="button"
                                    class="btn custom-sort-filter btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn shortlist myescort_{{ $escort->id }}"
                                    id="escort_{{ $escort->id }}" data-name="{{ $escort->name }}"
                                    data-escortId="{{ $escort->id }}"
                                    data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}"><img
                                        class="listiconprofilelistview"
                                        src="{{ asset('assets/app/img/filter_view.png') }}">
                                    @if (!empty($escortId))
                                        @if (in_array($escort->id, $escortId))
                                            Remove from Shortlist
                                        @else
                                            Add to Shortlist
                                        @endif
                                    @else
                                        Add to Shortlist
                                    @endif
                                </button>
                            @endif
                        </div>
                                </div>
                        <div class="d-flex justify-content-between mb-4 flex_warp list_gender_area  pr-0">
                            <div class="gender">
                                <span class="filter-pad">Gender:</span>
                                <span>{{ $escort->gender ? $escort->gender : '' }}</span>
                            </div>
                            <div class="perth">
                                <span class="filter-pad"><span class="profile_location_icon"><i class="fa fa-map-marker" aria-hidden="true" style="font-size: 15px;"></i></span> {{ $escort->city ? $escort->city->name : '' }}</span>
                                <span class="give_rating_after_get_servive">
                                    @for($i=1; $i<= 5; $i++)
                                        @if($escort->star_rating && $escort->star_rating > 0 && $i <= $escort->star_rating)
                                            <i class="fa fa-star" aria-hidden="true" ></i>
                                        @else
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endif
                                    @endfor
                                    {{-- <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i> --}}
                                </span>
                            </div>
                            <div class="free_profile_avilabletoimg_size">
                                <span class="filter-pad">Available:</span>
                                <span>
                                    @if ($escort->available_to)
                                        @foreach ($escort->available_to as $key => $available_to)
                                            {{-- <img
                                                src="{{ config('escorts.profile.available-to-images')[$available_to] }}"> --}}
                                                <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}" title="{{ config('escorts.profile.available-to')[$available_to] }}">
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                            <div class="d-inline video_icon">
                                    <a href="#">
                                        <img src="{{ asset('assets/app/img/video_play.svg') }}">
                                    </a>
                                </div>

                        </div>
                        
                        <div class="icon-lis-col gold-view-escort-list">
                                <div class=" manage_gap_text_img-profile gold-type-icon-text p-1">
                                    <img src="{{ asset('assets/app/img/handwithhart.png') }}">
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Massage</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>
                                                {{ $escort->durations()->where('name', '1 Hour')->first() ? $escort->durations()->where('name', '1 Hour')->first()->pivot->massage_price : '' }}
                                                /hr</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class=" manage_gap_text_img-profile gold-type-icon-text p-1">
                                    <img src="{{ asset('assets/app/img/areodownimg.png') }}">
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Incalls</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>
                                                {{ $escort->durations()->where('name', '1 Hour')->first() ? $escort->durations()->where('name', '1 Hour')->first()->pivot->incall_price : '' }}
                                                /hr</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class=" manage_gap_text_img-profile gold-type-icon-text p-1">
                                    <img src="{{ asset('assets/app/img/aeroupimg.png') }}">
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Outcalls</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>
                                                {{ $escort->durations()->where('name', '1 Hour')->first() ? $escort->durations()->where('name', '1 Hour')->first()->pivot->outcall_price : '' }}
                                                /hr</h4>
                                        </div>
                                    </div>
                                </div> 
                        </div>
                        <div class="col pl-0 pr-1">
                            <p class="list_view_profile_pera_font_size">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi
                            </p>
                        </div>
                        <div class="col pl-0 pr-1 all-escort-view-profile-btn">
                        <a href="{{ route('profile.description', $escort->id) }}"
                                    class="btn btn_for_profile_list_view">View Profile</a>
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
                        @if (!empty($escort->durations))
                            @foreach ($escort->durations as $key => $duration)
                                <tr>
                                    <td>{{ $duration->name }}</td>
                                    <td>{!! $duration->pivot->massage_price
                                        ? $duration->pivot->massage_price
                                        : "<span class='if_data_not_available'>N/A</span>" !!}
                                    </td>
                                    <td>{!! $duration->pivot->incall_price
                                        ? $duration->pivot->incall_price
                                        : "<span class='if_data_not_available'>N/A</span>" !!}
                                    </td>
                                </tr>
                                @if ($loop->index == 3)
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                    <thead class="table_heading_bgcolor_color">
                        <tr>
                            <th class="payment_accept_text_color" scope="col" colspan="3">Available: <span
                                    class="date_from_available">{{ date('d-m-Y', strtotime($escort->start_date)) }}</span>
                                to <span
                                    class="date_from_available">{{ date('d-m-Y', strtotime($escort->end_date)) }}</span>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
