@php
    $escortName =
        $escort->gender == 'Transgender' ? 'TS-' . substr($escort->name, 0, 12) : substr($escort->name, 0, 12);
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
        <span class="ec_title">{{ $escortName }}</span>

        @if (auth()->user())
            @if ($viewerAuth->type == '0')
                <span
                    class="add_to_favrate custom--favourite @if (in_array($escort->id, $user_type)) {{ 'null' }}@else{{ 'fill' }} @endif"
                    id="legboxId_{{ $escort->id }}" data-escortId="{{ $escort->id }}"
                    data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}" data-name="{{ $escortName }}">
                    {{-- @if (!empty($user_type)) --}}
                    @if (in_array($escort->id, $user_type))
                        <i class='fa fa-heart' style='color: #ff3c5f;' title='' aria-hidden='true'></i>
                        <span class="custom-heart-text">Remove from My Legbox</span>
                    @else
                        <i class="fa fa-heart-o" title='' aria-hidden="true"></i>
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
                            class="brb-time">{{ date('h:i A', strtotime($escort->latestActiveBrb->selected_time)) }}</span>
                        <span
                            class="brb-date">{{ date('d-m-Y', strtotime($escort->latestActiveBrb->selected_time)) }}</span>
                    </div>
                </div>
            @endif
             <div class="ec_profile_img">
                <img class="card-img-top"
                    src="{{ $escort->first_image ? $escort->first_image : asset('assets/app/img/service-provider/Frame-408.png') }}"
                    alt="Card image cap">
            </div> 
            
            
            {{-- <div class="seven_column_content_top d-flex justify-content-between mid_tit wish_span"></div> --}}
            <div class="ec_card_content">
                <div class="items">
                    <span class="title">{{ $escort->city ? $escort->city->name : '' }}
                        {{ $escort->age ? ' - ' . $escort->age : '' }}</span>
                    <span class="video_icon_ec">
                        @if ($escort->escort_videos->isNotEmpty())
                            <img src="{{ asset('assets/app/img/video_play.svg') }}">
                            <div class="video_tooltip">Escort has video to view</div>
                        @endif
                    </span>
                    <span class="give_rating_after_get_servive">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($escort->star_rating && $escort->star_rating > 0 && $i <= $escort->star_rating)
                                {{-- @if ($escort->star_rating && $escort->star_rating > 0 && $i <= $escort->star_rating) --}}
                                <i class="fa fa-star" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            @endif
                        @endfor
                    </span>
                </div>

                <div class="items">
                    <span class="title">Price:</span>
                    @if ($escort->lowest_rate_price)
                        <span class="decs">From $ {{ number_format((float) $escort->lowest_rate_price) }} / hr</span>
                    @else
                        <span class="decs">N/A</span>
                    @endif
                </div>
                <div class="items custom-available-time-icon">
                    <span class="title">Services:</span>
                    <span class="image_height_width_for_col_six position-relative decs">
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
                    <span class="decs">{{ $escort->gender }}</span>
                </div>
                <div class="items custom-gender-type-icon">
                    <span class="title">Available to:</span>
                    <span class="image_height_width_for_col_seven decs">
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
            <a href="javascript:void(0)" class="short-list removeshortlist" data-name="{{ $escortName }}"
                data-escortId="{{ $escort->id }}"><span>Remove from Shortlist</span></a>
        @else
            <a href="javascript:void(0)" class="short-list shortlist myescort_{{ $escort->id }}"
                data-name="{{ $escortName }}" id="escort_{{ $escort->id }}" data-escortId="{{ $escort->id }}"
                data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
                @if (!empty($escortId))
                    @if (in_array($escort->id, $escortId))
                        Remove from Shortlist
                    @else
                        Add to Shortlist
                    @endif
                @else
                    <span style="margin-left: -8px;">Add to Shortlist</span>
                @endif
            </a>
        @endif
    </div>
</div>
