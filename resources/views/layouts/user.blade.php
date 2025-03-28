@include('partials.user.header')

@include('partials.user.navigation')

@yield('content')

@include('partials.user.footer')

@include('partials.user.login-modal')

@section('script')
@show
