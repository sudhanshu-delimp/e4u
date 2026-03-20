
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
            <div class="modal fade opr-modal" id="comman_modal_all" style="display: none">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-white">
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
                            <h5 class="my custom_modal_text" style="text-align: center;">
                            <span id="comman_str"></span>
                            <span class="comman_msg_all"></span>
                            </h5>
                        </div>
                        <div class="modal-footer justify-content-center pt-0">
                            <button type="submit" class="opr-common-btn" data-dismiss="modal" id="close">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    
@include('partials.operator.footer')


