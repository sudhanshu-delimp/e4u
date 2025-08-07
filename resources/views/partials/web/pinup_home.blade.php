<div href="#" class="tip mb-2 d_custom_home_img">
    <img style="" class="img-fluid" src="{{ !empty($profile_image)?asset($profile_image->path):asset('assets/app/img/home/home-demo.png') }}">
    <span class="memmber_info"><i class="fa fa-user"></i> Member ID: {{$user->member_id}}</span>
    @if(!empty($profile_image))
        <div class="trikon_style manage_toolkit_font"><a href="{{route('web.pinup')}}">I am your Pin Up click here.</a></div>
    @endif
</div>