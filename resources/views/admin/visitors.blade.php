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
        #visitorTable_paginate{
            display: flex;
            align-items: center;
            justify-content: space-between
        }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content-->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1"> Visitors</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        style="font-size:16px"><b>Help?</b> </span>
        </div>            
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol>
                        <li>All Visitors to the Website are displayed in this table. Users to the Website are displayed
                        under 'Logged in Users'.</li>
                        <li>You have no Action options for Visitors.</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
    <div class="row">    
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="my-3">                
                <div class="col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
                  
                    <div class="total_listing">
                        <div><span>Total Visitors : </span></div>
                        <div><span class="totalVisitors">56</span></div>
                    </div>
                </div>
            </div>
            <div class="visitor_table_class">
                <table class="table" id="visitorTable" style="width:100%;">
                    <thead class="table-bg">
                        <tr>
                            <th scope="col">
                            Date

                            </th>
                            <th scope="col">
                            Landed
                            </th>
                            <th scope="col">
                            Idle
                            </th>
                            <th scope="col">
                            Origin
                            </th>
                            <th scope="col">IP Address</th>
                            <th scope="col">Platform</th>
                            <th scope="col">Page</th>
                        </tr>
                    </thead>
                    <tbody class="table-content">
                        <tr class="row-color">
                            <td width="10%" class="theme-color">23-05-2025</td>
                            <td class="theme-color">10:26:37 am</td>
                            <td class="theme-color">10:25:25</td>
                            <td class="theme-color">Australia</td>
                            <td class="theme-color">123.176.113.164</td>
                            <td class="theme-color">Firefox</td>
                            <td class="theme-color">/all-escorts-list?city=7408</td>
                            
                        </tr>
                    </tbody>
                     <tr>
                            <th colspan="10" class="border-0"></th>
                        </tr>
                    <tfoot class="bg-first">
                        <tr>
                            <th colspan="2" class="text-left ">Server time: <span class="serverTime">10:23:51 am</span></th>
                            <th colspan="3" class="text-center">Refresh time:<span class="refreshSeconds"> 15</span></th>
                            <th colspan="2" class="text-right">Up time: <span class="uptimeClass">{{getAppUptime()}}</span></th>
                        </tr>
                    </tfoot>
                </table>
                {{-- <div class="timer_section">
                    <p>Server time: <span class="serverTime">10:23:51 am</span></p>
                    <p>Refresh time:<span class="refreshSeconds"> 15</span></p>
                    <p>Up time: <span class="uptimeClass">{{getAppUptime()}}</span></p>
                </div>
                <div class="customPaginationContainer mt-4 d-flex justify-content-between"></div>
                <nav aria-label="Page navigation example" class="customPagination">
                </nav> --}}
            </div>
        </div>
       
    </div>
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
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">M60178</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Member</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">Lins Massage</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Listing</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">Perth</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Profile Name</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">Perth 01</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Masseurs</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">4</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Listed Date</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">23-05-2025</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>De-listed Date</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">17-06-2025</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Days</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">14</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Days Left</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">15</td>
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

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>

    $(document).ready(function(e) {
        ajaxReload();
        let countdown = 15;
        setInterval(() => {
            countdown--;
            $(".refreshSeconds").text(' ' + countdown);

            if (countdown <= 0) {
                $('#visitorTable').DataTable().ajax.reload(null, false);
                countdown = 15;
            }

        }, 1000);

        $('#customSearch').on('keyup', function() {
            $('#visitorTable').DataTable().search(this.value).draw();
        });
    })
    

    function ajaxReload() {
        var visitorTable = $('#visitorTable').DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Date"
            },
            processing: true,
            serverSide: true,
            paging: true,
            lengthChange: true,
            info: true,
            searching: true,
            bStateSave: true,
            order: [[1, 'desc']],
            lengthMenu: [
                [10, 25, 50, 100], [10, 25, 50, 100]
            ],
            pageLength: 10,
            ajax: {
                url: "{{ route('admin.visitors-by-ajax') }}",
                type: "GET",
                dataSrc: function(json) {
                    var totalRows = json.recordsTotal || json.recordsFiltered;
                    $(".totalVisitors").text(totalRows);
                    $(".uptimeClass").text(json.serverTime.upTime);
                    $(".serverTime").text(json.serverTime.server_time);
                    return json.data;
                }
            },
            drawCallback: function(settings) {
                const $info = $('#visitorTable_info');
                const $paginate = $('#visitorTable_paginate');
                const $timerSection = $('.timer_section');
                const $customContainer = $('.customPaginationContainer');

                // if ($info.length && $paginate.length && $timerSection.length) {
                //     $info.appendTo($timerSection);
                //     $paginate.appendTo($timerSection);
                // }
                $(".dataTables_empty").text('There are currently no Visitors.')
            },

            columns: [
                { data: 'date', name: 'date' },
                { data: 'landed', name: 'landed' },
                { data: 'idle', name: 'idle' },
                { data: 'origin', name: 'origin' },
                { data: 'ip', name: 'ip', orderable: false  },
                { data: 'platform', name: 'platform', orderable: false  },
                { data: 'page', name: 'page', orderable: false  }
            ]
        });
    }
$(document).ready(function () {
            function checkAndApplyResponsive() {
                if ($(window).width() < 1500) {
                    if (!$('.visitor_table_class').hasClass('table-responsive')) {
                        $('.visitor_table_class').addClass('table-responsive');
                    }
                } else {
                    $('.visitor_table_class').removeClass('table-responsive');
                }
            }

            // Initial check
            checkAndApplyResponsive();

            // Recheck on window resize
            $(window).resize(function () {
                checkAndApplyResponsive();
            });
        });
// admin.visitors-by-ajax

 </script>
@endpush