@php
    $escortName = $escort->gender == 'Transgender' ? 'TS-' . $escort->name : $escort->name;
@endphp

<div class="ec_card brb--text">
    <div class="ec_card_header">
        @if ($escort->first_image)
            @php
                $media_status = getMediaVerificationDataSmallIcon($escort->verification_status ?? 0);
            @endphp
            <div class="vrf-tooltip-wrap">
                <span><img width="18" height="18" src=" {{ $media_status['icon'] }}"></span>
                <span class="vrf-tooltip">{{ $media_status['label'] }}</span>
            </div>
        @endif
        <span class="ec_title">
            @if ($escort->gender == 'Transgender')
                {{ 'TS-' . substr($escort->name, 0, 15) }}
            @else
                {{ substr($escort->name, 0, 15) }}
            @endif

        </span>
        @if (auth()->user())
            @if ($viewerAuth->type == '0')
                <span
                    class="add_to_favrate @if (in_array($escort->id, $user_type)) {{ 'null' }}@else{{ 'fill' }} @endif custom--favourite"
                    id="legboxId_{{ $escort->id }}" data-escortId="{{ $escort->id }}"
                    data-userId="{{ $viewerAuth ? $viewerAuth->id : 'NA' }}" data-name="{{ $escort->name }} ">
                    {{-- @if (!empty($user_type)) --}}
                    @if (in_array($escort->id, $user_type))
                        <i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i>
                        <span class="custom-heart-text">Remove from My Legbox</span>
                    @else
                        <i class="fa fa-heart-o" aria-hidden='true'></i>
                        <span class="custom-heart-text">Add to My Legbox</span>
                    @endif
                    {{-- @endif --}}
                </span>
            @else
                <span class="add_to_favrate custom--favourite" data-name="{{ $escortName }}"><i class="fa fa-heart-o"
                        aria-hidden="true"></i> <span class="custom-heart-text">Add to My Legbox</span></span>
            @endif
        @else
            <span class="add_to_favrate custom--favourite" data-escortId="{{ $escort->id }}"
                data-name="{{ $escortName }}"><i class="fa fa-heart-o" aria-hidden="true"></i><span
                    class="custom-heart-text">Add to My Legbox</span></span>
        @endif
    </div>
    <a class="ec_card_link" href="{{ getEscortMassageDetailUrl($escort) }}">
        @if ($escort->latestActiveBrb)
            <div class="brb--content">
                <div class="brb--wrappr">
                    <span class="brb-text">BRB</span> at <span
                        class="brb-time">{{ date('h:i A', strtotime($escort->latestActiveBrb->selected_time ?? '')) }}</span>
                    <span
                        class="brb-date">{{ date('d-m-Y', strtotime($escort->latestActiveBrb->selected_time ?? '')) }}</span>
                </div>
            </div>
        @endif
        <div class="ec_profile_img">
            <img class="card-img-top"
                src="{{ $escort->first_image ? asset($escort->first_image) : asset('assets/app/img/service-provider/Frame-408.png') }}"
                alt="Card image cap">
        </div>

        {{-- <div class="five_column_content_top d-flex justify-content-between wish_span"></div> --}}

        <div class="ec_card_content">
            <div class="items">
                <span class="title ">{{ $escort->city ? $escort->city->name : '' }}
                    {{ $escort->age ? ' - ' . $escort->age : '' }} </span>
                <span class="video_icon_ec">
                    @if ($escort->escort_videos->isNotEmpty())
                        <div class="video_tooltip">Escort has video to view</div>
                        <span class="video_icons">
                            <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M11.25 2C9.88382 2.00133 8.73117 2.01015 7.75 2.0685V6.24976H11.25V2Z"
                                        fill="#ff3c5f"></path>
                                    <path
                                        d="M6.25 2.2214C5.02727 2.41566 4.1485 2.78019 3.46447 3.46423C2.78043 4.14826 2.4159 5.02703 2.22164 6.24976H6.25V2.2214Z"
                                        fill="#ff3c5f"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2 11.9998C2 10.2993 2 8.90556 2.06874 7.74976L21.9313 7.74976C22 8.90556 22 10.2993 22 11.9998C22 13.7002 22 15.094 21.9313 16.2498L2.06874 16.2498C2 15.094 2 13.7002 2 11.9998ZM12.4112 10.4043C13.4704 11.1162 14 11.4722 14 12C14 12.5278 13.4704 12.8838 12.4112 13.5957C11.3375 14.3173 10.8006 14.6781 10.4003 14.4132C10 14.1483 10 13.4322 10 12C10 10.5678 10 9.85174 10.4003 9.58682C10.8006 9.3219 11.3375 9.68271 12.4112 10.4043Z"
                                        fill="#ff3c5f"></path>
                                    <path
                                        d="M21.7784 6.24976C21.5841 5.02703 21.2196 4.14826 20.5355 3.46423C19.8515 2.78019 18.9727 2.41566 17.75 2.2214V6.24976H21.7784Z"
                                        fill="#ff3c5f"></path>
                                    <path d="M12.75 2C14.1162 2.00133 15.2688 2.01015 16.25 2.0685V6.24976H12.75V2Z"
                                        fill="#ff3c5f"></path>
                                    <path
                                        d="M21.7784 17.7498H17.75V21.7781C18.9727 21.5839 19.8515 21.2193 20.5355 20.5353C21.2196 19.8513 21.5841 18.9725 21.7784 17.7498Z"
                                        fill="#ff3c5f"></path>
                                    <path
                                        d="M16.25 17.7498V21.931C15.2688 21.9894 14.1162 21.9982 12.75 21.9995V17.7498H16.25Z"
                                        fill="#ff3c5f"></path>
                                    <path
                                        d="M11.25 21.9995V17.7498H7.75L7.75 21.931C8.73117 21.9894 9.88382 21.9982 11.25 21.9995Z"
                                        fill="#ff3c5f"></path>
                                    <path
                                        d="M6.25 17.7498L6.25 21.7781C5.02727 21.5839 4.1485 21.2193 3.46447 20.5353C2.78043 19.8513 2.4159 18.9725 2.22164 17.7498H6.25Z"
                                        fill="#ff3c5f"></path>
                                </g>
                            </svg>
                        </span>
                    @endif
                </span>

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


            <div class="items">
                <span class="title ">Price:</span>
                @if ($escort->lowest_rate_price)
                    <span class="decs">From $ {{ number_format((float) $escort->lowest_rate_price) }} / hr</span>
                @else
                    <span class="decs">N/A</span>
                @endif
            </div>

            <div class="items custom-available-time-icon">
                <span class="title">Services:</span>
                <span class="image_height_width_for_col_six position-relative desc">
                    <div class="icon-with-tooltip position-relative">
                        <img src="{{ asset('assets/app/img/heart-white.png') }}"
                            style="width: 16px; height:17px; display:{{ $escort->massage_price != null ? '' : 'none' }};">
                        <span class="custom-icon-hover-tooltip">Massage</span>
                    </div>
                    <div class="icon-with-tooltip position-relative">
                        <img src="{{ asset('assets/app/img/aerodownicon.svg') }}"
                            style="display:{{ $escort->incall_price != null ? '' : 'none' }};">
                        <span class="custom-icon-hover-tooltip">Incalls</span>
                    </div>
                    <div class="icon-with-tooltip position-relative">
                        <img src="{{ asset('assets/app/img/upaeroicon.svg') }}"
                            style="display:{{ $escort->outcall_price != null ? '' : 'none' }};">
                        <span class="custom-icon-hover-tooltip">Outcalls</span>
                    </div>
                </span>
            </div>

            <div class="items">
                <span class="title">Gender:</span>

                <span class="decs">{{ $escort->gender ? $escort->gender : '' }}</span>
            </div>

            {{-- end --}}
            <div class="items custom-gender-type-icon">
                <span class="title">Available to:</span>
                <span class="image_height_width_for_col_six decs">
                <span class="d-flex gap-1 position-relative">
                    @if ($escort->available_to)
                        @foreach ($escort->available_to as $key => $available_to)
                            <div class="icon-with-tooltip position-relative">
                                <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}">
                                <span class="custom-icon-hover-tooltip">
                                    {{ config('escorts.profile.available-to')[$available_to] }}
                                </span>
                            </div>
                        @endforeach
                    @endif
                </span>
            </span>
            </div>

        </div>

    </a>

    <div class="ec_card_footer wishlist_footer">
        @if (Request::path() == 'showList')
            <a href="javascript:void(0)" class="short-list removeshortlist" id="escort_{{ $escort->id }}"
                data-name="{{ $escortName }}" data-escortId="{{ $escort->id }}">Remove from Shortlist</a>
        @else
            <a href="javascript:void(0)" class="short-list shortlist myescort_{{ $escort->id }}"
                id="escort_{{ $escort->id }}" data-name="{{ $escortName }}" data-escortId="{{ $escort->id }}"
                data-userId="{{ $viewerAuth ? $viewerAuth->id : 'NA' }}">
                @if (!empty($escortId))
                    @if (in_array($escort->id, $escortId))
                        Remove from Shortlist
                    @else
                        Add to Shortlist
                    @endif
                @else
                    Add to Shortlist
                @endif
            </a>
        @endif
    </div>
</div>
