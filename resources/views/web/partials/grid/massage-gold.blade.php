<div class="col-lg col-md-6 col-sm-6 mb-5">
    <div class="six_column_content_top d-flex justify-content-between mid_tit wish_span" style="z-index: 1;width: 90%;">
       <span>
       <img src="{{asset('assets/img/verified media.png')}}" class="custom-sheild" title="This Escort's Media has been verified by E4U" style="width: 12px;height: 12px;"></span>
       <span class="six_column_fonts_top">{{ substr($escort->name,0,15)}}</span>
       
        @if(auth()->user())
        {{-- {{ dd($user_type->massageCenterLegBox->pluck('id')->toArray()) }} --}}
            @if(auth()->user()->type === 0)
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
      
      </span>
    </div>
    <a class="card card_box_style six_col_card mb-0 short-card" href="{{ route('center.profile.description',$escort->id)}}">
       <div class="card2 card_box_style1 six_col_card1">
            <img class="card-img-top" src="{{ asset($escort->imagefrontPosition(1)) }}" alt="Card image cap">
            <div class="six_column_content_top d-flex justify-content-between mid_tit wish_span"></div>
            <div class="six_column_bottom_content">
               <div class="d-flex justify-content-between six_column_fonts">
               <span>{{ $escort->city ? $escort->city->name : "" }} {{ $escort->age ? " - ".$escort->age : "" }}</span>
                  <span class="give_rating_after_get_servive">
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                  </span>
               </div>
               {{-- <div class="d-flex justify-content-between six_column_fonts">
                  <span>Price:</span>
                  <span>From $ {{$escort->durations()->where('name','1 Hour')->first() ? $escort->durations()->where('name','1 Hour')->first()->pivot->massage_price : ''}} / hr</span>
               </div>
               <div class="d-flex justify-content-between six_column_fonts">
                  <span>Services:</span>
                  <span class="image_height_width_for_col_six">
                     <img src="{{ asset('assets/app/img/aerodownicon.svg') }}">
                     <img src="{{ asset('assets/app/img/upaeroicon.svg') }}">
                  </span>
               </div>
               <div class="d-flex justify-content-between six_column_fonts">
                  <span>Gender:</span>
                  <span>{{ $escort->gender ? $escort->gender : '' }}</span>
               </div> --}}
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
                <img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_view.png') }}">
                Remove from Shortlist
                @else
                Add to Shortlist      
                @endif
            @else 
            Add to Shortlist
            
            @endif
        </button>
    @endif
    <!-- <div class="uperbutton text-center mt-3">
       <button href="#" class="btn btn-blue shortlist" data-escortId="26">Add to shortlist</button>
       </div> -->
 </div>