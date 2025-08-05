<div href="#" class="tip mb-2">
    <img style="box-shadow: 2px 3px 2px #bdbdbdbd;" class="img-fluid" src="{{ !empty($profile_image)?asset($profile_image->path):asset('assets/app/img/home/home-demo.png') }}">
    @if(!empty($profile_image))
        <div class="trikon_style manage_toolkit_font"><a href="{{route('web.pinup')}}">I am your Pin Up click here.</a></div>
    @endif
</div>