@if(global_notifications())
    @foreach(global_notifications() as $notification)
        <x-global_frontend.global-alert :heading="$notification['heading']" :content="$notification['content'] ?? $notification['template_name']" />
    @endforeach
@endif

<nav class="navbar navbar-expand-lg navbar-light main_bg_color py-3 custom--header">
    <div class="container-fluid manage_header_padding justify-content-center position-relative custom--header">
        <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('assets/app/img/logo.png') }}" class="d-inline-block align-top w-100" alt="">
        </a>  
        <div class="back-tohome"><a class="navbar-brand" href="{{ route('home') }}">Back To Home</a></div>
    </div>
</nav>
