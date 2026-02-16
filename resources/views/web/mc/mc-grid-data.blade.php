


 @foreach($listings as $listing)

        @php 


        $relativePath   =  $listing->imagePosition(1);
        $currentImage   = asset($relativePath);
        if(str_contains($currentImage, 'img-11.png'))
        {
            $massage_thumb = config('escorts.escort_default_thumb');
        }
        else
        {
             if($currentImage!= "" && file_exists($relativePath))
             $massage_thumb  = $currentImage;
             else
             $massage_thumb = config('escorts.escort_default_thumb');

             
        }
         @endphp   
        <div class="mc_card">

            <div class="mc_card_header">
                <span class="verify_icon">
                    <img src="{{ asset('assets/app/img/verify/unverified_icon.png') }}" alt="">
                    <span class="mc_media_tooltip">Media Unverified</span>
                </span>
                <span class="mc_title">{{$listing->profile_name}}</span>
                <span class="my_legbox_icon" data-target="#my_legbox" data-toggle="modal">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                    <span class="mc_legbox_tooltip">Add to My Legbox</span>
                </span>
            </div>
            <a href="{{ route('web.massage-description',$listing->id) }}" class="mc_card_link">
                <div class="mc_profile_img">

                

                <img src="{{ $massage_thumb }}" alt="Massage Centre 1"
                        class="mc_card_image">
                 
                </div>

                <div class="mc_card_content">
                    <div class="items">
                        <span class="title">{{  get_massage_home_state($listing->user_id) }}</span>
                        <span class="mc_star">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </span>
                    </div>

                    <div class="items">
                        <span class="title">Hours:</span>
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
            <div class="mc_card_footer">
                <a href="#" data-target="#add_wishlist" data-toggle="modal">Add to Shortlist</a>
                
            </div>
        </div>
        @endforeach


        

