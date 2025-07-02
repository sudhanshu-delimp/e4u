<div class="col-md-4 col-lg-4 col-sm-12 col-12 mb-4">
    <div class="box_shdow_service_provider_list_view freelist_view_padding">
        <div class="d-flex freelist_view_flex_gap flex_direction_column_in_responsive" >
            <div><a href="{{ route('profile.description',[$escort->id,$escort->city_id])}}?list&brb={{isset($escort->latestActiveBrb->id) ? $escort->latestActiveBrb->id : ''}}">
            @if($escort->latestActiveBrb)
                <div class="brb--content">
                    <div class="brb--wrappr">
                        <span class="brb-text">BRB</span> at <span class="brb-time">{{date('h:i A',strtotime($escort->latestActiveBrb->selected_time))}}</span> <span class="brb-date">{{date('d-m-Y',strtotime($escort->latestActiveBrb->selected_time))}}</span>
                    </div>
                </div>
            @endif
                <img src="{{ asset('assets/app/img/service-provider/Frame-408.png') }}" class="img-fluid height_for_free"></a></div>
            <div>
                <div class="d-flex justify-content-between">
                    <div class="list_view_sil_and_free_name">{{$escort->name}}</div>
                    <div class="age"><span class="margin_and_font_size_color_for_free">AGE:</span><span class="free_profile_age_color_and_font">{{$escort->age}}</span></div>
                </div>
                <div class="d-flex justify-content-between pt-2">
                    <div class="perth">
                        <p class="mb-0"><span class="profile_location_icon"><i class="fa fa-map-marker" aria-hidden="true" style="font-size: 15px;"></i></span> {{$escort->city ? $escort->city->name : ''}} :</p>
                    </div>
                    <div class="parth_icons">
                        <img class="list_view_free_img_height_width" src="{{ asset('assets/app/img/handwithhart.png')}}">
                        <img class="list_view_free_img_height_width" src="{{ asset('assets/app/img/aeroupimg.png')}}">
                        <img class="list_view_free_img_height_width" src="{{ asset('assets/app/img/areodownimg.png')}}">
                    </div>
                </div>
                <div class="d-flex justify-content-between pt-2">
                    <div class="avilableto text-capitalize">avilable To:</div>
                    <div class="free_profile_avilabletoimg_size d-flex align-items-center">
                        @if($escort->available_to)
                        @foreach($escort->available_to as $key => $available_to)
                        <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}" title="{{ config('escorts.profile.available-to')[$available_to] }}">
                        @endforeach
                        @endif                           
                    </div>
                </div>
                @php
                    $plainTextAbout = strip_tags($escort->about);
                    $limitText = Str::limit($plainTextAbout, 200, '...');
                @endphp
                <p class="list_view_profile_pera_font_size pt-2">
                        {!! $limitText !!} 
                            @if(strlen($plainTextAbout) > 200)
                                <a href="{{ route('profile.description', $escort->id) }}?list" class="h6 text-danger">Read More</a>
                        @endif
                </p>
            </div>
        </div>
    </div>
</div>