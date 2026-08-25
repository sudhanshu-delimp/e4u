
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

           <a href="{{  getEscortMassageDetailUrl($listing, 'massage') }}" class="mc_card_link">
                

                <div class="mc_profile_img">
                <img src="{{ $massage_thumb  }}" alt="Massage Centre 1"
                        class="mc_card_image">
                 
                </div>

                <div class="mc_card_content">
                    <div class="items">
                        <span class="title text_truncate">{{  get_massage_home_city($listing->user_id) }}</span>
                        <span class="video_icon_ec">
                            @php
                               $videoCnt = checkVideoExistInMcProfile($listing->user_id);
                            @endphp
                            @if($videoCnt > '0')
                                <span class="video_icons">
                                    <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11.25 2C9.88382 2.00133 8.73117 2.01015 7.75 2.0685V6.24976H11.25V2Z" fill="#ff3c5f"></path> <path d="M6.25 2.2214C5.02727 2.41566 4.1485 2.78019 3.46447 3.46423C2.78043 4.14826 2.4159 5.02703 2.22164 6.24976H6.25V2.2214Z" fill="#ff3c5f"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M2 11.9998C2 10.2993 2 8.90556 2.06874 7.74976L21.9313 7.74976C22 8.90556 22 10.2993 22 11.9998C22 13.7002 22 15.094 21.9313 16.2498L2.06874 16.2498C2 15.094 2 13.7002 2 11.9998ZM12.4112 10.4043C13.4704 11.1162 14 11.4722 14 12C14 12.5278 13.4704 12.8838 12.4112 13.5957C11.3375 14.3173 10.8006 14.6781 10.4003 14.4132C10 14.1483 10 13.4322 10 12C10 10.5678 10 9.85174 10.4003 9.58682C10.8006 9.3219 11.3375 9.68271 12.4112 10.4043Z" fill="#ff3c5f"></path> <path d="M21.7784 6.24976C21.5841 5.02703 21.2196 4.14826 20.5355 3.46423C19.8515 2.78019 18.9727 2.41566 17.75 2.2214V6.24976H21.7784Z" fill="#ff3c5f"></path> <path d="M12.75 2C14.1162 2.00133 15.2688 2.01015 16.25 2.0685V6.24976H12.75V2Z" fill="#ff3c5f"></path> <path d="M21.7784 17.7498H17.75V21.7781C18.9727 21.5839 19.8515 21.2193 20.5355 20.5353C21.2196 19.8513 21.5841 18.9725 21.7784 17.7498Z" fill="#ff3c5f"></path> <path d="M16.25 17.7498V21.931C15.2688 21.9894 14.1162 21.9982 12.75 21.9995V17.7498H16.25Z" fill="#ff3c5f"></path> <path d="M11.25 21.9995V17.7498H7.75L7.75 21.931C8.73117 21.9894 9.88382 21.9982 11.25 21.9995Z" fill="#ff3c5f"></path> <path d="M6.25 17.7498L6.25 21.7781C5.02727 21.5839 4.1485 21.2193 3.46447 20.5353C2.78043 19.8513 2.4159 18.9725 2.22164 17.7498H6.25Z" fill="#ff3c5f"></path> </g></svg>
                                </span>  
                                <div class="video_tooltip">Massage Centres has video to view</div>                         
                            @endif

                        </span>
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
                <a href="javascript:void(0)" data-id="{{ $listing->id }}" class="m_removelist"  > Remove to Shortlist</a>
                @else
                <a href="javascript:void(0)" data-id="{{ $listing->id }}" class="m_wishlist"  > Add to Shortlist</a>
                @endif
                
            </div>
        </div>
        @endforeach


        

