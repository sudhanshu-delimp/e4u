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
        <div class="trikon_style manage_toolkit_font"><a href="{{ route('web.pinup', $escort->id) }}">I am your Pin Up
                click here.</a></div>
    @endif
    
    <div class="lg_verify_icon">
                                
        <img src="{{ ('assets/app/img/pending_icon/e4u_pending_REV.png') }}">
        <span class="common_shield_tooltip">Media Pending</span>

    </div>
</div>
