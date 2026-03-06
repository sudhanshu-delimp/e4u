@extends('layouts.agent')
@section('style')
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->{{-- Page Heading   --}}
        <div class="row">
            <div class="d-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Database (Centres)</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        aria-expanded="true"><b>Help?</b></span>
                </div>
                @if (request('from') == 'dashboard')
                    <div class="back-to-dashboard">
                        <a href="{{ route('agent.dashboard') }}">
                            <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>The Database lists all Massage Centres within your Territory. From time to time, the
                                database is updated, usually with a new file. Previous files will remain in the list as
                                historical</li>
                            <li>You can create a working report by undertaking a search, via the <a
                                    href="{{ route('marketing.agencreate-prospect') }}"
                                    class="custom_links_design">Prospects List</a> page:</li>
                            <ol class="level-2">
                                <li>according to your preference; and</li>
                                <li>to group Massage Centres according to the post code.</li>
                            </ol>
                            <li>You can download the Data file to be viewed in Excel. The Date file can not be edited.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">
            <div class="col-md-12 d-flex align-items-center justify-content-end flex-wrap gap-10 my-3">
                <div class="total_listing">
                    <div><span>Active Post Codes : </span></div>
                    <div><span class="totalInprogressTask">12</span></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive-xl">
                    <table class="table mb-3" id="databaseCentreTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Upload</th>
                                <th>Territory</th>
                                <th>Centres</th>
                                <th>Mobile</th>
                                <th>Landline</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>27-02-2026</td>
                                <td>Western Australia</td>
                                <td>625</td>
                                <td>450</td>
                                <td>225</td>
                                <td> <span class="custom_badge badge_active">Active</span> </td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" x-placement="bottom-end">

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" download="data_file.xlsx"> <i class="fa fa-download"></i>
                                                Download</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" data-target="#view_data_center" data-toggle="modal"> <i
                                                    class="fa fa-eye"></i>
                                                Summary</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                             <tr>

                                <td>30-01-2026</td>
                                <td>Western Australia</td>
                                <td>620</td>
                                <td>421</td>
                                <td>219</td>
                                <td> <span class="custom_badge badge_deactivated">Deactivated</span> </td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" x-placement="bottom-end">

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" download="data_file.xlsx"> <i class="fa fa-download"></i>
                                                Download</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" data-target="#view_data_center" data-toggle="modal"> <i
                                                    class="fa fa-eye"></i>
                                                Summary</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                             <tr>

                                <td>27-02-2026</td>
                                <td>Western Australia</td>
                                <td>589</td>
                                <td>390</td>
                                <td>239</td>
                                <td> <span class="custom_badge badge_inactive">Inactive</span> </td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" x-placement="bottom-end">

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" download="data_file.xlsx"> <i class="fa fa-download"></i>
                                                Download</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" data-target="#view_data_center" data-toggle="modal"> <i
                                                    class="fa fa-eye"></i>
                                                Summary</a>

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


  @include('agent.dashboard.modal.data-summary-modal')
@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        var table = $("#databaseCentreTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Territory"
            },
            info: true,
            paging: true,
            lengthChange: true,
            searching: true,
            bStateSave: true,
            order: [
                [1, 'desc']
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10,

            columns: [{
                    data: 'upload',
                    name: 'upload',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'territory',
                    name: 'territory',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'centres',
                    name: 'centres',
                    searchable: true,
                    orderable: true,
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
                    data: 'landline',
                    name: 'landline',
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
