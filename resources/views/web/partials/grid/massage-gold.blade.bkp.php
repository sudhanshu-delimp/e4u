<div class="col-lg col-md-6 col-sm-6 mb-5">
    <a class="card short-card border-0 card_box_style mb-0" href="{{ route('center.profile.description',$escort->id)}}">
    <div class="card2 card_box_style1">
        
            <img class="card-img-top pt-5" src="{{ asset($escort->imagefrontPosition(1)) }}" alt="Card image cap" style="min-width: 208px;">
        
        <div class="five_column_content_top d-flex justify-content-between wish_span massage-centres">
            <span><img src="{{ asset('assets/app/img/pro_tect.svg') }}" class=""></span>
            <span class="card_tit pl-1">{{ substr($escort->name,0,15)}}</span>
            @if(auth()->user())
                @if(auth()->user()->type == 0)
                    <span class="add_to_favrate @if(in_array($escort->id,$user_type->massageCenterLegBox->pluck('id')->toArray())){{'null'}}@else{{'fill'}}@endif" id="legboxId_{{$escort->id}}"  data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}" data-name="{{$escort->name}}">
                        @if(!empty($user_type))
                            @if(in_array($escort->id,$user_type->massageCenterLegBox->pluck('id')->toArray()))
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
            {{-- <span class="add_to_favrate"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i></span> --}}
        </div>
       
        <div class="five_column_bottom_content mas-btm">
            <!-- <div class="d-flex justify-content-between five_column_fonts">
               <span>Perth</span>
                <span class="give_rating_after_get_servive">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                </span>
            </div> -->
            <div class="d-flex justify-content-between five_column_fonts">
                <span>Address:</span>
                
                <span style="text-align: right;">{{ $escort->address }}</span>
            </div>
            <div class="d-flex justify-content-between five_column_fonts">
                <span>Hours:</span>
                
                <span style="text-align: right;">Closed/Open</span>
            </div>
            <div class="d-flex justify-content-between five_column_fonts">
                <span>Parking:</span>
                <span>
                    {{ config("escorts.profile.Parking.$escort->parking")}}
                </span>
            </div>
            <div class="d-flex justify-content-between five_column_fonts">
                <span>Building:</span>
                <span> {{ config("escorts.profile.Building.$escort->building")}} </span>
            </div>
           
        </div>
    </div>
    </a>
   
    @if(Request::path() == "massage-show-list") 
        <button type="button" class="short-list btn btn-primary removeshortlist" id="escort_{{$escort->id}}" data-name="{{$escort->name}}" data-escortId="{{$escort->id}}">
       
        Remove from Shortlist</button>
        
    @else

        <button type="button" class="short-list btn btn-primary shortlist myescort_{{$escort->id}}" id="escort_{{$escort->id}}" data-name="{{$escort->name}}" data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
            @if(!empty($escortId))
                {{-- @if($escort->shortListed->isEmpty()) --}}
                @if(in_array($escort->id,$escortId))
                <img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_btn.svg') }}">
                Remove from Shortlist
                @else
                Add to Shortlist      
                @endif
            @else 
            Add to Shortlist
            
            @endif
        </button>
    @endif
    
    {{-- <button type="button" class="short-list btn btn-primary shortlist" data-name="Juli test" data-escortid="39">Add to Shortlist</button> --}}
        
</div>