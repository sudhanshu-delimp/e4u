
@include('partials.center.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.center.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                @include('partials.center.navigation')
                <div>@include('flash-message')</div>
                @yield('content')

            </div>
            <div class="modal upload-modal fade" id="my_account_modal" style="display: none">
                <div class="modal-dialog modal-dialog-centered"> 
                    <div class="modal-content">
                        <div class="modal-body text-center">
                        <img src="{{ asset('assets/app/img/check-box.png')}}">
                        <h3 class="mb-4 mt-5"><span class="Lname"></span> </h3>
                        <button type="button" class="save_profile_btn" data-dismiss="modal" id="close">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal upload-modal fade" id="comman_modal" style="display: none">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" >
                                <img src="{{ asset('assets/dashboard/img/save-setting.png')}}" class="custompopicon" id="modal-icon">
                                <span id="modal-title"></span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                            
                            </span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5 class="custom_modal_text mb-0" style="text-align: center;">
                            <span id="comman_str"></span>
                            <span class="comman_msg"></span>
                            </h5>
                        </div>
                        <div class="modal-footer justify-content-center pt-0">
                            <button type="submit" class="btn main_bg_color site_btn_primary common_modal_close_btn" data-dismiss="modal" id="close">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('partials.center.footer')

@section('script')
@show
