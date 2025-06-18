@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style type="text/css">
.parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
}

.dataTables_filter label {
    display: none;
}
.dataTables_length{
    display: none;
}

#cke_1_contents {
    height: 150px !important;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
    <!--middle content-->
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading">
                <h1> Massage Centre Listings <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        style="font-size:16px"><b>Help?</b> </span></h1>
            </div>
            <div class=" my-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>All current (published) Listings are displayed in this table.</li>
                            <li>You have limited Action access according to your security level.</li>
                            <li>Prefixes:</li>
                            <p>1. ACT  &nbsp;&nbsp;2. NSW  &nbsp;&nbsp;3. Vic  &nbsp;&nbsp;4. Qld  &nbsp;&nbsp;5. SA  &nbsp;&nbsp;6. WA  &nbsp;&nbsp;7. Tas  &nbsp;&nbsp;8. NT</p>
                            
                        </ol>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="row my-3">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <form class="search-form-bg navbar-search" style="width: 310px;">
                        <div class="input-group">
                            
                            <input type="search" class="search-form-bg-i form-control border-0 small"
                                placeholder="Search by Member ID & Profile Name..  " id="customSearch" aria-label="Search" aria-describedby="basic-addon2" style="font-size: 13px;">   
                            <div class="input-group-append">
                                <button class="btn-right-icon" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>                         
                        </div>
                        
                    </form>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
                  
                    <div class="total_listing">
                        <div><span>Total Listings : </span></div>
                        <div><span class="totalListing">4,456</span></div>
                    </div>
                </div>
            </div>
            <div class="massage_table_class">
                <table class="table table-bordered" id="listings" style="width:100%;">
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
                            <th scope="col">Masseurs</th>
                            <th scope="col">Listed</th>
                            <th scope="col">De-listed</th>
                            <th scope="col">Days</th>
                            <th scope="col">Left</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-content">
                        <tr class="row-color">
                            <td colspan="10" class="theme-color text-center">Loading...</td>
                            </tr>
                        {{-- <tr class="row-color">
                            <td width="10%" class="theme-color">M60178</td>
                            <td class="theme-color">Lins Massage</td>
                            <td class="theme-color">Perth</td>
                            <td class="theme-color">Perth 01</td>
                            <td class="theme-color">4</td>
                            <td class="theme-color">23-05-2025</td>
                            <td class="theme-color">17-06-2025</td>
                            <td class="theme-color">14</td>
                            <td class="theme-color">15</td>
                            <td>
                                <div class="dropdown no-arrow ml-3">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="">
                                        <a class="dropdown-item d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#view-listing" href="#">View Listing <i class="fa fa-eye text-dark"
                                                style="color: var(--peach);" ></i></a>
                                    </div>
                                </div>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
                
                <div class="timer_section">
                    <p>Server time: <span class="serverTime">10:23:51 am</span></p>
                    <p>Refresh time:<span class="refreshSeconds"> 15</span></p>
                    <p>Up time: <span class="uptimeClass">{{getAppUptime()}}</span></p>
                </div>
                <div class="customPaginationContainer mt-4 d-flex justify-content-between"></div>
                <nav aria-label="Page navigation example" class="customPagination">
                    {{-- <ul class="pagination float-right pt-4">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul> --}}
                    
                </nav>
            </div>
        </div>
       
    </div>
</div>

<!--middle content end here-->
<!--right side bar start from here-->
</div>
<!--right side bar end-->
</div>

<div class="modal fade upload-modal" id="view-listing" tabindex="-1" role="dialog" aria-labelledby="view-listingLabel"
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
                            <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
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
</div>

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
                    $('#listings').DataTable().ajax.reload(null, false);
                    countdown = 15;
                }

            }, 1000);

            $('#customSearch').on('keyup', function() {
                $('#listings').DataTable().search(this.value).draw();
            });
        })

        function ajaxReload()
        {
            var table = $('#listings').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            info: true, // optional: hides "Showing X of Y"
            searching: true,
            ajax: {
                url: "{{ route('escort.current.list.dataTableListing', 'current') }}",
                type: "GET",
                dataSrc: function(json) {
                    console.log('json.data');
                    console.log(json.data);
                    //$(".customePaginationShow").html($("#listings_info").html()+$("#listings_paginate").html());
                    // buildCustomPagination(json.recordsTotal);
                    var totalRows = json.data.length; 
                    $(".totalListing").text(totalRows);
                    console.log(json, json.per_page, json.current_page);
                    //buildCustomPagination(json.recordsTotal, 3, 1);
                    // buildCustomPagination(json.recordsTotal, json.per_page, json.current_page);
                    return json.data;
                }
            },
             drawCallback: function (settings) {
                // Move dynamic elements below .timer_section
                const $info = $('#listings_info');
                const $paginate = $('#listings_paginate');
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
                { data: 'masseurs', name: 'masseurs' },
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
                                    <a class="dropdown-item d-flex justify-content-between align-items-center view-listing" 
                                    data-toggle="modal" data-target="#view-listing" data-id="`+row.id+`" href="#">
                                        View Listing 
                                        <i class="fa fa-eye text-dark" style="color: var(--peach);"></i>
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
                url: '{{route("escort.current.single-list.dataTableListing")}}/' + escortId, // replace with your actual route
                method: 'GET',
                success: function(response) {
                    console.log('response');
                    console.log(response);
                    // populate modal with response data
                    $(".pop_member_id").text(response.member_id);
                    $(".pop_member").text(response.member);
                    $(".pop_listing").text(response.listing);
                    $(".pop_profile_name").text(response.profile_name);
                    $(".pop_masseurs").text(response.masseurs);
                    $(".pop_listed_date").text(response.start_date);
                    $(".pop_de_listed").text(response.end_date);
                    $(".pop_day").text(response.days);
                    $(".pop_day_left").text(response.left_days);

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