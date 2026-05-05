@extends('layouts.escort')
@section('style')
    <style>
        .table td {
            vertical-align: middle;
        }

        .order_details table td {
            border: none;
            border-bottom: 1px solid #ccc;
        }

        .order_details table th {
            border: none;
            border-bottom: 1px solid #ccc;
            font-weight: 600;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 add-punterbox-report">
        <!--middle content start here-->

        {{-- Page Heading   --}}
        <div class="row">
            <div class="d-flex justify-content-between align-items-center flex-wrap col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Order History</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-1" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}

        <!--middle content-->
        <div class="row ">
            <div class="col-12 product-card-wrapper">
                <div class="table-responsive">
                    <table class="table w-100" id="productsHistoryTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Order ID</th>
                                <th>Tax</th>
                                <th>Delivery Charge</th>
                                <th>Sub Total</th>
                                <th>Total</th>
                                <th>Payment Method</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span> </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
        @include('escort.dashboard.Concierge.modal.view_order_history_modal')
    @endsection
    @push('script')
        <script>
            $(document).ready(function() {
                var table = $("#productsHistoryTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('escort.order.list') }}",
                        type: 'GET'
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
                            data: 'order_id',
                            name: 'order_id'
                        },


                        {
                            data: 'tax_amount',
                            name: 'tax_amount'
                        },
                        {
                            data: 'delivery_charges',
                            name: 'delivery_charges'
                        },
                        {
                            data: 'sub_total',
                            name: 'sub_total'
                        },
                        {
                            data: 'total_amount',
                            name: 'total_amount'
                        },
                        {
                            data: 'payment_method',
                            name: 'payment_method'
                        },
                        {
                            data: 'order_date',
                            name: 'order_date'
                        },
                        {
                            data: 'order_status',
                            name: 'order_status'
                        },
                        {
                            data: 'payment_status',
                            name: 'payment_status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        }
                    ]
                });
            });
        </script>
    @endpush
