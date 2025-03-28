@include('partials.web.header')

@include('partials.web.navigation')

@yield('content')

@include('partials.web.footer')

@include('partials.web.login-modal')

@section('script')
@show
