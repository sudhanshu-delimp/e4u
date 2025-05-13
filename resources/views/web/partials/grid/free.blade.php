
<div class="col-lg col-md-6 col-sm-6 mb-2">
    <a href="{{ route('profile.description',[$escort->id, $escort->city_id, $escort->membership])}}">
        <div class="card card_box_style">
        @if($escort->latestActiveBrb)
                <div class="brb--content">
                    <div class="brb--wrappr">
                        <span class="brb-text">BRB</span> at <span class="brb-time">{{date('h:i A',strtotime($escort->latestActiveBrb->brb_time))}}</span> <span class="brb-date">{{date('d-m-Y',strtotime($escort->latestActiveBrb->brb_time))}}</span>
                    </div>
                </div>
            @endif
            <img class="card-img-top" src="{{ asset('assets/app/img/service-provider/Frame-408.png') }}" alt="Card image cap">
            <div class="nine_column_content_top nine_column_top_font_size">
                <span class="card_top_title_center">{{$escort->name}} </span>
            </div>
            <div class="content_bottom_and_padding_all_side_nine_col">
                <div class="display_inline_block nine_column_top_font_size"><span>{{$escort->city ? $escort->city->name : ''}} {{ $escort->age ? " - ".$escort->age : "" }}</span></div>
                <div class="d-flex justify-content-between nine_column_top_font_size">
                    <span>Price:</span>
                    <span>From $ {{$escort->durations()->where('name','1 Hour')->first() ? $escort->durations()->where('name','1 Hour')->first()->pivot->massage_price : ''}} / hr</span>
                </div>
                <div class="nine_column_top_font_size d-flex justify-content-between">
                    <span>Services:</span>
                    <span class="image_height_width_for_col_nine">
                    <img src="{{ asset('assets/app/img/aerodownicon.svg') }}">
                    <img src="{{ asset('assets/app/img/upaeroicon.svg') }}">
                    </span>
                </div>
            </div>
        </div>
    </a>
</div>