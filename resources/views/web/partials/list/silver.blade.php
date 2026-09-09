 @php
     $escortName = $escort->gender == 'Transgender' ? 'TS-' . $escort->name : $escort->name;
 @endphp




 <div class="listview_each_section_border_btm silver-sec brb--listing">
     <div
         class="manage_listview_margin_gold_section plat_list_frame">

         <div class="row">
             <div class="col-lg-12">
                 <div class="EC__list_card">
                     {{-- 1st --}}
                     <div class="section_wise_level_icon_img all-escort-profile-pic">
                         <a href="{{ route('profile.description', [$escort->id, $escort->city_id]) }}?list">
                             @if ($escort->latestActiveBrb)
                                 <div class="brb--content">
                                     <div class="brb--wrappr">
                                         <span class="brb-text">BRB</span> at <span
                                             class="brb-time">{{ date('h:i A', strtotime($escort->latestActiveBrb->selected_time)) }}</span>
                                         <span
                                             class="brb-date">{{ date('d-m-Y', strtotime($escort->latestActiveBrb->selected_time)) }}</span>
                                     </div>
                                 </div>
                             @endif
                             <img src="{{ $escort->default_image ? $escort->default_image : asset('assets/app/img/service-provider/Frame-408.png') }}"
                                 class="img-fluid height_for_siliver" title="View Profile">

                         </a>
                         <div class="siliver_logo_icon"><img src="{{ asset('images/silver_membership.png') }}"></div>
                         <div class="add_to_fab_list_view_each_sec">
                             @if (auth()->user())
                                 @if (auth()->user()->type == 0)
                                     <span
                                         class="add_to_favrate custom--favourite @if (in_array($escort->id, $user_type->myLegBox->pluck('id')->toArray())) {{ 'null' }}@else{{ 'fill' }} @endif legboxClass_{{ $escort->id }}"
                                         id="legboxId_{{ $escort->id }}" data-escortId="{{ $escort->id }}"
                                         data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}"
                                         data-name="{{ $escortName }}">
                                         @if (!empty($user_type))
                                             @if (in_array($escort->id, $user_type->myLegBox->pluck('id')->toArray()))
                                                 <i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i>
                                                 <span class="custom-heart-text list-tool remove-tool">Remove from My
                                                     Legbox</span>
                                             @else
                                                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                 <span class="custom-heart-text list-tool">Add to My Legbox</span>
                                             @endif
                                         @endif
                                     </span>
                                 @else
                                     <span class="add_to_favrate custom--favourite" data-name="{{ $escortName }}"><i
                                             class="fa fa-heart-o" aria-hidden="true"></i><span
                                             class="custom-heart-text list-tool">Add to My Legbox </span></span>
                                 @endif
                             @else
                                 {{-- <span class="add_to_favrate"  data-escortId="{{$escort->id}}" data-name="{{$escortName}}"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i></span> --}}
                                 <span class="add_to_favrate custom--favourite" data-escortId="{{ $escort->id }}"
                                     data-name="{{ $escortName }}"><i class="fa fa-heart-o"
                                         aria-hidden="true"></i><span class="custom-heart-text list-tool">Add to My
                                         Legbox</span></span>
                             @endif
                         </div>
                         @if ($escort->default_image)
                             <div class="verify-image-custom">
                                 @php
                                     $media_verification_status = get_profile_verification_status($escort->id);
                                     $media_status = getMediaVerificationDataBigIcon($media_verification_status ?? 0);
                                 @endphp
                                 <img src="{{ $media_status['icon'] }}">
                                 <span class="common_shield_tooltip">{{ $media_status['label'] }}</span>
                             </div>
                         @endif
                     </div>
                     {{-- end --}}

                     {{-- 2nd --}}
                     <div class="gold-seven all-escort-view-profile-box">
                         <div class="list_cruise platinum-escort-list-view-custom">
                             <div class="list_view_pla_name manage_name_responsive_in_gold">{{ $escortName }}</div>
                             <div class="age" style="margin-top: 13px;">
                                 <span
                                     class="margin_and_font_size_color_for_free manage_age_responsive_in_gold">AGE:</span><span
                                     class="free_profile_age_color_and_font">{{ $escort->age }}</span>
                             </div>
                             <div class="add_to_shortlist_btn manage_btn_gor_gold_in_responsive">
                                 @if (Request::path() == 'showList')
                                     <button type="button"
                                         class="btn btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn removeshortlist custom-sort-filter"
                                         data-name="{{ $escortName }}" data-escortId="{{ $escort->id }}">
                                         <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.75 3.25H8.24999C7.52064 3.25 6.82117 3.53973 6.30545 4.05546C5.78972 4.57118 5.49999 5.27065 5.49999 6V20C5.49898 20.1377 5.53587 20.2729 5.60662 20.391C5.67738 20.5091 5.77926 20.6054 5.90112 20.6695C6.02298 20.7335 6.16012 20.7627 6.2975 20.754C6.43488 20.7453 6.56721 20.6989 6.67999 20.62L12 16.91L17.32 20.62C17.4467 20.7063 17.5967 20.7516 17.75 20.75C17.871 20.7486 17.9903 20.7213 18.1 20.67C18.2203 20.6041 18.3208 20.5072 18.3911 20.3894C18.4615 20.2716 18.499 20.1372 18.5 20V6C18.5 5.27065 18.2103 4.57118 17.6945 4.05546C17.1788 3.53973 16.4793 3.25 15.75 3.25Z" fill="#ffffff"></path> </g></svg>
                                         Remove from Shortlist</button>
                                 @else
                                     <button type="button"
                                         class="btn custom-sort-filter btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn shortlist myescort_{{ $escort->id }}"
                                         id="escort_{{ $escort->id }}" data-name="{{ $escortName }}"
                                         data-escortId="{{ $escort->id }}"
                                         data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
                                         <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M17.75 20.75C17.5974 20.747 17.4487 20.702 17.32 20.62L12 16.91L6.68 20.62C6.56249 20.6915 6.42757 20.7294 6.29 20.7294C6.15243 20.7294 6.01751 20.6915 5.9 20.62C5.78491 20.5607 5.68741 20.4722 5.61722 20.3634C5.54703 20.2546 5.50661 20.1293 5.5 20V6C5.5 5.27065 5.78973 4.57118 6.30546 4.05546C6.82118 3.53973 7.52065 3.25 8.25 3.25H15.75C16.4793 3.25 17.1788 3.53973 17.6945 4.05546C18.2103 4.57118 18.5 5.27065 18.5 6V20C18.5005 20.1362 18.4634 20.2698 18.3929 20.3863C18.3223 20.5027 18.2209 20.5974 18.1 20.66C17.9927 20.7189 17.8724 20.7498 17.75 20.75ZM12 15.25C12.1532 15.2484 12.3033 15.2938 12.43 15.38L17 18.56V6C17 5.66848 16.8683 5.35054 16.6339 5.11612C16.3995 4.8817 16.0815 4.75 15.75 4.75H8.25C7.91848 4.75 7.60054 4.8817 7.36612 5.11612C7.1317 5.35054 7 5.66848 7 6V18.56L11.57 15.38C11.6967 15.2938 11.8468 15.2484 12 15.25Z" fill="#fff"></path> </g></svg>
                                         @if (!empty($escortId))
                                             @if (in_array($escort->id, $escortId))
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

                         <div
                             class="d-flex justify-content-between  flex_directiom_warp_but_list_child_not_hundred_present list_gender_area gap-10">
                             <div class="custom--gender--area">
                                 <div class="gender">
                                     <strong>Gender: </strong>
                                     <span>{{ $escort->gender ? $escort->gender : '' }}</span>
                                 </div>
                                 <div class="give_rating_after_get_servive">
                                     <strong>Location: </strong>
                                     <span>{{ $escort->city ? $escort->city->name : '' }}</span>
                                 </div>
                                 <div class="give_rating_after_get_servive">
                                     <strong>Rating:</strong>
                                     <span class="give_rating_after_get_servive">
                                         @for ($i = 1; $i <= 5; $i++)
                                             @if ($escort->star_rating && $escort->star_rating > 0 && $i <= $escort->star_rating)
                                                 <i class="fa fa-star" aria-hidden="true"></i>
                                             @else
                                                 <i class="fa fa-star-o" aria-hidden="true"></i>
                                             @endif
                                         @endfor
                                     </span>
                                 </div>
                             </div>
                             <div class="custom--available-section">
                                 <div class="available custom-gender-type-icon">
                                     <strong>Available:</strong>
                                     <span>
                                         @if ($escort->available_to)
                                             @foreach ($escort->available_to as $key => $available_to)
                                                 <div class="icon-with-tooltip position-relative">
                                                     <img
                                                         src="{{ config('escorts.profile.available-to-images')[$available_to] }}">
                                                     <span class="custom-icon-hover-tooltip">
                                                         {{ config('escorts.profile.available-to')[$available_to] }}
                                                     </span>
                                                 </div>
                                             @endforeach
                                         @endif
                                     </span>
                                 </div>

                                 @if ($escort->escort_videos->count() > 0)
                                     <div class="video_icon">
                                         <a href="#">
                                             <img src="{{ asset('assets/app/img/video_play.svg') }}">
                                             <span class="custom--tooltip">Escort has video to view</span>
                                         </a>
                                     </div>
                                 @endif


                             </div>
                         </div>

                         <div class="custom-rate-type">
                             <div class="d-flex align-items-center manage_gap_text_img-profile">
                                 <img src="{{ asset('assets/app/img/handwithhart.png') }}">
                                 <div class="div_contain_text">
                                     <div class="profile_message">
                                         <h4>Massage</h4>
                                     </div>
                                     <div class="profile_hr">
                                         <h4>
                                             @php
                                                 $massage_price = $escort->durations()->where('name', '1 Hour')->first()
                                                     ? $escort->durations()->where('name', '1 Hour')->first()->pivot
                                                         ->massage_price
                                                     : 0;
                                             @endphp
                                             {{ $massage_price ? '$' . number_format($massage_price) . '/hr' : 'N/A' }}
                                         </h4>
                                     </div>
                                 </div>
                             </div>
                             <div class="d-flex align-items-center manage_gap_text_img-profile">
                                 <img src="{{ asset('assets/app/img/areodownimg.png') }}">
                                 <div class="div_contain_text">
                                     <div class="profile_message">
                                         <h4>Incalls</h4>
                                     </div>
                                     <div class="profile_hr">
                                         <h4>
                                             @php
                                                 $incall_price = $escort->durations()->where('name', '1 Hour')->first()
                                                     ? $escort->durations()->where('name', '1 Hour')->first()->pivot
                                                         ->incall_price
                                                     : 0;
                                             @endphp
                                             {{ $incall_price ? '$' . number_format($incall_price) . '/hr' : 'N/A' }}
                                         </h4>
                                     </div>
                                 </div>
                             </div>
                             <div class="d-flex align-items-center manage_gap_text_img-profile">
                                 <img src="{{ asset('assets/app/img/aeroupimg.png') }}">
                                 <div class="div_contain_text">
                                     <div class="profile_message">
                                         <h4>Outcalls</h4>
                                     </div>
                                     <div class="profile_hr">
                                         <h4>
                                             @php
                                                 $outcall_price = $escort->durations()->where('name', '1 Hour')->first()
                                                     ? $escort->durations()->where('name', '1 Hour')->first()->pivot
                                                         ->outcall_price
                                                     : 0;
                                             @endphp
                                             {{ $outcall_price ? '$' . number_format($outcall_price) . '/hr' : 'N/A' }}
                                         </h4>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @php
                             $plainTextAbout = strip_tags($escort->about);
                             $limitText = Str::limit($plainTextAbout, 210, '...');
                         @endphp
                         <div class="prof_desc">
                             <strong>About Me</strong><br>
                             <p class="list_view_profile_pera_font_size">{!! $limitText !!}
                                 @if (strlen($plainTextAbout) > 210)
                                     <a href="{{ route('profile.description', $escort->id) }}?list&brb={{ isset($escort->latestActiveBrb->id) ? $escort->latestActiveBrb->id : '' }}"
                                         class="h6 text-danger">Read More</a>
                                 @endif
                             </p>
                         </div>

                         <div class="all-escort-view-profile-btn">
                             {{-- social-media icon --}}
                             <div class="social_media_icons">
                                 <div class="social_media_wrapper">
                                     <div class="s_icon ec_playbox_icon">
                                         <a href="{{ url('playbox') }}" target="_blank"><img
                                                 src="{{ asset('assets/app/img/MyPlaybox.png') }}"
                                                 alt="logo"></a>
                                         <div class="custom-tooltip">I don't have any Playbox.</div>
                                     </div>
                                     <div class="d-flex justify-content-between gap-10">
                                         @if (!empty($escort->user->profile_creator) && in_array(3, $escort->user->profile_creator))
                                             @if ($escort->user->social_links && $escort->user->social_links['facebook'] !== null)
                                                 <div class="s_icon">
                                                     <a href="{{ $escort->user->social_links && $escort->user->social_links['facebook'] != '' ? $escort->user->social_links['facebook'] : 'https://www.facebook.com/' }}"
                                                         target="_blank"><img
                                                             src="{{ asset('assets/app/img/facebook.png') }}"
                                                             alt="logo"></a>
                                                 </div>
                                             @endif
                                             @if ($escort->user->social_links && $escort->user->social_links['insta'] !== null)
                                                 <div class="s_icon">
                                                     <a href="{{ $escort->user->social_links && $escort->user->social_links['insta'] != '' ? $escort->user->social_links['insta'] : 'https://www.instagram.com/' }}"
                                                         target="_blank"><img
                                                             src="{{ asset('assets/app/img/instagram.png') }}"
                                                             alt="logo"></a>
                                                 </div>
                                             @endif
                                             @if ($escort->user->social_links && $escort->user->social_links['twitter'] !== null)
                                                 <div class="s_icon">
                                                     <a href="{{ $escort->user->social_links && $escort->user->social_links['twitter'] != '' ? $escort->user->social_links['twitter'] : 'https://x.com/' }}"
                                                         target="_blank"><img
                                                             src="{{ asset('assets/app/img/twitter-x.png') }}"
                                                             alt="logo"></a>
                                                 </div>
                                             @else
                                                 <div class="s_icon">
                                                     <a href="https://x.com/NMugs32853" target="_blank"><img
                                                             src="{{ asset('assets/app/img/twitter-x.png') }}"
                                                             alt="logo"></a>
                                                 </div>
                                             @endif
                                         @else
                                             <div class="s_icon">
                                                 <a href="https://x.com/NMugs32853" target="_blank"><img
                                                         src="{{ asset('assets/app/img/twitter-x.png') }}"
                                                         alt="logo"></a>
                                             </div>
                                         @endif
                                     </div>

                                 </div>
                             </div>
                             <a href="{{ route('profile.description', $escort->id) }}?list&brb={{ isset($escort->latestActiveBrb->id) ? $escort->latestActiveBrb->id : '' }}"
                                 class="btn btn_for_profile_list_view custom-view-profile"
                                 style="float: right;">View Profile</a>
                         </div>
                     </div>
                     {{-- end --}}

                     {{-- 3rd --}}
                     <table class="table table-striped mb-0">
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
                                         <td>{{ $duration->name }} </td>
                                         <td>
                                            @if($duration->name == 'Blow & Go')
                                            @else
                                                {!! $duration->pivot->massage_price
                                                    ? "<div class='public-num-value-table'><span>$ </span>" . number_format($duration->pivot->massage_price) . "</div>"
                                                    : "<span class='if_data_not_available'>N/A</span>" !!}
                                            @endif
                                        </td>
                                         <td>{!! $duration->pivot->incall_price
                                             ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($duration->pivot->incall_price) . '</div>'
                                             : "<span class='if_data_not_available'>N/A</span>" !!}
                                         </td>
                                     </tr>
                                     @if ($loop->index == 5)
                                         @break
                                     @endif
                                 @endforeach
                             @endif
                         </tbody>
                         <thead class="table_heading_bgcolor_color available_footer">
                             <tr>
                                 <th class="payment_accept_text_color" scope="col" colspan="3">Available: <span
                                         class="date_from_available">{{ date('d-m-Y', strtotime($escort->start_date)) }}</span>
                                     to <span
                                         class="date_from_available">{{ date('d-m-Y', strtotime($escort->end_date)) }}</span>
                                 </th>
                             </tr>
                         </thead>
                     </table>
                     {{-- end --}}
                 </div>
             </div>
         </div>

     </div>
 </div>
