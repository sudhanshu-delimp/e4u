@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
    <style>
        .small-muted {
            font-size: 12px;
            color: #6c757d;
        }

        .card {
            box-shadow: 0 2px 6px rgba(0, 0, 0, .06);
        }
    </style>
@endsection 
    
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        {{-- Page Heading --}}
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Prospect Lists (Centres)</h1>
                    <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b>
                    </h6>
                </div>
                @if (request('from') !== 'sidebar')
                <div class="back-to-dashboard">
                    <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                        <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                    </a>
                </div>
                @endif
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b></p>
                        <ol>
                            <li>The E4U data list (<b>Data</b>) includes all known Massage Centres located in your
                                Territory. From time to time the Data will be updated. You will be notified when the Data is
                                updated.</li>
                            <li>Use the search feature to create your prospect list (<b>List</b>). Once you have created the
                                List, you can then apply the List in the following manner:
                                <ol class="level-2">
                                    <li>merging the List into any of the marketing material provided.</li>
                                    <li>printing the List as a working sheet.</li>
                                    <li>working from the List via your computer screen.</li>
                                </ol>
                            </li>
                            <li>A Massage Centre who becomes a Member will remain in the List.</li>
                            <li>You can access your Lists anytime from the Report List.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                {{-- Generate List Section --}}
                <div class="gen-prospect-list">
                    <h2 class="section-title">Generate List</h2>
                    <h3 class="section-title">Filter Types</h3>

                    <form id="generateForm">
                        <div class="form-group d-flex align-items-center gap-20 flex-wrap">
                            <label class="mb-0">Post Code</label>
                            <div class="radio-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="postcodeType" value="single"
                                        checked>
                                    <label class="form-check-label">Single</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="postcodeType" value="multiple">
                                    <label class="form-check-label">Multiple</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="postcodeType" value="all">
                                    <label class="form-check-label">All</label>
                                </div>
                            </div>

                        </div>

                        <div class="form-group w-50" id="singlePostCodeField">
                            <label>Enter Post Code</label>
                            <input type="text" id="singlePostCode" class="form-control" placeholder="e.g. 6000">
                        </div>

                        <div class="form-group d-none w-50" id="multiplePostCodeFields">
                            <label>Enter Post Code Range</label>
                            <div class="d-flex gap-2">
                                <input type="text" id="fromPostCode" class="form-control mr-2" placeholder="From">
                                <input type="text" id="toPostCode" class="form-control" placeholder="To">
                            </div>
                        </div>

                        <h3>Options</h3>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-group d-flex align-items-center gap-20 flex-wrap">
                                <label class="mb-0">Trial Run Only</label>
                                <div class="radio-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="trialRun" value="on">
                                        <label class="form-check-label">On</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="trialRun" value="off"
                                            checked>
                                        <label class="form-check-label">Off</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex gap-20">
                                <button type="button" id="showRecipients" class="btn-common mr-0" disabled>Show
                                    Recipients</button>
                                <button type="button" id="proceedBtn" class="btn-common mr-0">Proceed</button>
                            </div>

                        </div>
                    </form>
                </div>

                {{-- Preview List --}}
                <div class="prospect-list-table d-none" id="previewCard">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2>Preview Recipients</h2>
                        <button class="btn-cancel-modal mr-0" id="closePreview">Close</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="previewTable">
                            <thead class="bg-first">
                                <tr>
                                    <th>ID</th>
                                    <th>Business Name</th>
                                    <th>Address</th>
                                    <th>Post Code</th>
                                    <th>Mobile</th>
                                    <th>Business No.</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                {{-- Reports Table --}}
                <div class="prospect-list-table">
                    <h2>Generated Report List</h2>
                    <div class="table-responsive">
                        <table class="table" id="reportsTable">
                            <thead class="bg-first">
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Post Code</th>
                                    <th>Listings</th>
                                    <th>Merged</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- modal  --}}
    {{-- merge modal --}}
    <div class="modal fade upload-modal show" id="mergeType" tabindex="-1" role="dialog"
        aria-labelledby="mergeTypelabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/merge.png') }}" class="custompopicon">
                        <span class="text-white">Merge Type</span>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <h4 class="my-2">Select the Marketing Information document to merge with:</h4>
                    <form method="POST">
                        <div class="row my-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-center gap-20">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mergeType"
                                                id="single" checked>
                                            <label class="form-check-label" for="single">Massage Centre (single)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mergeType"
                                                id="multiple" value="massage">
                                            <label class="form-check-label" for="multiple">Massage Centre
                                                (Multiple)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group text-center">
                                    <button type="submit" class="btn-success-modal" id="save_button">Merge</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    {{-- View Modal --}}
    <div class="modal fade upload-modal bd-example-modal-lg" id="view_list" tabindex="-1" role="dialog"
        aria-labelledby="view_listLabel" aria-hidden="true">
        <div class="modal-dialog print-list-modal modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view_list"><img
                            src="{{ asset('assets/dashboard/img/profile-report.png') }}" class="custompopicon">View Report
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive profile_summary">
                        <table cellpadding="8" cellspacing="0" width="100%"
                            style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">

                            <thead class="bg-first">
                                <!-- Table Headings -->
                                <tr>
                                    <td>ID</td>
                                    <td>Business Name</td>
                                    <td>Address</td>
                                    <td>Post Code</td>
                                    <td>Mobile Number</td>
                                    <td>Business Number</td>
                                    <td>Email</td>
                                    <td>Website</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>369</td>
                                    <td>Body Heat Massage</td>
                                    <td>62 Gordon Rd East Osborne Park</td>
                                    <td>6000</td>
                                    <td>0456 665 012</td>
                                    <td>9236 2587</td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>256</td>
                                    <td>Healthland</td>
                                    <td>510 Murray St Perth</td>
                                    <td>6000</td>
                                    <td>0426 610 881</td>
                                    <td>9325 2011</td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>147</td>
                                    <td>Esquire Spa and Massage</td>
                                    <td>11 Aberdeen St Perth</td>
                                    <td>6000</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                            </tbody>

                        </table>
                    </div>

                    <div class="modal-footer justify-content-center mt-3">
                        <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close"
                            id="close_change">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
