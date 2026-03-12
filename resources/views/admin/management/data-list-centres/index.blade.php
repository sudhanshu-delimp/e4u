@extends('layouts.admin')
@section('style')
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->{{-- Page Heading   --}}
        <div class="row">
            <div class="d-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Data List (Centres)</h1>
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
                            <li>Data Lists are compiled by the Territory.</li>
                            <li>When a Data List is uploaded, it is not automatically assigned to all Agents in their
                                respective Territories. The Data List via Action must be activated.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">
            <div class="col-md-12 d-flex align-items-center justify-content-end flex-wrap gap-10 my-3">
                <button  class="btn-success-modal" type="button" data-target="#upload_data_file" data-toggle="modal">Upload</button>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive-xl">
                    <table class="table mb-3" id="databaseCentreTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Date</th>
                                <th>Territory</th>
                                <th>Centres</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>23-02-2026</td>
                                <td>New South Wales</td>
                                <td>2,100</td>
                                <td> <span class="custom_badge badge_pending">Pending</span> </td>
                                <td>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" x-placement="bottom-end">

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#"> <i class="fa fa-check-circle"></i>
                                                Activate</a>
                                            <div class="dropdown-divider"></div>

                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#"> <i class="fa fa-ban"></i>
                                                Suspend</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" data-target="#view_data_summary" data-toggle="modal"> <i
                                                    class="fa fa-eye"></i>
                                                Summary</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                             <tr>

                                <td>23-02-2026</td>
                                <td>Victoria</td>
                                <td>1,100</td>
                                <td> <span class="custom_badge badge_suspended">Suspended</span> </td>
                               <td>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" x-placement="bottom-end">

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#"> <i class="fa fa-check-circle"></i>
                                                Activate</a>
                                            <div class="dropdown-divider"></div>

                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#"> <i class="fa fa-ban"></i>
                                                Suspend</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" data-target="#view_data_summary" data-toggle="modal"> <i
                                                    class="fa fa-eye"></i>
                                                Summary</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                             <tr>

                                <td>23-02-2026</td>
                                <td>Western Australia</td>
                                <td>600</td>
                                <td> <span class="custom_badge badge_active">Active</span> </td>
                                <td>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" x-placement="bottom-end">

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#"> <i class="fa fa-check-circle"></i>
                                                Activate</a>
                                            <div class="dropdown-divider"></div>

                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#"> <i class="fa fa-ban"></i>
                                                Suspend</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" data-target="#view_data_summary" data-toggle="modal"> <i
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


  @include('admin.modal.data-summary-modal')
  @include('admin.modal.upload-data-file')
@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        var table = $("#databaseCentreTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Territory."
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
                    data: 'date',
                    name: 'date',
                    searchable: true,
                    orderable: false,
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
                    orderable: false,
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
        document.getElementById("excelFile").addEventListener("change", function() {
            let fileName = this.files[0] ? this.files[0].name : "No file selected";
            document.getElementById("fileName").textContent = fileName;
        });
    </script>
@endpush
