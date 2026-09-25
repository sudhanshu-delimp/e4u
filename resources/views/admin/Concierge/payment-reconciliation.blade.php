@extends('layouts.admin')
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content-->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Payment Reconciliation</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>The following report sets out the sales for Concierge Services by type.</li>
                            <li>Select Approve from the Action list to review the results for the billing period. If the
                                reconciliation is correct, select the Approve button.</li>
                            <li>Once the reconciliation is approved, by selecting Email from the Action list, the report
                                is emailed to the Supplier.</li>
                            <li>Print report and process payment.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div id="table-sec" class="table-responsive-xl">
                            <table class="table" id="AgentReportTable">
                                <thead class="table-bg">
                                    <tr>
                                        <th>Date</th>
                                        <th>Billing Period</th>
                                        <th>Concierge</th>
                                        <th>Gross Sales</th>
                                        <th>Supplier</th>
                                        <th>Earnings</th>
                                        <th>Status</th>
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
    </div>

    {{-- end --}}

    {{-- this is common modal you can use same for all  View Report --}}

    <div class="modal fade upload-modal" id="viewReports" tabindex="-1" aria-labelledby="viewReportsLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">


                    <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/admin-report.png') }}"
                            class="custompopicon"> <span id="modal-title"></span>
                    </h5>
                    <a href="" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="opr-close-btn">
                    </a>
                </div>

                <div class="modal-body">


                </div>


                <div class="modal-footer">
                    <button type="button" class="btn-canc el-modal print-action"> Print </button>
                    <button type="button" class="btn btn-success confirm-approve-report">Approve</button>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    {{-- end --}}
    <!-- Supplier Details Modal -->
    <div class="modal fade upload-modal" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/admin-report.png') }}"
                            class="custompopicon"> <span id="modal-title"></span>
                    </h5>
                    <a href="" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="opr-close-btn">
                    </a>
                </div>

                <div class="modal-body">
                    <div class="row mb-2">
                        <strong class="col-sm-4">Name:</strong>
                        <span class="col-sm-8" id="supplier_name"></span>
                    </div>
                    <div class="row mb-2">
                        <strong class="col-sm-4">Address:</strong>
                        <span class="col-sm-8" id="supplier_address"></span>
                    </div>
                    <div class="row mb-2">
                        <strong class="col-sm-4 text-nowrap">Business Number:</strong>
                        <span class="col-sm-8" id="supplier_business_number"></span>
                    </div>
                    <div class="row mb-2">
                        <strong class="col-sm-4">Email:</strong>
                        <span class="col-sm-8" id="supplier_email"></span>
                    </div>
                    <div class="row mb-2">
                        <strong class="col-sm-4">ABN:</strong>
                        <span class="col-sm-8" id="supplier_abn"></span>
                    </div>
                    <div class="row mb-2">
                        <strong class="col-sm-4">Contact:</strong>
                        <span class="col-sm-8" id="supplier_contact"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <!-- opr_accordian_table JS -->
    <script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script>


    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    <script>
        document.querySelectorAll('.accordion-toggle').forEach(toggle => {
            toggle.addEventListener('click', () => {
                const target = toggle.getAttribute('data-target').replace('#', '');
                const openGroup = document.querySelectorAll(`.detail-row[data-group="${target}"]`);
                const isOpen = openGroup[0]?.classList.contains('show');

                // Close all open groups
                document.querySelectorAll('.detail-row.show').forEach(r => {
                    r.classList.remove('show');
                });

                // Open current group if not already open
                if (!isOpen) {
                    openGroup.forEach(r => r.classList.add('show'));
                }

                // Rotate arrow
                document.querySelectorAll('.accordion-toggle i').forEach(i => i.classList.remove(
                    'rotated'));
                if (!isOpen) toggle.querySelector('i').classList.add('rotated');
            });
        });

        var table = $("#AgentReportTable").DataTable({

            processing: true,
            serverSide: true,

            ajax: {
                url: "{{ route('admin.concierge-reports.index') }}",
                type: "GET"
            },

            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Order ID"
            },

            info: true,
            paging: true,
            lengthChange: true,
            searching: true,
            stateSave: true,

            order: [
                [0, 'desc']
            ],

            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],

            pageLength: 10,

            columns: @json($columns)
        });
        $(document).on('click', '.print-action', function(e) {
            e.preventDefault();

            let id = $("#report_id").val();
            let type = "pdf";

            let url = "{{ route('admin.report.details') }}?id=" + id + "&type=" + type;

            window.open(url, '_blank');
        });

        $(document).on('click', '.view-supplier', function(e) {
            e.preventDefault();

            let response = $(this).data('supplier');
            // Map fetched response data to modal elements
            $('#supplier_name').text(response.name || 'N/A');
            $('#supplier_address').text(response.business_address || 'N/A');
            $('#supplier_business_number').text(response.business_number || 'N/A');
            $('#supplier_email').text(response.email || 'N/A');
            $('#supplier_abn').text(response.abn || 'N/A');
            $('#supplier_contact').text(response.phone || 'N/A');


            const modalElement = document.getElementById('supplierModal');
            const modal = new bootstrap.Modal(modalElement, {
                backdrop: 'static',
                keyboard: false
            });
            modal.show();

        });
        $(document).on('click', '.report-action', function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let type = $(this).data('type');

            $.ajax({
                url: "{{ route('admin.report.details') }}",
                type: "GET",
                data: {
                    id: id,
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading Report...',
                        text: 'Please wait while we fetch and prepare your PDF report.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    if (response.status) {
                        // Close loading alert before showing modal
                        Swal.close();

                        $("#modal-title").text(response.period);
                        $('#viewReports .modal-body').html(response.html);

                        if (type == "view") {
                            $(".confirm-approve-report").addClass('d-none');
                        } else {
                            $(".confirm-approve-report").removeClass('d-none');
                        }

                        const modalElement = document.getElementById('viewReports');
                        const modal = new bootstrap.Modal(modalElement, {
                            backdrop: 'static',
                            keyboard: false
                        });
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Info!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Info!',
                        text: "Something went wrong. Please try again.",
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                complete: function() {
                    // Additional cleanup if needed
                }
            });
        });



        $(document).on('click', '.confirm-approve-report', function(e) {
            e.preventDefault();

            let id = $("#report_id").val();

            $.ajax({
                url: "{{ route('admin.report.approve') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },

                beforeSend: function() {
                    Swal.fire({
                        title: 'Approving Report...',
                        text: 'Please wait while we process the report approval.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },

                success: function(response) {
                    if (response.status) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Approved!',
                            text: response.message ||
                                'The report has been successfully approved.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message || 'Failed to approve the report.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },

                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message ||
                            "Something went wrong. Please try again.",
                        timer: 2000,
                        showConfirmButton: false
                    });
                },

                complete: function() {
                    // Swal.close();
                }
            });
        });


        $(document).on('click', '.send-supplier-pdf', function(e) {
            e.preventDefault();

            let id = $(this).data('id');

            // Show a loading spinner while the server processes and emails the PDF
            Swal.fire({
                title: 'Sending PDF Report...',
                text: 'Please wait while the PDF is generated and emailed to the supplier.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('admin.report.details') }}", // Update to your PDF sending route
                type: 'GET',
                data: {
                    id: id,
                    type: "send",
                },
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sent!',
                        text: response.message ||
                            'The PDF report has been successfully sent to the supplier.',
                        confirmButtonColor: '#3085d6'
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to Send',
                        text: xhr.responseJSON?.message ||
                            'Could not send the PDF report to the supplier.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33'
                    });
                }
            });
        });
    </script>
@endpush