@endsection

@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {
            // Init DataTable
            var table = $("#previewTable").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by ID or Post Code"
                },
                processing: false,
                serverSide: false,
                paging: true,
                lengthChange: true,
                searching: true,
                bStateSave: true,
                ordering: false,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10,
            columns: [
            { data: 'id', name: 'id', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'date_generated', name: 'date_generated', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'post_code', name: 'post_code', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'listings', name: 'listings', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'merged', name: 'merged', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
            ],
            });

            var table = $("#reportsTable").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by ID or Post Code"
                },
                processing: false,
                serverSide: false,
                paging: true,
                lengthChange: true,
                searching: true,
                bStateSave: true,
                ordering: false,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10,
            columns: [
            { data: 'id', name: 'id', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'date_generated', name: 'date_generated', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'post_code', name: 'post_code', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'listings', name: 'listings', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'merged', name: 'merged', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'bussiness_no', name: 'bussiness_no', searchable: false, orderable:false, defaultContent: 'NA',},
            ],
            });
        });
    </script>

    <script>
        $(function() {
            const SAMPLE = [{
                    id: 1,
                    name: 'Body Heat Massage',
                    address: '62 Gordon Rd East Osborne Park',
                    postcode: '6000',
                    mobile: '0456 665 012',
                    business: '9236 2587'
                },
                {
                    id: 2,
                    name: 'Healthland',
                    address: '510 Murray St Perth',
                    postcode: '6001',
                    mobile: '0426 610 881',
                    business: ''
                },
                {
                    id: 3,
                    name: 'Esquire Spa',
                    address: '11 Aberdeen St Perth',
                    postcode: '6002',
                    mobile: '',
                    business: '9325 2011'
                },
            ];

            let reports = [];

            function renderReports() {
                let tbody = $('#reportsTable tbody').empty();
                reports.forEach(rep => {
                    tbody.append(`<tr>
                    <td>${rep.id}</td>
                    <td>${rep.date}</td>
                    <td>${rep.postcode}</td>
                    <td>${rep.listings.length}</td>
                    <td>${rep.merged ? 'Yes' : 'No'}</td>
                    <td>
                          <div class="dropdown no-arrow">
                              <a class="dropdown-toggle" href="#" role="button"
                                  id="dropdownMenuLink" data-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="true">
                                  <i
                                      class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                              </a>
                              <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                  aria-labelledby="dropdownMenuLink"
                                  x-placement="bottom-end">
                                  
                                  <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                      href="#" data-target="#mergeType" data-toggle="modal"> <i class="fa fa-bezier-curve"></i>
                                      Merge</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                      href="{{ route('printreport') }}" target="_blank"> <i class="fa fa-print"></i>
                                      Print</a>
                                        <div class="dropdown-divider"></div>
                                  <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                      href="#" data-target="#view_list" data-toggle="modal"> <i class="fa fa-eye"></i>
                                      View</a>

                              </div>
                          </div>
                      </td>
                  </tr>`);
                });
            }

            function filterData(type, single, from, to) {
                if (type === 'all') return SAMPLE;
                if (type === 'single') return SAMPLE.filter(s => s.postcode === single);
                const f = parseInt(from),
                    t = parseInt(to);
                return SAMPLE.filter(s => parseInt(s.postcode) >= f && parseInt(s.postcode) <= t);
            }

            // Postcode Type Toggle
            $('input[name="postcodeType"]').change(function() {
                const val = $(this).val();
                $('#singlePostCodeField').toggleClass('d-none', val !== 'single');
                $('#multiplePostCodeFields').toggleClass('d-none', val !== 'multiple');
            });

            // Trial Run Toggle
            $('input[name="trialRun"]').change(function() {
                const val = $('input[name="trialRun"]:checked').val();
                $('#showRecipients').prop('disabled', val !== 'on');
            });

            // Show Recipients
            $('#showRecipients').click(function() {
                const type = $('input[name="postcodeType"]:checked').val();
                const data = filterData(type, $('#singlePostCode').val(), $('#fromPostCode').val(), $(
                    '#toPostCode').val());
                let tbody = $('#previewTable tbody').empty();
                data.forEach(d => {
                    tbody.append(`<tr>
        <td>${d.id}</td>
        <td>${d.name}</td><td>${d.address}</td><td>${d.postcode}</td><td>${d.mobile}</td><td>${d.business}</td>
      </tr>`);
                });
                $('#previewCard').removeClass('d-none');
            });

            // Proceed
            $('#proceedBtn').click(function() {
                const type = $('input[name="postcodeType"]:checked').val();
                const data = filterData(type, $('#singlePostCode').val(), $('#fromPostCode').val(), $(
                    '#toPostCode').val());
                const report = {
                    id: Math.floor(Math.random() * 1000),
                    date: new Date().toLocaleDateString(),
                    postcode: type,
                    listings: data,
                    merged: false
                };
                reports.unshift(report);
                renderReports();
                // alert('List generated and stored.');
            });

            // Close preview
            $('#closePreview').click(() => $('#previewCard').addClass('d-none'));
        });
    </script>
@endpush
