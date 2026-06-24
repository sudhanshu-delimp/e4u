@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .swal-button {
            background-color: #242a2c;
        }
    </style>
@stop
@section('content')
    @php
        $securityLevel = isset(auth()->user()->staff_detail->security_level)
            ? auth()->user()->staff_detail->security_level
            : 0;
        $editAccess = staffPageAccessPermission($securityLevel, 'edit');
        $editAccessEnabled = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
    @endphp
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Product Orders</h1>
                        <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true">Help?</span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes" style="">
                            <div class="card-body">
                                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                <ol>
                                    <li>A product order is outsourced to our supplier.</li>
                                    <li>An email setting out the Product order has also been sent to <a
                                            href="mailto:admin@e4u.com.au" class="custom_links_design">admin@e4u.com.au</a>.
                                    </li>
                                    <li>Follow up the Supplier after 48 hours to confirm the order has been completed.
                                        Update status to Completed.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end --}}

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="table-responsive custom-badge">
                            <table class="table w-100" id="productsHistoryTable">
                                <thead class="table-bg">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Created By</th>
                                        <th>User</th>
                                        <th>Sub Total</th>
                                        <th>Wallet Amount</th>
                                        <th>Shipping Charge</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                        <th>Order Date</th>
                                        <th>Order Status</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tr>
                                    <th colspan="13" class="border-0"></th>
                                </tr>
                                <tfoot class="bg-first t-foot">
                                    <tr>
                                        <th colspan="5" class="text-left border-0">Server time: <span
                                                class="serverTime">{{ date('d-m-Y h:i a') }}</span></th>
                                        <th colspan="4" class="text-center border-0">Refresh time:<span
                                                class="refreshSeconds"> 15</span></th>
                                        <th colspan="4" class="text-right border-0" style="text-align: right!important;">
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
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span> </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <div class="modal fade upload-modal" id="active_req" tabindex="-1" aria-labelledby="active_reqLabel" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="active_req"><img
                            src="{{ asset('assets/dashboard/img/order-tracking.png') }}" alt="alert"
                            class="custompopicon"> Tracking Details
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <form id="orderStatusChange">
                        <div class="row">
                            <input type="hidden" id="order_id">
                            <input type="hidden" id="order_status">
                            <div class="col-12 mb-3">
                                <label for="Traking ID">Tracking ID</label>
                                <input type="text" class="form-control rounded-0" id="tracking_id"
                                    placeholder="Enter Tracking id ">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-success-modal" id="saveCompletedOrder">save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
    {{-- confirm_popup --}}
    <div class="modal fade upload-modal" id="confirm_popup" tabindex="-1" aria-labelledby="confirm_popupLabel"
        aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm_popup"><img src="{{ asset('assets/dashboard/img/unblock.png') }}"
                            alt="alert" class="custompopicon"> Completed
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <h5 class="popu_heading_style my-4" style="text-align: center;">
                        The order has been completed.
                    </h5>
                </div>
                <div class="modal-footer pb-4 mb-2 justify-content-center">
                    <button type="button" class="btn-success-modal" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    <div class="modal fade upload-modal" id="view-details" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content basic-modal">

                <div class="modal-header">
                    <h5 class="modal-title" id="view-listing">
                        Order Details
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="https://e4u.local/assets/app/img/newcross.png"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">

                    <div id="orderDetailsLoader" class="text-center my-4" style="display:none;">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2">Loading details...</p>
                    </div>

                    <div id="orderDetailsBody"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('escort.dashboard.Concierge.modal.view_order_history_modal')

@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {

            let countdown = 1;
            setInterval(() => {
                countdown--;
                $(".refreshSeconds").text(' ' + countdown);

                if (countdown <= 0) {
                    $('#productsHistoryTable').DataTable().ajax.reload(null, false);
                    countdown = 15;

                }

            }, 1000);

            $('#customSearch').on('keyup', function() {
                $('#productsHistoryTable').DataTable().search(this.value).draw();
            });

            var table = $("#productsHistoryTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.escort.orders.list') }}",
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
                        data: 'agent',
                        name: 'agent'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'sub_total',
                        name: 'sub_total'
                    },
                    {
                        data: 'wallet_amount',
                        name: 'wallet_amount'
                    },
                    {
                        data: 'delivery_charges',
                        name: 'delivery_charges'
                    },
                    {
                        data: 'gst_amount',
                        name: 'gst_amount'
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

            table.on('xhr.dt', function(e, settings, json) {
                if (json) {
                    $('.serverTime').text(json.server_time);
                    $('.uptimeClass').html(json.server_up_time);
                }
            });


            $(document).on('click', '.open-status-modal', function(e) {
                let orderId = $(this).data('id');
                let status = $(this).data('status');
alert(orderId);
                $('#order_id').val(orderId);
                $('#order_status').val(status);

                // Completed => open modal
                if (status === 'delivered')
                    return;


                // Pending / Hold => direct AJAX
                e.preventDefault();

                updateOrderStatus(orderId, status, '');
            });

            // $(document).on('click', '#saveCompletedOrder', function() {

            //     let $btn = $(this);

            //     $btn.prop('disabled', true);

            //     let orderId = $('#order_id').val();
            //     let trackingId = $('#tracking_id').val();

            //     $.ajax({
            //         url: "{{ route('admin.escort.order.complete') }}",
            //         type: 'POST',
            //         data: {
            //             _token: $('meta[name="csrf-token"]').attr('content'),
            //             order_id: orderId,
            //             tracking_id: trackingId,
            //             status: 'delivered'
            //         },
            //         success: function(response) {

            //             if (response.status == false) {
            //                 toastr.error(response.message);
            //             } else {
            //                 $('#active_req').modal('hide');
            //                 toastr.success('Order marked as completed');
            //                 table.ajax.reload();
            //             }

            //         },
            //         error: function(xhr) {

            //             toastr.error(xhr.responseJSON?.message || 'Something went wrong');

            //         },
            //         complete: function() {

            //             $btn.prop('disabled', false).text('Save');

            //         }
            //     });

            // });
        


        });

    $(document).on('click', '#saveCompletedOrder', function() {

                const $btn = $(this);
                $btn.prop('disabled', true).text("please wait...");

                let orderId = $('#order_id').val();
                let status = $('#order_status').val();
                let trackingId = $('#tracking_id').val();

                updateOrderStatus(orderId, status, trackingId)
                    .always(function() {
                        $btn.prop('disabled', false).text("Save");
                    });

            });
        function updateOrderStatus(orderId, status, trackingId = '') {

            $.ajax({
                url: "{{ route('admin.escort.order.complete') }}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    order_id: orderId,
                    tracking_id: trackingId,
                    status: status
                },
                success: function(response) {

                    if (!response.status) {
                        toastr.error(response.message);
                        return;
                    }

                    $('#active_req').modal('hide');
                    $('#orderStatusChange')[0].reset();
                    toastr.success('Order status updated successfully');

                    table.ajax.reload(null, false);
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || 'Something went wrong');
                }
            });
        }
        $(document).on('click', '.view-order-details', function(e) {
            e.preventDefault();
            var orderId = $(this).data('item');
            // Show loader, hide content

            var productOrderId = $(this).data('orderId');
            $("#view-listing").text('Order Details - ' + productOrderId);
            $("#orderDetailsLoader").show();
            $("#orderDetailsBody").hide().html("");

            $.ajax({
                url: "{{ route('admin.escort.order.details') }}?id=" + orderId,
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
                        "<div class='alert alert-danger'>Unable to load order details.</div>"
                    ).fadeIn();
                }
            });
        });
    </script>
@endpush
