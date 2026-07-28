<div href="#" class="tip mb-2 d_custom_home_img lg_icon_wrapper">
    <img style="" class="img-fluid"
        src="{{ !empty($escort->user->defaultPinupImage) ? asset($escort->user->defaultPinupImage->path) : asset('assets/app/img/home/home-demo.png') }}">
    <span class="memmber_info"><i class="fa fa-user"></i> Member ID: {{ $escort->user->member_id }}</span>
    @if ($escort->latestActiveBrb)
        <p class="pinup_brb_strip">BRB at <span>
                {{ date('h:i A d-m-Y', strtotime($escort->latestActiveBrb->selected_time)) }} <br>
                {{ $escort->latestActiveBrb->brb_note }}</span></p>
    @endif
    @if (!empty($escort->user->defaultPinupImage))
        <div class="trikon_style manage_toolkit_font">
            <svg width="25px" height="25px" class="pinup-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <circle cx="12" cy="10" r="3" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></circle>
                    <path
                        d="M19 9.75C19 15.375 12 21 12 21C12 21 5 15.375 5 9.75C5 6.02208 8.13401 3 12 3C15.866 3 19 6.02208 19 9.75Z"
                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </svg> <a href="{{ route('web.pinup', $escort->id) }}">I am your Pin Up
                click here.</a>
        </div>
    @endif
    @php

        $pinup_data = get_escort_media_id_by_path($escort->user->defaultPinupImage->path);
        $status = $pinup_data->varified ?? 0;
        $status_icon = getMediaVerificationDataBigIcon($status);
    @endphp
    <div class="lg_verify_icon">
        <img src="{{ $status_icon['icon'] }}">
        <span class="common_shield_tooltip">{{ $status_icon['label'] }}</span>

    </div>
</div>
