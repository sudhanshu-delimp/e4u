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


#cke_1_contents {
    height: 150px !important;
}
#listings_paginate span{
display: contents;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content-->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">            
            <h1 class="h1"> Logged in Users</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    style="font-size:16px"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol>
                        <li>All logged in Users are displayed in this table. Visitors to the Website are displayed under ‘Visitors’.</li>
                        <li>You have limited Action access according to your security level.</li>
                        <li>Legend:</li>
                        <p>E: Escort  &nbsp;&nbsp;M: Massage Centre  &nbsp;&nbsp;A: Agent  &nbsp;&nbsp;V: Viewer  &nbsp;&nbsp;S: Staff.  &nbsp;&nbsp;</p>
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
            <div class="logged_in_table_class">
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
                                Ip Adrress
                            </th>
                            <th scope="col">
                                Platform
                            </th>
                            <th scope="col">Page</th>
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
                language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Member ID or Name"
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
                url: "{{ route('admin.get-logged-in-users-by-ajax') }}",
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
                { data: 'ip_adress', name: 'ip_adress' },
                { data: 'platform', name: 'platform' },
                { data: 'page', name: 'page' },
                { data: 'action', name: 'action', orderable: false }
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