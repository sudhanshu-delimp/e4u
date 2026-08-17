@extends(auth()->user()->type == 4 ? 'layouts.center' : 'layouts.escort')
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
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table w-100" id="productsHistoryTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Order ID</th>
                                <th>Created By</th>
                                <th>User</th>
                                {{-- <th>Sub Total</th>
                                <th>Wallet Amount</th>
                                <th>Shipping Charge</th>
                                <th>Tax</th> --}}
                                <th>Total</th>
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
        <div class="modal fade upload-modal" id="view-details" tabindex="-1" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content basic-modal">

                    <div class="modal-header">
                        <h5 class="modal-title" id="view-listing">

                            Order Details
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div id="orderDetailsLoader" class="text-center my-4" style="display:none;">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2">Loading details...</p>
                    </div>
                    <div class="modal-body" id="orderDetailsBody">



                    </div>


                </div>
            </div>
        </div>
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
                        url: "{{ auth()->user()->type == 4 ? route('center.order.list') : route('escort.order.list') }}",
                        type: 'GET'
                    },
                    columns: [{
                            data: 'order_id',
                            name: 'order_id'
                        },
                        {
                            data: 'agent',
                            name: 'agent'
                        },
                        {
                            data: 'user',
                            name: 'user'
                        },
                        {
                            data: 'total_amount',
                            name: 'total_amount'
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
            
            $(document).on('click', '.view-order-details', function(e) {
                e.preventDefault();
                var orderId = $(this).data('item');
                var productOrderId = $(this).data('orderid');
                $("#view-listing").text('Order Details - ' + productOrderId);
                // Show loader, hide content
                $("#orderDetailsLoader").show();
                $("#orderDetailsBody").hide().html("");

                $.ajax({
                    url: "{{ auth()->user()->type == 4 ? route('center.order.details') : route('escort.order.details') }}?id=" +
                        orderId,
                    type: "GET",
                    beforeSend: function() {
                        $("#view-details").modal("show"); // open modal immediately
                    },

                    success: function(response) {
                        $("#orderDetailsLoader").hide();

                        if (response.status === true) {
                            $("#orderDetailsBody").html(response.html).fadeIn();
                        } else {
                            $("#orderDetailsBody").html(
                                "<div class='alert alert-warning'>No details found.</div>"
                            ).fadeIn();
                        }
                    },

                    error: function() {
                        $("#orderDetailsLoader").hide();
                        $("#orderDetailsBody").html(
                                "<div class='alert alert-danger'>Unable to load order details.</div>")
                            .fadeIn();
                    }
                });
            });
        </script>
    @endpush
