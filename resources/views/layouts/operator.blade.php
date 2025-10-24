
@include('partials.operator.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.operator.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            {{-- Main Content --}}
            <div id="content">

                @include('partials.operator.navigation')

                @yield('content')

            </div>
            {{-- end main content --}}
        </div>

    </div>

    
@include('partials.operator.footer')


