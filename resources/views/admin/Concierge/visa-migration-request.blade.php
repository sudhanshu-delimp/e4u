@extends('layouts.admin')
 @section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
@section('content')
 
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Email Requests</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            style="font-size:16px"><b>Help?</b> </span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>An email request is to be actioned within 24 hours of receipt.</li>
                                    <li>An email notification has also been sent to <a href="mailto:admin@e4u.com.au"
                                            class="custom_links_design">admin@e4u.com.au</a>.</li>
                                    <li>When establishing the Email account, ensure:
                                        <ol class="level-2">
                                            <li>the Member and Email details are entered up in the Email Register before
                                                completing this page.</li>
                                            <li>Activate account.</li>
                                        </ol>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive custom-badge">
    <table id="visaMigrationRequestTable" class="table" style="width: 100%;">
                                <thead class="table-bg"> 
                                    <tr>
                                        <th>ID</th>
                                        <th class="text-nowrap">Business Name</th>
                                        <th class="text-nowrap">Contact Preference</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th class="text-nowrap">Passport Country</th>
                                        <th class="text-nowrap">Area Type</th>
                                        <th class="text-nowrap">Visa Enquiry Type</th>
                                        <th >Comments</th>
                                        <th class="text-nowrap">Created At</th>
                                        <th class="text-nowrap">Updated At</th>
                                    </tr>
                                </thead>

                                <tbody class="table-content">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


@endsection


@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    <script>
        $(document).ready(function() {

            $('#visaMigrationRequestTable').DataTable({

                processing: true,

                serverSide: true,

                responsive: false,

                scrollX: true,

                pageLength: 10,

                lengthMenu: [
                    [10, 25, 50, 75, 100],
                    [10, 25, 50, 75, 100]
                ],

                ajax: {
                    url: "{{ route('admin.visa.migration.lists') }}",
                    type: "GET"
                },

                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search visa migration requests...",
                    lengthMenu: "Show _MENU_ entries",
                    processing: "Loading..."
                },

                columns: [

                    {
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'business_name',
                        name: 'business_name'
                    },

                    {
                        data: 'contact_preference',
                        name: 'contact_preference'
                    },

                    {
                        data: 'email',
                        name: 'email'
                    },

                    {
                        data: 'mobile',
                        name: 'mobile'
                    },

                    {
                        data: 'passport_country',
                        name: 'passport_country'
                    },

                    {
                        data: 'area_type',
                        name: 'area_type'
                    },

                    {
                        data: 'visa_enquiry_type',
                        name: 'visa_enquiry_type'
                    },

                    {
                        data: 'comments',
                        name: 'comments'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    },

                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    }

                ],

                order: [
                    [0, 'desc']
                ]

            });

        });
    </script>
@endpush
