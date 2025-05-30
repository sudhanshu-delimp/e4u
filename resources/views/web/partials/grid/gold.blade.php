<div class="col-lg col-md-6 col-sm-6 mb-5">
    <div class="six_column_content_top d-flex justify-content-between mid_tit wish_span" style="z-index: 1;width: 90%;">
            <span>
                <img src="{{ asset('assets/img/verified media.png') }}" class="" title="This Escort's Media has been verified by E4U" style="width: 12px;height: 12px;"></span>
            <span class="six_column_fonts_top">{{ substr($escort->name,0,12)}}</span>
            {{-- <span class="add_to_favrate @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray())){{'null'}}@else{{'fill'}}@endif" id="legboxId_{{$escort->id}}"  data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
                @if($user_type->myLegBox->isNotEmpty())
                    @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray()))
                        <i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i>
                    @else
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                    @endif
                @endif
            </span> --}}
            @if(auth()->user())
                @if(auth()->user()->type == 0)
                    <span class="add_to_favrate @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray())){{'null'}}@else{{'fill'}}@endif custom--favourite" id="legboxId_{{$escort->id}}"  data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}" data-name="{{$escort->name}}">
                        @if(!empty($user_type))
                            @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray()))
                                <i class='fa fa-heart' style='color: #ff3c5f;' title="" aria-hidden='true'></i>
                                <span class="custom-heart-text">Remove from My Legbox</span>
                            @else
                                <i class="fa fa-heart-o" title="" aria-hidden="true"></i>
                                <span class="custom-heart-text">Add to My Legbox</span>
                            @endif
                        @endif
                    </span>
                @else
                    <span class="add_to_favrate" data-name="{{$escort->name}}"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i></span>
                @endif
            @else
                <span class="add_to_favrate" data-escortId="{{$escort->id}}"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox" data-name="{{$escort->name}}"></i></span>
            @endif
        </div>
    <a  class="card card_box_style six_col_card mb-0 short-card" href="{{ route('profile.description',[$escort->id,$escort->city_id, $escort->membership])}}">
        <div class="card2 card_box_style1 six_col_card1">
        @if($escort->latestActiveBrb)
        <div class="brb--content">
                <div class="brb--wrappr">
                <span class="brb-text">BRB</span> at <span class="brb-time">{{date('h:i A',strtotime($escort->latestActiveBrb->brb_time))}}</span> <span class="brb-date">{{date('d-m-Y',strtotime($escort->latestActiveBrb->brb_time))}}</span>
                </div>
            </div>
            @endif
            <img class="card-img-top" src=" {{ $escort->default_image ? $escort->default_image : asset('assets/app/img/service-provider/Frame-408.png') }}" alt="Card image cap">
            <div class="six_column_content_top d-flex justify-content-between mid_tit wish_span"></div>
            <div class="six_column_bottom_content">
                <div class="d-flex justify-content-between six_column_fonts">
                    <span>{{$escort->city ? $escort->city->name : ''}} {{ $escort->age ? " - ".$escort->age : "" }}</span>
                    {{--dd($escort)--}}
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
                <div class="d-flex justify-content-between six_column_fonts">
                    <span>Price:</span>
                    <span>From $ {{$escort->lowest_rate_price}} / hr</span>
                    {{-- <span>From $ {{$escort->durations()->where('name','1 Hour')->first() ? $escort->durations()->where('name','1 Hour')->first()->pivot->massage_price : ''}} / hr</span> --}}
                </div>
                <div class="d-flex justify-content-between six_column_fonts">
                    <span>Services:</span>
                    <span class="image_height_width_for_col_six">
                    <img src="{{ asset('assets/app/img/heart-white.png') }}" title="Massage" style="width: 16px; height:17px; display:{{ $escort->massage_price != null ? '': 'none'}};">
                    <img src="{{ asset('assets/app/img/aerodownicon.svg') }}" style="display:{{ $escort->incall_price != null ? '': 'none'}};" title="Incalls">
                    <img src="{{ asset('assets/app/img/upaeroicon.svg') }}" style="display:{{ $escort->outcall_price != null ? '': 'none'}};" title="Outcalls">
                    </span>
                </div>
                <div class="d-flex justify-content-between six_column_fonts">
                    <span>Gender:</span>
                    <span>{{$escort->gender}}</span>
                </div>
                <div class="d-flex justify-content-between six_column_fonts">
                    <span>Available to:</span>
                    <span class="image_height_width_for_col_six">
                    <span>
                    @if($escort->available_to)
                    @foreach($escort->available_to as $key => $available_to)
                    <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}" title="{{ config('escorts.profile.available-to')[$available_to] }}">
                    @endforeach
                    @endif
                    </span>
                    </span>
                </div>
            </div>
        </div>
        </a>
        @if(Request::path() == "showList") 
            <button type="button" class="short-list btn btn-primary removeshortlist"  data-name="{{$escort->name}}"  data-escortId="{{$escort->id}}">Remove from Shortlist</button>
            <!--  <div class="uperbutton text-center mt-3">
                <button href="#" class="btn btn-blue removeshortlist" data-escortId="{{$escort->id}}">Remove from Shortlist</button>
            </div> -->
        @else
            <button type="button" class="short-list btn btn-primary shortlist myescort_{{$escort->id}}" data-name="{{$escort->name}}"  id="escort_{{$escort->id}}" data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
            @if(!empty($escortId))
                {{-- @if($escort->shortListed->isEmpty()) --}}
                @if(in_array($escort->id,$escortId))
                Remove from Shortlist
                @else
                Add to Shortlist      
                @endif
            @else 
            Add to Shortlist
            @endif
            </button>
   
            <!-- <div class="uperbutton text-center mt-3">
            <button href="#" class="btn btn-blue shortlist" data-escortId="{{$escort->id}}">Add to shortlist</button>
            </div> -->
        @endif
    
</div>