@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <style>
        .report-table {
            border: 0px;
            border-collapse: collapse;
            border-radius: 5px !important;
            padding: 25px;
        }

        .report-table th,
        .report-table td {
            border: none !important;
        }

        .report-table th {
            font-weight: bold;
        }

        .custom-height {
            height: 40px !important;
        }

        #mergeList .table .inner_details strong {
            width: 110px;
        }

        #mergeList table td {
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->{{-- Page Heading   --}}
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Saved Reports</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>Reports generated from <a href="{{ route('agent.marketing.prospect.list') }}"
                                    class="custom_links_design">Prospects List</a> are saved here.</li>
                            <li>Use these Lists to:
                                <ol>
                                    <li>merge into any of the marketing material provided.</li>
                                    <li>print as a working sheet.</li>
                                    <li>work from your computer screen.</li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}

        <!-- Trigger Button -->

        <!-- Main DataTable (Your Reports Table) -->
        <div class="table-responsive-xl">
            <table class="table mb-3" id="save_report_table">
                <thead class="table-bg">
                    <tr>
                        <th>ID</th>
                        <th>Date Generated</th>
                        <th>Post Code</th>
                        <th>Listings</th>
                        <th>Merged</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>
                        <td>123</td>
                        <td>01-01-2025</td>
                        <td>6152</td>
                        <td>15</td>
                        <td>No </td>
                        <td>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink" x-placement="bottom-end">


                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                        href="#" data-target="#mergeType" data-toggle="modal"> <i
                                            class="fa fa-bezier-curve"></i>
                                        Merge</a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                        href="{{ route('printreport') }}" target="_blank"> <i class="fa fa-print"></i>
                                        Print</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                        href="#" data-target="#view_list" data-toggle="modal"> <i
                                            class="fa fa-eye"></i>
                                        View</a>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>105</td>
                        <td>15-12-2024</td>
                        <td>6000 - 6004</td>
                        <td>35</td>
                        <td>Yes </td>
                        <td>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink" x-placement="bottom-end">


                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                        href="#" data-target="#mergeType" data-toggle="modal"> <i
                                            class="fa fa-bezier-curve"></i>
                                        Merge</a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                        href="{{ route('printreport') }}" target="_blank"> <i class="fa fa-print"></i>
                                        Print</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                        href="#" data-target="#view_list" data-toggle="modal"> <i
                                            class="fa fa-eye"></i>
                                        View</a>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>101</td>
                        <td>01-01-2025</td>
                        <td>All</td>
                        <td>568</td>
                        <td>No</td>
                        <td>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink" x-placement="bottom-end">


                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                        href="#" data-target="#mergeType" data-toggle="modal"> <i
                                            class="fa fa-bezier-curve"></i>
                                        Merge</a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                        href="{{ route('printreport') }}" target="_blank"> <i class="fa fa-print"></i>
                                        Print</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                        href="#" data-target="#view_list" data-toggle="modal"> <i
                                            class="fa fa-eye"></i>
                                        View</a>

                                </div>
                            </div>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>

        {{-- <button type="button" data-target="#mergeList" data-toggle="modal">Go to Hell</button> --}}
    </div>

    @include('agent.dashboard.marketing.modal.merge-type-modal')
    @include('agent.dashboard.marketing.modal.view-list-modal')



    <div id="manage-route" data-csrf-token="{{ csrf_token() }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-save-report-list="{{ route('agent.marketing.save.report.list') }}"
      
        ></div>
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script src="{{ asset('agent/dashboard/marketing/save-report/save-reports.js') }}"></script>

@endpush
