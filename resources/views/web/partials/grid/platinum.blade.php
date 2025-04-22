<div class="col-lg col-md-6 col-sm-6 mb-5">

<div class="five_column_content_top d-flex justify-content-between wish_span" style="z-index: 1;width: 90%;">
            <span><img width="18" height="18" src="{{ asset('assets/img/verified media.png') }}" class="" title="This Escort's Media has been verified by E4U"></span>
            <span class="card_tit">{{ substr($escort->name,0,15)}}</span>
            @if(auth()->user())
                @if(auth()->user()->type == 0)
                    <span class="add_to_favrate @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray())){{'null'}}@else{{'fill'}}@endif" id="legboxId_{{$escort->id}}"  data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}" data-name="{{$escort->name}}">
                        @if(!empty($user_type))
                            @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray()))
                                <i class='fa fa-heart' style='color: #ff3c5f;' title="Remove from Legbox" aria-hidden='true'></i>
                            @else
                                <i class="fa fa-heart-o" title="Add to Legbox" aria-hidden='true'></i>
                            @endif
                        @endif
                    </span>
                @else
                    <span class="add_to_favrate" data-name="{{$escort->name}}"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i></span>
                @endif
                
            @else
            <span class="add_to_favrate"  data-escortId="{{$escort->id}}" data-name="{{$escort->name}}"><i class="fa fa-heart-o" aria-hidden="true" title="Removed from Legbox"></i></span>
            @endif
        </div>

    <a class="card short-card card_box_style mb-0" href="{{ route('profile.description',[$escort->id,$escort->city_id, $escort->membership])}}">
    <div class="card2 card_box_style1">
       
            <img class="card-img-top" src="{{ $escort->default_image ? asset($escort->default_image) : asset('assets/app/img/service-provider/Frame-408.png') }}" alt="Card image cap">
        
        <div class="five_column_content_top d-flex justify-content-between wish_span"></div>
       
        <div class="five_column_bottom_content">
            <div class="d-flex justify-content-between five_column_fonts">
               <span>{{ $escort->city ? $escort->city->name : "" }} {{ $escort->age ? " - ".$escort->age : "" }}</span>
                <span class="give_rating_after_get_servive">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                </span>
            </div>
            <div class="d-flex justify-content-between five_column_fonts">
                <span>Price:</span>
                <span>From $ {{$escort->durations()->where('name','1 Hour')->first() ? $escort->durations()->where('name','1 Hour')->first()->pivot->massage_price : ''}} / hr</span>
            </div>
            <div class="d-flex justify-content-between five_column_fonts">
                <span>Services:</span>
                <span>
                <img src="{{ asset('assets/app/img/aerodownicon.svg') }}">
                <img src="{{ asset('assets/app/img/upaeroicon.svg') }}">
                </span>
            </div>
            <div class="d-flex justify-content-between five_column_fonts">
                <span>Gender:</span>
                
                <span>{{ $escort->gender ? $escort->gender : '' }}</span>
            </div>
            <div class="d-flex justify-content-between five_column_fonts">
                <span>Available to:</span>
                <span>
                @if($escort->available_to)
                @foreach($escort->available_to as $key => $available_to)
                <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}">
                @endforeach
                @endif
                </span>
            </div>
        </div>
    </div>
    </a>
   
    
    @if(Request::path() == "showList") 
        <button type="button" class="short-list btn btn-primary removeshortlist" id="escort_{{$escort->id}}" data-name="{{$escort->name}}" data-escortId="{{$escort->id}}">Remove from Shortlist</button>
        <!--  <div class="uperbutton text-center mt-3">
            <button href="#" class="btn btn-blue removeshortlist" data-name="{{$escort->name}}" data-escortId="{{$escort->id}}">Remove from Shortlist</button>
        </div> -->
    @else

        <button type="button" class="short-list btn btn-primary shortlist myescort_{{$escort->id}}" id="escort_{{$escort->id}}" data-name="{{$escort->name}}" data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
            @if(!empty($escortId))
                {{-- @if($escort->shortListed->isEmpty()) --}}
                @if(in_array($escort->id,$escortId))
                Remove from Shortlist
                @else
                Add to Shortlist      
                @endif
            @else 
            Add to Shortlist
            {{-- <p class="btn-holder"><a href="{{ route('web.save.addtocart', $escort->id) }}" class="btn btn-primary text-center" role="button">Add To Shortlist</a> </p> --}}
            @endif
        </button>
    @endif
    
</div>