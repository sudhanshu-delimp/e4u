@extends('layouts.admin')
@section('style')
@stop
@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <!--middle content-->
            <div class="row">
                <div class="custom-heading-wrapper col-md-12">
                    <h1 class="h1">Notebox</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        style="font-size:16px"><b>Help?</b> </span>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card collapse" id="notes">
                        <div class="card-body">
                            <h3 class="NotesHeader"><b>Notes:</b> </h3>
                            <ol>
                                <li>Notebox Reports is a consolidation of reports made by Viewers (<b>Report</b>) on
                                    Advertisers. <u>No action is required by E4U</u>.
                                </li>
                                <li>At the discretion of the Managing Director, to action a Report which is being
                                    considered for removal, the Viewer’s consent must be obtained. Where a Report
                                    needs to be removed, or to the lesser extent amended, the Report can be amended
                                    and the amendment forwarded to the Viewer for approval (Support Ticket). <u>The
                                        Member can not be contacted by phone</u>.
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-sm-12 d-flex justify-content-end" style="gap: 50px;">

                    <div class="total_listing">
                        <div><span>Total Noteboxes: </span></div>
                        <div><span>01</span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table" id="noteboxReportTable" width="100%">
                            <thead class="table-bg">
                                <tr>
                                    <th>Ref</th>
                                    <th>Viewer ID</th>
                                    <th>Home State</th>
                                    <th>Mobile</th>
                                    <th>Advertiser ID</th>
                                    <th>Home State</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>123</td>
                                    <td>V400161</td>
                                    <td>Qld</td>
                                    <td>1438 028 733</td>
                                    <td>E400145</td>
                                    <td>Qld</td>
                                    <td>28-12-2025</td>
                                    <td><span class="custom_badge badge_active">Completed</span></td>
                                    <td class=" text-center">
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                    href="javascript:void(0)" data-id="12">
                                                    <i class="fa fa-check "></i> Active</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center view-feedback-btn"
                                                    href="javascript:void(0)"> <i class="fa fa-eye"></i> Withdrawn</a>

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center view-feedback-btn"
                                                    href="javascript:void(0)"> <i class="fa fa-eye"></i> Pending</a>

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center view-feedback-btn"
                                                    data-target="#viewMemberdetails" data-toggle="modal"
                                                    href="javascript:void(0)"> <i class="fa fa-eye"></i> View</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>



<div class="modal fade upload-modal" id="viewMemberdetails" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationPopup">
                    <svg fill="#ff3c5f" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" width="24px" height="24px">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <g>
                                    <rect x="61.566" y="88.707" width="265.623" height="30.417"></rect>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <rect x="151.579" y="139.402" width="175.619" height="30.417"></rect>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <rect x="61.566" y="139.402" width="59.593" height="30.417"></rect>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <rect x="61.566" y="190.097" width="265.623" height="30.417"></rect>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M501.715,106.196c-13.703-13.703-35.998-13.702-49.699,0l-63.27,63.27V0H0.008v512h388.738V268.862l112.968-112.968 C515.417,142.193,515.417,119.897,501.715,106.196z M30.426,481.583V30.417H358.33v169.466l-40.908,40.908H61.566v30.417h225.439 l-51.692,51.692v19.281H61.566v30.417h173.747h15.209h34.49l73.319-73.319v182.302H30.426z M388.748,225.847L388.748,225.847 L272.412,342.182h-6.683V335.5l123.017-123.017l45.657-45.657l6.683,6.683L388.748,225.847z M480.207,134.386L462.594,152 l-6.683-6.683l17.614-17.614c1.84-1.84,4.839-1.842,6.683,0C482.049,129.547,482.049,132.544,480.207,134.386z"></path>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <rect x="61.566" y="291.488" width="151.863" height="30.417"></rect>
                                </g>
                            </g>
                        </g>
                    </svg>
                    View Summary
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Details Table -->
                        <table class="table table-bordered mb-3">
                            <tbody>
                                <tr>
                                    <th><b>Name</b></th>
                                    <td>jayde</td>
                                </tr>
                                <tr>
                                    <th><b>Viewer ID</b></th>
                                    <td>V400161</td>
                                </tr>
                                <tr>
                                    <th><b>Home State</b></th>
                                    <td>Qld</td>
                                </tr>
                                <tr>
                                    <th><b>Mobile</b></th>
                                    <td>1438 028 822</td>
                                </tr>
                                <tr>
                                    <th><b>Advertiser ID</b></th>
                                    <td>E400145</td>
                                </tr>
                                <tr>
                                    <th><b>Home State</b></th>
                                    <td>Qld</td>
                                </tr>
                                <tr>
                                    <th><b>Status</b></th>
                                    <td class="border-0">Active </td>
                                </tr>

                                <tr>
                                    <th><b>Created</b></th>
                                    <td>18-05-2026</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mb-2">
                            <button type="button" class="btn-success-modal ml-2" data-dismiss="modal"
                                aria-label="Close">Print</button>
                            <button type="button" class="btn-cancel-modal ml-2" data-dismiss="modal"
                                aria-label="Close">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end -->
@endsection
@push('script')

<script>
    var table = $("#noteboxReportTable").DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Viewer ID"
        },
        info: true,
        paging: true,
        lengthChange: true,
        searching: true,
        bStateSave: true,
        order: [
            [1, 'desc']
        ],
        pageLength: `{{$datatable_entries}}`,
        lengthMenu: `{{config('app.paginate_range')}}`.split(','),

        columns: [{
                data: 'Ref',
                name: 'Ref',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'viewer_id',
                name: 'viewer_id',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'home_state',
                name: 'home_state',
                searchable: true,
                orderable: false,
                defaultContent: 'NA'
            },
            {
                data: 'mobile',
                name: 'mobile',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'adv_id',
                name: 'adv_id',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'adv_home_state',
                name: 'adv_home_state',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'created',
                name: 'created',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'status',
                name: 'status',
                searchable: false,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'action',
                name: 'edit',
                searchable: false,
                orderable: false,
                defaultContent: 'NA',
                class: 'text-center'
            },
        ],
    });
</script>
@endpush