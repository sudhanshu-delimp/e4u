<div class="col-md-6 col-lg-6 col-sm-6 col-12 px-md-2 brb--listing silver-brb">
    <div
        class="manage_listview_margin_siliver_section padding_20_all_side_service_provider_list_view box_shdow_service_provider_list_view silver_listbx">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                
                    <div class="section_wise_level_icon_img">
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
                            class="img-fluid height_for_siliver" title="View Profile">
                        <div class="siliver_logo_icon"><img src="{{ asset('assets/app/img/img_silver.png') }}"></div>
                        </a>
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
                                                <i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i>
                                                <span class="custom-heart-text">Remove from My Legbox</span>
                                            @else
                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                <span class="custom-heart-text">Add to My Legbox</span>
                                            @endif
                                        @endif
                                    </span>
                                @else
                                    <span class="add_to_favrate custom--favourite" data-name="{{ $escort->name }}"><i
                                            class="fa fa-heart-o" aria-hidden="true"></i><span class="custom-heart-text">Add to My Legbox</span></span>
                                @endif
                            @else
                                {{-- <span class="add_to_favrate" data-escortId="{{ $escort->id }}"
                                    data-name="{{ $escort->name }}"><i class="fa fa-heart-o" aria-hidden="true"
                                        title="Add to Legbox"></i></span> --}}
                                <span class="add_to_favrate custom--favourite" data-escortId="{{$escort->id}}" data-name="{{$escort->name}}"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="custom-heart-text">Remove from My Legbox</span></span>
                            @endif
                        </div>
                        <div class="verify_image">
                            <img src="{{ asset('assets/app/img/verifyimage.png') }}">
                        </div>
                    </div>
                
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 col-12 pt-1">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h5 class="list_view_sil_and_free_name">{{ $escort->name }}</h5>
                    </div>
                    <div class="age"><span class="margin_and_font_size_color_for_free">AGE:</span><span
                            class="free_profile_age_color_and_font">{{ $escort->age }}</span></div>
                    <div class="give_rating_after_get_servive">
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
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="parth">
                        <p><span class="profile_location_icon"><i class="fa fa-map-marker" aria-hidden="true" style="font-size: 15px;"></i></span> {{ $escort->city ? $escort->city->name : '' }}</p>
                    </div>
                    <div class="age"><span>Avilable to:</span></div>
                    <div class="free_profile_avilabletoimg_size custom-gender-type-icon">
                        @if ($escort->available_to)
                            @foreach ($escort->available_to as $key => $available_to)
                                {{-- <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}"> --}}
                                
                                <div class="icon-with-tooltip position-relative">
                                    <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}">
                            
                                    <span class="custom-icon-hover-tooltip">
                                    {{ config('escorts.profile.available-to')[$available_to] }}
                                    </span>
                                    
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-between custom-available-time-icon">
                    <div class="parth_icons position-relative">
                        <div class="icon-with-tooltip position-relative">
                            <img class="list_view_free_img_height_width"
                                src="{{ asset('assets/app/img/handwithhart.png') }}">
                            <span class="custom-icon-hover-tooltip">Massage</span>
                        </div>
                        <div class="icon-with-tooltip position-relative">
                            <img class="list_view_free_img_height_width" src="{{ asset('assets/app/img/aeroupimg.png') }}">
                            <span class="custom-icon-hover-tooltip"> Outcalls</span>
                        </div>
                        <div class="icon-with-tooltip position-relative">
                            <img class="list_view_free_img_height_width"
                            src="{{ asset('assets/app/img/areodownimg.png') }}">
                            <span class="custom-icon-hover-tooltip">Incalls</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button"
                            class="btn btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn shortlist myescort_34 peach--text"
                            style="padding: 0;font-size: 12px;height: 30px;padding-right: 5px;"><img
                                class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_view.png') }}">Add
                            to Shortlist</button>
                    </div>
                    <div class="video_icon">
                        <a href="#"><img src="{{ asset('assets/app/img/video_play.svg') }}"></a>
                    </div>
                </div>
                <div class="mt-1"> 
                    <p class="list_view_profile_pera_font_size">Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
                
            </div>
        </div>
    </div>
</div>
