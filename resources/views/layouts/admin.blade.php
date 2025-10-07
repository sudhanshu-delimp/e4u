
@include('partials.admin.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.admin.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                @include('partials.admin.navigation')

                @yield('content')

            </div>
        </div>


        <div class="modal" id="my_account_modal" style="display: none">
            <div class="modal-backdrop show"></div>
            <div class="modal-dialog modal-dialog-centered" style="z-index: 9999;">
                <div class="modal-content rounded-0">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/remove-image.png') }}" class="custompopicon"> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                    <h1 class="mb-4 mt-4"><span class="Lname"></span> </h1>
                    <button type="button" class="btn-success-modal" data-dismiss="modal" id="close">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="comman_modal" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/upload-photos.png') }}" class="custompopicon"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h1 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                        <span id="comman_str"></span>
                        <span class="comman_msg"></span>
                        </h1>
                    </div>
                    <div class="modal-footer" style="justify-content: center;">
                        <button type="submit" class="btn-success-modal" data-dismiss="modal" id="close">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@include('partials.admin.footer')


