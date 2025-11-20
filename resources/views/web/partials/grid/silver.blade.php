@php
    $escortName = ($escort->gender == 'Transgender')
        ? 'TS-' . substr($escort->name, 0, 12)
        : substr($escort->name, 0, 12);
@endphp

<div class="col-lg col-md-6 col-sm-6 mb-5 brb--text">
    <div class="seven_column_content_top d-flex justify-content-between mid_tit wish_span wish_span" style="z-index: 1;width: 90%;">
           {{-- <span>
            <img src="{{ asset('assets/img/e4u-verified-shield-dark.png') }}" class="" title="This Escort's Media has been verified by E4U" style="width: 12px;height: 12px;">
           </span> --}}
            <div class="vrf-tooltip-wrap">
                <span ><img width="18" height="18" src="{{ asset('assets/app/img/verify/unverified_icon.png') }}"></span>            
                <span class="vrf-tooltip">Media Unverified</span>
            </div>
                <span class="seven_column_content_top_font_size">{{ $escortName }}</span>
                
                @if(auth()->user())
                @if(auth()->user()->type == 0)
                <span class="add_to_favrate custom--favourite @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray())){{'null'}}@else{{'fill'}}@endif" id="legboxId_{{$escort->id}}"  data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}" data-name="{{$escortName}}">
                    @if(!empty($user_type))
                        @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray()))
                            <i class='fa fa-heart' style='color: #ff3c5f;' title='' aria-hidden='true'></i>
                            <span class="custom-heart-text">Remove from My Legbox</span> 
                        @else
                            <i class="fa fa-heart-o" title='' aria-hidden="true"></i>
                            <span class="custom-heart-text">Add to My Legbox</span>
                        @endif
                    @endif
                </span>
                @else
                <span class="add_to_favrate custom--favourite" data-name="{{$escortName}}"><i class="fa fa-heart-o" aria-hidden="true"></i> <span class="custom-heart-text">Add to My Legbox</span></span>
                @endif
            @else
            {{-- <span class="add_to_favrate"  data-escortId="{{$escort->id}}" data-name="{{$escortName}}"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i></span> --}}
            <span class="add_to_favrate custom--favourite" data-escortId="{{$escort->id}}" data-name="{{$escortName}}"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="custom-heart-text">Add to My Legbox</span></span>
            @endif
        </div>
    <a  class="card card_box_style mb-0 short-card" href="{{ route('profile.description',[$escort->id, $escort->city_id, $escort->membership])}}?brb={{isset($escort->latestActiveBrb->id) ? $escort->latestActiveBrb->id : ''}}">
        <div class="card2 card_box_style1">
        @if($escort->latestActiveBrb)
        <div class="brb--content">
                <div class="brb--wrappr">
                <span class="brb-text">BRB</span> at <span class="brb-time">{{date('h:i A',strtotime($escort->latestActiveBrb->selected_time))}}</span> <span class="brb-date">{{date('d-m-Y',strtotime($escort->latestActiveBrb->selected_time))}}</span>
                </div>
            </div>
            @endif
            <img class="card-img-top" src="{{ $escort->default_image ? $escort->default_image : asset('assets/app/img/service-provider/Frame-408.png') }}" alt="Card image cap">
            <div class="seven_column_content_top d-flex justify-content-between mid_tit wish_span"></div>
            <div class="seven_column_bottom_content">
                <div class="d-flex justify-content-between seven_column_fonts">
                    <span>{{$escort->city ? $escort->city->name : ''}} {{ $escort->age ? " - ".$escort->age : "" }}</span>
                    <span class="give_rating_after_get_servive">
                        @for($i=1; $i<= 5; $i++)
                            @if($escort->star_rating && $escort->star_rating > 0 && $i <= $escort->star_rating)
                            {{-- @if($escort->star_rating && $escort->star_rating > 0 && $i <= $escort->star_rating) --}}
                                <i class="fa fa-star" aria-hidden="true" ></i>
                            @else
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            @endif
                        @endfor
                    </span>
                </div>
                <div class="d-flex justify-content-between seven_column_fonts">
                    <span>Price:</span>
                    <span>From $ {{$escort->lowest_rate_price}} / hr</span>
                </div>
                <div class="d-flex justify-content-between seven_column_fonts custom-available-time-icon">
                    <span>Services:</span>
                   <span class="image_height_width_for_col_six position-relative">
                    <div class="icon-with-tooltip position-relative">
                        <img src="{{ asset('assets/app/img/heart-white.png') }}"  style="width: 16px; height:17px; display:{{ $escort->massage_price != null ? '': 'none'}};">
                        <span class="custom-icon-hover-tooltip">Massage</span>  
                    </div>
                    
                    <div class="icon-with-tooltip position-relative">
                        <img src="{{ asset('assets/app/img/aerodownicon.svg') }}" style="display:{{ $escort->incall_price != null ? '': 'none'}};">
                        <span class="custom-icon-hover-tooltip">Incalls</span>  
                    </div>
                    <div class="icon-with-tooltip position-relative">
                        <img src="{{ asset('assets/app/img/upaeroicon.svg') }}" style="display:{{ $escort->outcall_price != null ? '': 'none'}};" >
                        <span class="custom-icon-hover-tooltip">Outcalls</span>  
                    </div>
                    </span>
                </div>
                <div class="d-flex justify-content-between seven_column_fonts">
                    <span>Gender:</span>
                    <span>{{ $escort->gender}}</span>
                </div>
                <div class="d-flex justify-content-between seven_column_fonts custom-gender-type-icon">
                    <span>Available to:</span>
                    <span class="image_height_width_for_col_seven">
                    <span class="d-flex gap-1 position-relative">
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
                    </span>
                </div>
            </div>
        </div>
    </a>
    @if(Request::path() == "showList")
        <button type="button" class="short-list btn btn-primary removeshortlist" data-name="{{$escortName}}"  data-escortId="{{$escort->id}}"><span>Remove from Shortlist</span></button>
        <!-- <div class="uperbutton text-center mt-3">
            <button href="#" class="btn btn-blue removeshortlist" data-escortId="{{$escort->id}}">Remove from Shortlist</button>
        </div> -->
    @else
        <button type="button" class="short-list btn btn-primary shortlist myescort_{{$escort->id}}" data-name="{{$escortName}}"  id="escort_{{$escort->id}}" data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
            @if(!empty($escortId))
            {{-- @if($escort->shortListed->isEmpty()) --}}
                @if(in_array($escort->id,$escortId))
                Remove from Shortlist
                @else
                Add to Shortlist      
                @endif
            @else
                <span style="margin-left: -8px;">Add to Shortlist</span>
            @endif
        </button>
        <!-- <div class="uperbutton text-center mt-3">ss
        <button href="#" class="btn btn-blue shortlist" data-escortId="{{$escort->id}}">Add to shortlist</button>
        </div> -->
    @endif
</div>