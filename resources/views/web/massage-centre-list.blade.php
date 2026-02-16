@extends('layouts.web')
@section('style')
<style>
    #view_list svg path,
    #view_grid svg path {
        stroke: #000;
        transition: stroke 0.3s;
    }


    #view_list:hover svg path,
    #view_grid:hover svg path {
        stroke: #fff;
    }


    .view-active svg path {
        stroke: #ff3c5f !important;
    }

    #page_loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(12, 34, 61, 0.7);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #ff3c5f;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 0.8s linear infinite;
    }
    

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .page-link-custom {
        background: #0C223d;
        color: #fff;
        padding: 6px 12px;
        display: inline-block;
        border-radius: 4px;
        text-decoration: none;
    }

    .page-link-custom.active-page {
        background: #F2F2F2;
        color: #ff3c5f;
        font-weight: bold;
    }


</style>
@endsection
@section('content')
<section class="">
   
    @include('web.mc.mc-filter')

    <div class="container my-5">

            <div class="row">

                <!-- ////// Grid View ///////////////// -->
                <div class="col-sm-12" id="grid_view">
                    <h2 class="mc_view_title">Grid View</h2>
                    <div class="mc_card_container"></div>
                </div>

                <!-- ////// List View ///////////////// -->
                <div class="col-sm-12" id="list_view">
                    <h2 class="mc_view_title">List View</h2>
                    <div class="mc_list_container"></div>
                </div>


                <div id="page_loader">
                    <div class="loader"></div>
                </div>

            </div>

            <!-- ////// Pagination ///////////////// -->
             <div id="common_pagination"></div>
             <!-- ////// End Pagination ///////////////// -->

  </div>



    <div class="modal fade hh" id="add_wishlist" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title" id="exampleModalLabel"><img
                            src="{{ asset('assets/app/img/my-legbox.png') }}" class="custompopicon"> <span
                            class="popup_modal_title_new">Add To Shortlist</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body pb-0" style="padding: 15px 0px;">
                    <h1 class="popu_heading_style mb-4 mt-4" style="text-align: center;">
                        <span id="Lname">[MC Name]</span>
                        has been added to your Shortlist.
                    </h1>
                </div>
                <div class="modal-footer pt-0" style="justify-content: center;">
                    <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal"
                        id="close">Ok</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade hh" id="my_legbox" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title" id="exampleModalLabel"> <img
                            src="{{ asset('assets/app/img/my-legbox.png') }}" class="custompopicon"> <span
                            class=" popup_modal_title_new">My Legbox</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="popu_heading_style mb-4 mt-4" style="text-align: center;">
                        <span id="Lname " class="my_legbox_title">My Legbox is only available to Viewers. Please
                            log in
                            or Register to access your Legbox.</span>
                    </h1>
                </div>
                <div class="modal-footer my_legbox_footer" style="justify-content: center;">
                    <a href="{{ route('viewer.login') }}" type="button"
                        class="btn-cancel-modal text-decoration-none text-white" id="loginUrl">Login</a>
                    <a href="{{ route('register') }}" type="button"
                        class="btn-success-modal text-decoration-none text-white" id="regUrl">Register</a>
                </div>

            </div>
        </div>
    </div>
<input type="hidden" id="activeView" value="grid">
</section>
@endsection


@push('scripts')
<script>
$(document).ready(function () {

    let activeView = 'grid';
    $('#view_grid').addClass('view-active');
    loadData();

    /* ===============================
       VIEW SWITCH
    =============================== */

    $('#view_grid').on('click', function () {
        activeView = 'grid';
        $('#activeView').val('grid');

        $('#list_view').hide();
        $('#grid_view').show();

        $('.view-active').removeClass('view-active');
        $(this).addClass('view-active active');
    });

    $('#view_list').on('click', function () {
        activeView = 'list';
        $('#activeView').val('list');

        $('#grid_view').hide();
        $('#list_view').show();

        $('.view-active').removeClass('view-active active');
        $(this).addClass('view-active active');
    });



    /* ===============================
       PAGINATION 
    =============================== */

    $(document).on('click', '.custom-pagination a', function (e) {
        e.preventDefault();

        let url = $(this).attr('href');
        if (!url || url === '#') return;

        let page = getParameterByName('page', url);
        if (!page) page = 1;

        loadData(page);
    });



    /* ===============================
       AJAX LOAD FUNCTION
    =============================== */

    function loadData(page = 1) 
    {

        $('#page_loader').show();

        $.ajax({
            url: "{{ route('mc-ajax-list') }}",
            data: { page: page },
            success: function (res) {

               
                $('.mc_card_container').html(res.grid);
                $('.mc_list_container').html(res.list);
                $('.total_count').html(res.total_count);
                

                
                $('#common_pagination').html(res.pagination);

                if ($('#activeView').val() === 'grid') {
                    $('#list_view').hide();
                    $('#grid_view').show();
                } else {
                    $('#grid_view').hide();
                    $('#list_view').show();
                }
            },
            complete: function () {
                $('#page_loader').hide();
            }
        });
    }

    function getParameterByName(name, url) {
        name = name.replace(/[\[\]]/g, '\\$&');
        let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
        let results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

});

</script>

@endpush