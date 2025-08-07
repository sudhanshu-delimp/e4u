@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
.parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
}

#cke_1_contents {
    height: 150px !important;
}
/* .dataTables_filter label {
    display: none;
} */
/* .dataTables_length{
    display: none;
} */
#escort_listings{
    margin-bottom: 0px !important;
}
    .brb_icon {
        color: white;
        background-color: #e5365a;
        border-radius: 15%;
        padding: 0 5px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content-->
    <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                    <h1 class="h1"> Escort Listings</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    style="font-size:16px"><b>Help?</b> </span>
            </div>            
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>All current (published) Listings are displayed in this table.</li>
                            <li>You have limited Action access according to your security level.</li>
                            <li>Prefixes:</li>
                            <p>1. ACT &nbsp;&nbsp;2. NSW &nbsp;&nbsp;3. Vic &nbsp;&nbsp;4. Qld &nbsp;&nbsp;5. SA &nbsp;&nbsp;6. W A &nbsp;&nbsp;7. Tas &nbsp;&nbsp;8. NT</p>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="row my-3">
                {{-- <div class="col-lg-4 col-md-12 col-sm-12">
                    <form class="search-form-bg navbar-search">
                        <div class="input-group">
                            <input type="text" class="search-form-bg-i form-control border-0 small"
                               style="font-size: 13px;" placeholder="Search by Member ID & Profile Name..  " id="customSearch" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn-right-icon" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> --}}
                <div class="col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
                  
                    <div class="total_listing">
                        <div><span>Total Listings : </span></div>
                        <div><span class="totalListing">4,456</span></div>
                    </div>
                </div>
            </div>
            <div class="massage_table_class">
                <table class="table" id="escort_listings" style="width:100%;">
                    <thead class="table-bg">
                        <tr>
                            <th scope="col">
                                Member ID

                            </th>
                            <th scope="col">
                                Member

                            </th>
                            <th scope="col">
                                Listing
                            </th>
                            <th scope="col">
                                Profile Name
                            </th>
                            <th scope="col">Type</th>
                            <th scope="col">Listed</th>
                            <th scope="col">De-list</th>
                            <th scope="col">Days</th>
                            <th scope="col">Remaining</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-content">
                        <tr class="row-color">
                            <td colspan="10" class="theme-color text-center">Loading...</td>
                        </tr>
                    </tbody>
                </table>
                <div class="timer_section">
                    <p>Server time: <span class="serverTime">10:23:51 am</span></p>
                    <p>Refresh time:<span class="refreshSeconds"> 15</span></p>
                    <p>Up time: <span class="uptimeClass">{{getAppUptime()}}</span></p>
                </div>
                <div class="customPaginationContainer mt-4 d-flex justify-content-between "></div>
                
            </div>
        </div>
       {{-- <div class="col-sm-12 col-md-12 col-lg-12">
       <div class="timer_section">
            <p>Server time: <span>[10:23:51 am]</span></p>
            <p>Refresh time:<span> [seconds]</span></p>
            <p>Up time: <span>[214 days & 09 hours 12 minutes]</span></p>
        </div> --}}
       </div>
    </div>
</div>

<!--middle content end here-->
<!--right side bar start from here-->
</div>
<!--right side bar end-->
</div>


<!-- See Email Report popup -->


<div class="modal fade upload-modal bd-example-modal-lg" id="view-listing" tabindex="-1" role="dialog" aria-labelledby="emailReportLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
      <div class="modal-content basic-modal modal-lg">
         <div class="modal-header">
            <h5 class="modal-title" id="emailReport"><img src="{{ asset('assets/dashboard/img/view-listing.png')}}" class="custompopicon">  Listing</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body" id="escortPopupModalBody">
            <iframe src="" id="escortPopupModalBodyIframe" frameborder="0" style="width:100%; height:80vh;" allowfullscreen></iframe>

         </div>
      </div>
   </div>
</div>
<!-- end -->

{{-- <div class="modal fade upload-modal" id="view-listing" tabindex="-1" role="dialog" aria-labelledby="view-listingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="view-listing"><img src="{{ asset('assets/app/img/data-listing.png')}}" alt="alert" style="width:29px;">
                    Listing
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <form>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div id="listingModalContent">
                                <iframe src="" id="escortPopupModalBodyIframe" frameborder="0" style="width:100%; height:80vh;" allowfullscreen></iframe>
                            {{-- <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
                                <tbody>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Member ID</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;" class="pop_member_id">M60178</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Member</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;" class="pop_member">Lins Massage</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Listing</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;" class="pop_listing">Perth</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Profile Name</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;" class="pop_profile_name">Perth 01</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Masseurs</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;" class="pop_masseurs">4</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Listed Date</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;" class="pop_listed_date">23-05-2025</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>De-listed Date</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;" class="pop_de_listed">17-06-2025</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Days</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;" class="pop_day">14</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Days Left</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;" class="pop_day_left">15</td>
                                    </tr>
                                </tbody>
                            </table> 

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer pb-4 mb-2">
                <button type="button" class="btn btn-primary">Publish</button>
            </div> -->
        </div>
    </div>
</div> --}}
<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor1', {
    fullPage: true,
    extraPlugins: 'docprops',
    // Disable content filtering because if you use full page mode, you probably
    // want to  freely enter any HTML content in source mode without any limitations.
    allowedContent: true,
    height: 320
});
</script>

@endsection
@push('script')

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}
    "></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(e) {
            ajaxReload();
            let countdown = 15;
            setInterval(() => {
                countdown--;
                $(".refreshSeconds").text(' '+countdown);

                if (countdown <= 0) {
                    $('#escort_listings').DataTable().ajax.reload(null, false);
                    countdown = 15;
                    
                }

            }, 1000);

            $('#customSearch').on('keyup', function() {
                $('#escort_listings').DataTable().search(this.value).draw();
            });
        })

        function ajaxReload()
        {
            var table = $('#escort_listings').DataTable({
                language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Member ID..."
            },   
            info: true,
            lengthChange: true,
            searching: true,
            bStateSave: true,
            order: [[1, 'desc']],
            processing: true,
            serverSide: true,
            paging: true,
            ajax: {
                url: "{{ route('escort.current.list.escort-dataTableListing', 'current') }}", 
                type: "GET",
                dataSrc: function(json) {
                    // var totalRows = json.data.length; 
                    var totalRows = json.recordsTotal || json.recordsFiltered; 
                    $(".totalListing").text(totalRows);
                    console.log(json, json.per_page, json.current_page);
                    //buildCustomPagination(json.recordsTotal, 3, 1);
                    // buildCustomPagination(json.recordsTotal, json.per_page, json.current_page);
                    return json.data;
                }
            },
             drawCallback: function (settings) {
                // Move dynamic elements below .timer_section
                const $info = $('#escort_listings_info');
                const $paginate = $('#escort_listings_paginate');
                const $timerSection = $('.customPaginationContainer');

                if ($info.length && $paginate.length && $timerSection.length) {
                    $info.appendTo($timerSection);
                    $paginate.appendTo($timerSection);
                }
            },
            columns: [
                { data: 'member_id', name: 'member_id' },
                { data: 'member', name: 'member' },
                { data: 'listing', name: 'listing' },
                { data: 'profile_name', name: 'profile_name' },
                { data: 'type', name: 'type' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'days', name: 'days' },
                { data: 'left_days', name: 'left_days' },
                { data: 'action', name: 'action', orderable: false }
            ],
            columnDefs: [
                {
                    targets: [0,1,2,3,4,5,6,7,8],
                    createdCell: function(td) {
                        $(td).addClass('theme-color');
                    }
                },
                {
                    targets: 9,
                    orderable: false,
                    render: function(data, type, row) {
                        $(".serverTime").text(row.server_time);
                        $(".uptimeClass").html(row.upTime);
                        return `
                            <div class="dropdown no-arrow ml-3">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center view-listing" 
                                    data-toggle="modal" data-target="#view-listing" data-id="`+row.id+`" href="#">
                                        <i class="fa fa-eye "></i> View Listing 
                                        
                                    </a>
                                </div>
                            </div>
                        `;
                    }
                }
            ]
        });

        }

        $(document).on('click', '.view-listing', function(e) {
            e.preventDefault(); // prevent default link behavior

            const escortId = $(this).data('id');

            $.ajax({
                url: '{{route("escort.current.single-list.escort-dataTableListing")}}/' + escortId, // replace with your actual route
                method: 'GET',
                success: function(response) {
                    console.log('response');
                    console.log(response);
                    // populate modal with response data
                    // $(".pop_member_id").text(response.member_id);
                    // $(".pop_member").text(response.member);
                    // $(".pop_listing").text(response.listing);
                    // $(".pop_profile_name").text(response.profile_name);
                    // $(".pop_masseurs").text(response.type);
                    // $(".pop_listed_date").text(response.start_date);
                    // $(".pop_de_listed").text(response.end_date);
                    // $(".pop_day").text(response.days);
                    // $(".pop_day_left").text(response.left_days);

                    console.log('heys ');
                    console.log(response.profileurl);

                    $("#escortPopupModalBodyIframe").attr('src', response.profileurl)

                    //$('#view-listing .modal-body').html(response); // assuming modal has a .modal-body
                },
                error: function(xhr) {
                    console.error('Failed to fetch data');
                    $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
                }
            });
        });

        $(document).ready(function () {
            function checkAndApplyResponsive() {
                if ($(window).width() < 1500) {
                    if (!$('.massage_table_class').hasClass('table-responsive')) {
                        $('.massage_table_class').addClass('table-responsive');
                    }
                } else {
                    $('.massage_table_class').removeClass('table-responsive');
                }
            }

            // Initial check
            checkAndApplyResponsive();

            // Recheck on window resize
            $(window).resize(function () {
                checkAndApplyResponsive();
            });
        });

    </script>

@endpush