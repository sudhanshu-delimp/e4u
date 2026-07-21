
@php
    $ids = $listings->pluck('id')->toArray();
@endphp

@foreach($listings as $index => $listing)

        @php 

       

        $relativePath   =  $listing->imagePosition(1);
        $currentImage   = asset($relativePath);
        $thumnail   = asset($relativePath);
        if(str_contains($currentImage, 'img-11.png'))
        {
            $massage_thumb = config('escorts.escort_default_thumb');
        }
        else
        {
             if($currentImage!= "" && is_file(public_path($relativePath)))
             $massage_thumb  = $currentImage;
             else
             $massage_thumb = config('escorts.escort_default_thumb');

             
        }
         @endphp   
        <div class="mc_card">

        @if($listing->latest_active_brb)
            <div class="brb--content">
                <div class="brb--wrappr">
                    <span class="brb-text">Closed</span> until <span class="brb-time">{{date('h:i A',strtotime($listing->latest_active_brb->selected_time))}}</span> <br> <span class="brb-date">{{date('d-m-Y',strtotime($listing->latest_active_brb->selected_time))}}</span>
                </div>
            </div>
        @endif


            <div class="mc_card_header">
                @php 
                    $media_verification_status =  get_profile_verification_status($listing->id);
                    $media_status = getMediaVerificationDataSmallIcon(($media_verification_status ?? 0));
                @endphp
                    
                <span class="verify_icon">
                    <img src="{{$media_status['icon']}}" alt="">
                    <span class="mcs_media_tooltip">{{$media_status['label']}}</span>
                </span>
                <span class="mc_title">{{$listing->business_name}}</span>
                 @if(auth()->user())
                    @if(auth()->user()->type == 0)
                        <span class="add_to_favrate @if(in_array($listing->id,$logedInUpser->massageCenterLegBox->pluck('id')->toArray())){{'null'}}@else{{'fill'}}@endif custom--favourite" id="legboxIdList_{{$listing->id}}"  data-massageId="{{$listing->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}" data-name="{{$listing->business_name}} ">
                        @if(!empty($logedInUpser))
                            @if(in_array($listing->id,$logedInUpser->massageCenterLegBox->pluck('id')->toArray()))
                                <i class='fa fa-heart' style='color: #ff3c5f;'  aria-hidden='true'></i>
                                <span class="custom-heart-text">Remove from My Legbox</span>
                            @else
                                <i class="fa fa-heart-o"  aria-hidden='true'></i>
                                <span class="custom-heart-text">Add to My Legbox</span>
                            @endif
                        @endif
                    </span>
                    @else
                        <span class="my_legbox_icon" data-target="#my_legbox" data-toggle="modal">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <span class="mc_legbox_tooltip">Add to My Legbox</span>
                        </span>
                    @endif
                @else
                        <span class="my_legbox_icon" data-target="#my_legbox" data-toggle="modal">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <span class="mc_legbox_tooltip">Add to My Legbox</span>
                        </span>
                @endif
            </div>

            <a href="{{ route('web.massage-description', [
                'id' => $listing->id,
                'ids' => json_encode($ids)
            ]) }}" class="mc_card_link">
        
                

                <div class="mc_profile_img">
                <img src="{{ $massage_thumb  }}" alt="Massage Centre 1"
                        class="mc_card_image">
                 
                </div>

                <div class="mc_card_content">
                    <div class="items">
                        <span class="title text_truncate">{{  get_massage_home_city($listing->user_id) }}</span>
                        <span class="mc_star">
                            @for($i=1; $i<= 5; $i++)
                                @if($listing->star_rating && $listing->star_rating > 0 && $i <= $listing->star_rating)
                                    <i class="fa fa-star" aria-hidden="true" ></i>
                                @else
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                @endif
                            @endfor
                        </span>
                    </div>
                    <div class="items">
                        <span class="title">Video: </span>
                        <span class="decs">
                            <img src="{{ asset('assets/app/img/video_play.svg') }}">
                        </span>
                    </div>
                    <div class="items">
                        <span class="title">Hours: </span>
                        <span class="decs">{{get_working_hours($listing)}}</span>
                    </div>

                    <div class="items">
                        <span class="title">Parking:</span>
                        <span class="decs">{{ config('escorts.profile.Parking.' . $listing->parking, 'N/A') }}</span>
                    </div>

                    <div class="items">
                        <span class="title">Building:</span>
                        <span class="decs">{{ config('escorts.profile.Building.' . $listing->parking, 'N/A') }}</span>
                    </div>

                     <div class="items">
                        <span class="title">Shower:</span> 
                        <span class="decs">{{ config('escorts.profile.Shower.' . $listing->parking, 'N/A') }}</span>
                    </div>
                </div>
            </a>
            <div class="mc_card_footer wishlist_footer" id="wishlist_footer_id{{ $listing->id }}">
                @if(in_array($listing->id, session('wishlist', [])))
                <a href="javascript:void(0)" data-id="{{ $listing->id }}" class="m_removelist"  >Remove to Shortlist</a>
                @else
                <a href="javascript:void(0)" data-id="{{ $listing->id }}" class="m_wishlist"  >Add to Shortlist</a>
                @endif
                
            </div>
        </div>
        @endforeach


        

