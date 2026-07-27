
@include('partials.agent.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.agent.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                @include('partials.agent.navigation')
                <div>@include('flash-message')</div>
                @yield('content')

            </div>
            <div class="modal upload-modal fade" id="comman_modal" style="display: none">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title ">
                                <img src="{{ asset('assets/dashboard/img/save-setting.png') }}" class="custompopicon" id="modal-icon"> 
                                <span style="color:white" id="modal-title"></span>
                            </h5>
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                            </span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h1 class="custom_modal_text" style="text-align: center;">
                            <span id="comman_str"></span>
                            <span class="comman_msg"></span>
                            </h1>
                        </div>
                        <div class="modal-footer justify-content-center pt-0">
                            <button type="submit" class="btn-success-modal" data-dismiss="modal" id="close">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('partials.agent.footer')


