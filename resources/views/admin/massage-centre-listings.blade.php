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
#listings_paginate span{
display: contents;
}
 table.dataTable thead th, table.dataTable tfoot th {
            font-weight: normal !important;
        }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content-->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">            
            <h1 class="h1"> Massage Centre Listings</h1>
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
                        <p>1. ACT  &nbsp;&nbsp;2. NSW  &nbsp;&nbsp;3. Vic  &nbsp;&nbsp;4. Qld  &nbsp;&nbsp;5. SA  &nbsp;&nbsp;6. WA  &nbsp;&nbsp;7. Tas  &nbsp;&nbsp;8. NT.</p>
                        
                    </ol>

                </div>
            </div>
        </div>
    </div>
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="row my-3">
                
                <div class="col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
                  
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
                <div class="customPaginationContainer mt-4 d-flex justify-content-between"></div>
                <nav aria-label="Page navigation example" class="customPagination">
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

<!-- See Email Report popup -->


<div class="modal fade upload-modal bd-example-modal-lg" id="view-listing" tabindex="-1" role="dialog" aria-labelledby="emailReportLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
      <div class="modal-content basic-modal modal-lg">
         <div class="modal-header">
            <h5 class="modal-title" id="emailReport"> <img src="{{ asset('assets/dashboard/img/view-listing.png')}}" class="custompopicon"> Listing</h5>
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

@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

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
                language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Member ID..."
            },
            processing: true,
            serverSide: true,
            paging: true,
            lengthChange: true,
            info: true,
            searching: true,
            bStateSave: true,
            order: [[1, 'desc']],
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            pageLength: 10,
            ajax: {
                url: "{{ route('escort.current.list.dataTableListing', 'current') }}",
                type: "GET",
                dataSrc: function(json) {
                    console.log('json.data');
                    console.log(json.data);
                    //$(".customePaginationShow").html($("#listings_info").html()+$("#listings_paginate").html());
                    // buildCustomPagination(json.recordsTotal);
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
                { data: 'start_date', name: 'start_date', orderable: false },
                { data: 'end_date', name: 'end_date', orderable: false },
                { data: 'days', name: 'days', orderable: false },
                { data: 'left_days', name: 'left_days', orderable: false },
                { data: 'action', name: 'action', orderable: false }
            ],
            columnDefs: [
                { width: "4%", targets: 0 },  // First column
                { width: "16%", targets: 1 },   // Third column
                { width: "5%", targets: 2 },   // Third column 
                { width: "8%", targets: 4 },   
                { width: "10%", targets: 5 },   
                { width: "10%", targets: 6 },   
                { width: "8%", targets: 8 },   
                { width: "5%", targets: 7 },   
                { width: "5%", targets: 9 },   
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
                            <div class="dropdown no-arrow text-center">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center view-listing" 
                                    data-toggle="modal" data-target="#view-listing" data-id="`+row.id+`" href="#">
                                        <i class="fa fa-eye"></i> View Listing 
                                        
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

                    $("#escortPopupModalBodyIframe").attr('src', response.profileurl)
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