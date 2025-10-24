
@include('partials.shareholder.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.shareholder.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            {{-- Main Content --}}
            <div id="content">

                @include('partials.shareholder.navigation')

                @yield('content')

            </div>
            {{-- end main content --}}
        </div>

    </div>

    
@include('partials.shareholder.footer')


