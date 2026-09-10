@php
    $escortName = ($escort->gender == 'Transgender') ? 'TS-' . $escort->name : $escort->name;
@endphp


<div class="col-lg col-md-6 col-sm-6 mb-3">
    <div class="six_column_content_top d-flex justify-content-between mid_tit wish_span" style="z-index: 1;width: 90%;">
       <span>
        @php
            use Illuminate\Support\Facades\File;
            $mediaImage = asset('assets/img/verified media.png'); // default
            $card_img_top = asset($escort->imagefrontPosition(1)); // default
            if ($escort->gallary->isNotEmpty()){
                $path = $escort->gallary[0]['path'];

                if (File::exists($path)) {
                    $mediaImage = asset($escort->gallary[0]['path']);
                    $card_img_top = asset($escort->gallary[0]['path']);
                }
            }
            
        @endphp
       <img src="{{$mediaImage}}" class="custom-sheild" title="This Escort's Media has been verified by E4U" style="width: 12px;height: 12px;"></span>
       <span class="six_column_fonts_top">{{ substr($escortName,0,15)}}</span>
       
        @if(auth()->user())
        {{-- {{ dd($user_type->massageCenterLegBox->pluck('id')->toArray()) }} --}}
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
                <span class="add_to_favrate" data-name="{{$escortName}}"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i></span>
            @endif
       
        @else
        {{-- <span class="add_to_favrate"  data-escortId="{{$escort->id}}" data-name="{{$escortName}}"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i></span> --}}
            <span class="add_to_favrate custom--favourite" data-escortId="{{$escort->id}}" data-name="{{$escortName}}"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="custom-heart-text">Add to My Legbox</span></span>
        @endif
      
      </span>
    </div>
    <a class="card card_box_style six_col_card mb-0 short-card" href="{{ route('center.profile.description',$escort->id)}}">
       <div class="card2 card_box_style1 six_col_card1">
            <img class="card-img-top" src="{{ $card_img_top }}" alt="Card image cap">
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
        <button type="button" class="short-list btn btn-primary removeshortlist" id="escort_{{$escort->id}}" data-name="{{$escortName}}" data-escortId="{{$escort->id}}">
       
        Remove from Shortlist</button>
        
    @else

        <button type="button" class="short-list btn btn-primary shortlist myescort_{{$escort->id}}" id="escort_{{$escort->id}}" data-name="{{$escortName}}" data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
            @if(!empty($escortId))
                {{-- @if($escort->shortListed->isEmpty()) --}}
                @if(in_array($escort->id,$escortId))
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.75 3.25H8.24999C7.52064 3.25 6.82117 3.53973 6.30545 4.05546C5.78972 4.57118 5.49999 5.27065 5.49999 6V20C5.49898 20.1377 5.53587 20.2729 5.60662 20.391C5.67738 20.5091 5.77926 20.6054 5.90112 20.6695C6.02298 20.7335 6.16012 20.7627 6.2975 20.754C6.43488 20.7453 6.56721 20.6989 6.67999 20.62L12 16.91L17.32 20.62C17.4467 20.7063 17.5967 20.7516 17.75 20.75C17.871 20.7486 17.9903 20.7213 18.1 20.67C18.2203 20.6041 18.3208 20.5072 18.3911 20.3894C18.4615 20.2716 18.499 20.1372 18.5 20V6C18.5 5.27065 18.2103 4.57118 17.6945 4.05546C17.1788 3.53973 16.4793 3.25 15.75 3.25Z" fill="#ffffff"></path> </g></svg>
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