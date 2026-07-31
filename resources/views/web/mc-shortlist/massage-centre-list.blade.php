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

    .filter-contain .my-shortlist ul {
        display: flex;
        list-style: none;
        align-items: center;
        margin-left: 40px;
    }

    .filter-contain .my-shortlist ul li h3 {
        font-family: Poppins;
        font-size: 32px;
        font-style: normal;
        font-weight: 700;
        line-height: 32px;
        letter-spacing: 0em;
        text-align: left;
        text-transform: uppercase;
        margin-bottom: 0;
        margin-right: 30px;
    }

    .filter-contain .my-shortlist ul li {
        font-family: Montserrat;
        font-size: 15px;
        font-style: normal;
        font-weight: 500;
        line-height: 18px;
        letter-spacing: -0.015em;
        text-align: end;
        color: #0C223D;
    }

    .filter-contain .my-shortlist ul li a {
        font-family: Montserrat;
        font-size: 15px;
        font-style: normal;
        font-weight: 500;
        line-height: 18px;
        letter-spacing: -0.015em;
        text-align: center;
        color: #0C223D;
        text-decoration: none;
    }

    .filter-contain .my-shortlist ul li i.fa {
        color: #FF3C5F;
        margin-left: 12px;
    }
    .reset_container {
        margin-top: 80px;
        display: flex !important;
        justify-content: center !important;
        align-items: unset !important;
    }
</style>
@endsection

@section('content')
<section class="">
   
    @include('web.mc-shortlist.mc-filter')

    <div class="container mb-5">
            <div class="row grid_list_part grid_wishlist_part filter-contain" id="v_li_wishlist" style="display: block;">
                <div class="col-12 align-items-left">
                    <div class="my-shortlist">
                        <h3>My Shortlist</h3>
                            
                        <button class="back_to_list_btn">
                        
                            <a type="submit" href="{{route('find.massage.centre')}}" data-toggle="tooltip">                                
                                <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <g opacity="0.4"> <path d="M9.00039 15.3802H13.9204C15.6204 15.3802 17.0004 14.0002 17.0004 12.3002C17.0004 10.6002 15.6204 9.22021 13.9204 9.22021H7.15039" stroke="#ffffff" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8.57 10.7701L7 9.19012L8.57 7.62012" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>
                
                                <span class="hide-on-sm" style="margin-right: 10px;"> Back To Listings</span>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!--- Grid View -->
                <div class="col-sm-12" id="grid_view">
                    <h2 class="mc_view_title">Grid View</h2>
                    <div class="mc_card_container"></div>
                </div>

                <!--- List View -->
                <div class="col-sm-12" id="list_view">
                    <h2 class="mc_view_title">List View</h2>
                    <div class="mc_list_container"></div>
                </div>
                <div id="page_loader">
                    <div class="loader"></div>
                </div>
            </div>

            <!--  Pagination -->
             <div id="common_pagination"></div>
             <!-- End Pagination -->

  </div>



    <div class="modal fade upload-modal hh" id="add_wishlist" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title" id="exampleModalLabel"><img
                            src="{{ asset('assets/dashboard/img/short-list-profile.png') }}" class="custompopicon"> <span
                            class="popup_modal_title_new">Add To Shortlist</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <h1 class="custom_modal_text user_short_list" style="text-align: center;">
                        <span id="Lname">[MC Name]</span>
                        has been added to your Shortlist.
                    </h1>
                </div>
                <div class="modal-footer pt-0" style="justify-content: center;">
                    <button type="submit" class="btn-success-modal" data-dismiss="modal"
                        id="close">Ok</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade upload-modal hh" id="my_legbox" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
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
                    <h5 class="custom_modal_text">
                        <span id="Lname">My Legbox is only available to Viewers. Please
                            log in
                            or Register to access your Legbox.</span>
                    </h5>
                </div>
                <div class="modal-footer my_legbox_footer pt-0" style="justify-content: center;">
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
    
