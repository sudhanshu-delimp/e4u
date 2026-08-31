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
                        <h1 class="h1">Visa Requests</h1>
                        <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true">Help?</span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes" style="">
                            <div class="card-body">
                               <h3 class="NotesHeader"><b>Notes:</b></h3>
                                <ol>
                                    <li>A Visa request (<b>Request</b>) is forwarded to PEAMS Australia Pty Ltd (<b>PEAMS</b>) for actioning. <u> We do not action the Request.</u></li>
                                    <li>Check the status of the Request within 48 hours that the Request is being actioned by PEAMS.</li>
                                    <li>Update the status of the Request as it progresses through each stage.</li>
                                    
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
                                        <th>Ref</th>
                                        <th>Member Id</th>
                                        <th>Name</th>
                                        <th>Order Date</th>
                                        <th>Visa Type</th>
                                        <th>Origin</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody class="table-content">

                                </tbody>
                                <tr>
                                    <th colspan="8" class="border-0"></th>
                                </tr>
                                <tfoot class="bg-first t-foot mt-4">
                                    <tr>
                                        <th colspan="3" class="text-left border-0">Server time: <span
                                                class="serverTime">{{ date('d-m-Y h:i a') }}</span></th>
                                        <th colspan="3" class="text-center border-0">Refresh time:<span
                                                class="refreshSeconds"> 15</span></th>
                                        <th colspan="2" class="text-right border-0" style="text-align: right!important;">
                                            Up time: <span class="uptimeClass">{{ getAppUptime() }}</span></th>
                                    </tr>
                                </tfoot>
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
            let countdown = 1;
            setInterval(() => {
                countdown--;
                $(".refreshSeconds").text(' ' + countdown);

                if (countdown <= 0) {
                    $('#visaMigrationRequestTable').DataTable().ajax.reload(null, false);
                    countdown = 15;

                }

            }, 1000);



            $('#visaMigrationRequestTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: paginateLength,
                lengthMenu: paginateRange,
                ajax: {
                    url: "{{ route('admin.visa.migration.lists') }}",
                    type: "GET"
                },
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search member id, visa and origin migration requests...",
                    lengthMenu: "Show _MENU_ entries",
                    processing: "Loading..."
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'member_id',
                        name: 'member_id',

                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'order_date',
                        name: 'order_date',
                       
                    },
                    {
                        data: 'area_type',
                        name: 'area_type',
                    },
                    {
                        data: 'passport_country',
                        name: 'passport_country',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ],
                ordering: false
                

            });

        });
        $(document).on('click', '.js-status', function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let status = $(this).data('status');

            let statusText = status
                .replace('_', ' ')
                .replace(/\b\w/g, function(letter) {
                    return letter.toUpperCase();
                });

            Swal.fire({
                title: 'Update Status',
                html: 'Are you sure you want to change the status to <strong>' + statusText + '</strong>?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.visa.migration.update.status') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                            status: status
                        },

                        beforeSend: function() {
                            Swal.fire({
                                title: 'Updating...',
                                text: 'Please wait.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                        },

                        success: function(response) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            $('#visaMigrationRequestTable')
                                .DataTable()
                                .ajax.reload(null, false);
                        },

                        error: function(xhr) {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseJSON?.message ||
                                    'Something went wrong while updating the status.'
                            });
                        }
                    });
                }
            });
        });
         
    </script>
@endpush
