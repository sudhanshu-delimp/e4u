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

    <div class="modal fade upload-modal" id="viewReports" tabindex="-1" role="dialog" aria-labelledby="viewReportsLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">


                    <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/admin-report.png') }}"
                            class="custompopicon"> Payments Report Product - [Supplier name] (Period Ending 30-06-2025)
                    </h5>
                    <a href="" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="opr-close-btn">
                    </a>
                </div>

                <div class="modal-body">

                  
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn-cancel-modal">Print</button>
                    <button type="button" class="btn-success-modal" data-dismiss="modal">Approved</button>

                    {{-- <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    {{-- end --}}
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

        $(document).on('click', '.approve-report', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.report.details') }}",
                type: "GET",
                data: {
                    id: id
                },
                beforeSend: function() {
                    // loader
                },
                success: function(response) {
                    if (response.status) {
                        $('#viewReports .modal-body').html(response.html);
                        const modalElement = document.getElementById('viewReports');
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();

                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
@endpush