var current_filter_flag = "upper_filter";
var activeView = 'grid';
var default_filter = $('input[name="locationByRadio"]:checked').val(); 
$(document).ready(function () {

   
    $('#view_grid').addClass('view-active');
    async function initPage() {
    try 
    {
        if (default_filter!== 'australia') 
        {
            const position = await getCurrentLocation();
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            $("#set_lat").val(latitude);
            $("#set_lng").val(longitude);
            console.log(longitude, latitude, 'rizk-onload');
          
        }
        
       
        
        let filter_by_feild = {};
        let filter_by_location = {
            locationByRadio: $('input[name="locationByRadio"]:checked').val(),
            by_name_member: $('#by_name_member').val(),
            set_lat: $('#set_lat').val(),
            set_lng: $('#set_lng').val(),
            per_page: $('#per_page').val()
        };

        await loadData(1,filter_by_location,filter_by_feild); 
        } catch (error) {
        console.error("Location error:", error);
        await loadData(null, null);
        }
    }


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

    async function loadData(page = 1,filter_by_location = {},filter_by_feild = {}) 
    {

        $('#page_loader').show();

        $.ajax({
            url: "{{ route('shortlist-mc-ajax-list') }}",
            data: { 
                page: page,
                 filter_by_location,
                 filter_by_feild
            },
            success: function (res) {
                $('.mc_card_container').html(res.grid);
                $('.mc_list_container').html(res.list);
                $('.total_count').html(res.total_count);
                $('#common_pagination').html(res.pagination);
                if ($('.mc_card_container').find('.no_listing').length) {
                $('.mc_card_container').addClass('reset_container');
                $('.mc_view_title').html('');
                }
                else
                {
                  $('.mc_card_container').removeClass('reset_container');
                }

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



    ///////  Short List /////////////

    $(document).on('click', '.m_removelist', async function () {
        $('#page_loader').show();
        var wishlist_id = $(this).data('id');
        var grid_id = 'grid_view_'+wishlist_id;
        

        var wishlist_footer_id = 'wishlist_footer_id'+wishlist_id;
        var grid_view ='#grid_view_'+wishlist_id;

         var listbuton =  `<button type="button" class="m_wishlist btn custom-sort-filter btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn shortlist myescort_1887" data-id="${wishlist_id}">
        <img class="listiconprofilelistview" src="../assets/app/img/filter_view.png"> Add to Shortlist
        </button>`;
        
        $.ajax({
            url: "{{ route('web.remove-short-list') }}",
            type: 'POST',
            data: {
                wishlist_id: wishlist_id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: async function (res) {
                  $('#page_loader').hide();
                   let response  = res;  
                   if(response.status)
                   {    $('#session_count').html(response.session_count);
                        ///$('#'+wishlist_footer_id).html('<a href="javascript:void(0)" data-id="'+wishlist_id+'" class="m_wishlist">Add to Shortlist</a>');
                        // $('#'+list_button_wrap_id).html(listbuton);
                        $('.user_short_list').html( `<span id="Lname">${response.data.profile_name}</span> has been remove from your Shortlist.`);
                        $('#add_wishlist').modal('show');
                        $('.mc_card_container '+grid_view+'').remove();
                        const { filter_by_location, filter_by_feild }  = get_current_filter();
                        console.log('filter_by_location',filter_by_location);
                        await loadData(1,filter_by_location,filter_by_feild); 

                   }
            }
        });

    });

    

    /////// Short List ///////////////

    $(document).on('click', '.upper_filter', async function(e){
        e.preventDefault();

        current_filter_flag = 'upper_filter';
        let filter_by_feild = {};
        let filter_by_location = {
            locationByRadio: $('input[name="locationByRadio"]:checked').val(),
            by_name_member: $('#by_name_member').val(),
            set_lat: $('#set_lat').val(),
            set_lng: $('#set_lng').val(),
            per_page: $('#per_page').val()
        };

        await loadData(1,filter_by_location,filter_by_feild); 
    });


    $(document).on('click', '.lower_filter', async function(e){
        e.preventDefault();

        current_filter_flag = 'lower_filter';
        let filter_by_location = {};
        let filter_by_feild = {
            profile_state: $('#profile_state').val(),
            profile_city: $('#profile_city').val(),
            masseur_types: $('#masseur_types').val(),
            profile_age: $('#profile_age').val(),
            profile_price: $('#profile_price').val(),
            massage_services: $('#massage_services').val(),
            other_services: $('#other_services').val(),
            verification: $('#verification').val(),
            
        };

        await loadData(1,filter_by_location,filter_by_feild); 
    });

    initPage();
    setInterval(function() {
    location.reload();
    }, 1800000); 


});


    function get_current_filter()
    {
        if(current_filter_flag=='lower_filter')
        {
            let filter_by_location = {};
            let filter_by_feild = {
            profile_state: $('#profile_state').val(),
            profile_city: $('#profile_city').val(),
            masseur_types: $('#masseur_types').val(),
            profile_age: $('#profile_age').val(),
            profile_price: $('#profile_price').val(),
            massage_services: $('#massage_services').val(),
            other_services: $('#other_services').val(),
            verification: $('#verification').val(),
            };

            return {
                filter_by_location: filter_by_location,
                filter_by_feild: filter_by_feild
                };
        }

        if(current_filter_flag=='upper_filter')
        {
            let filter_by_feild = {};
            let filter_by_location = {
                locationByRadio: $('input[name="locationByRadio"]:checked').val(),
                by_name_member: $('#by_name_member').val(),
                set_lat: $('#set_lat').val(),
                set_lng: $('#set_lng').val(),
                per_page: $('#per_page').val()
            };

            return {
            filter_by_location: filter_by_location,
            filter_by_feild: filter_by_feild
            };
        } 
    }

    function getCurrentLocation() {
        return new Promise((resolve, reject) => {
            navigator.geolocation.getCurrentPosition(
                position => resolve(position),
                error => reject(error)
            );
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


    // ########## Searching Script Start Here ############## /////////
    $('input[name="locationByRadio"]').on('change', async function() 
    {
        let selectedLocation = {};
        selectedLocation.location = $(this).attr('id');
        if (selectedLocation.location == 'yourLocation') 
        {
                const position = await getCurrentLocation();
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                $("#set_lat").val(latitude);
                $("#set_lng").val(longitude);
                console.log(longitude, latitude, ' rizk==change');
        } 
        else 
        {
            $("#set_lat").val('');
            $("#set_lng").val('');
        }

    });

    /////// Accordion’s open-close state in local storage ////////
    document.addEventListener('DOMContentLoaded', function () {
    const collapseEl = document.getElementById('collapseSearch');
    const savedState = localStorage.getItem('collapseSearchState'); 
    if (savedState === 'open') {
        collapseEl.classList.add('show');
    } else {
        collapseEl.classList.remove('show');
    }
    $(collapseEl).on('shown.bs.collapse', function () {
        localStorage.setItem('collapseSearchState', 'open');
    });

    $(collapseEl).on('hidden.bs.collapse', function () {
        localStorage.setItem('collapseSearchState', 'closed');
    });
    });
    ///// Close Accordion’s open-close state in local storage /////



</script>

@endpush