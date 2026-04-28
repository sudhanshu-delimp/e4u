@extends('layouts.escort')
@section('style')
<style>
    .table td{
        vertical-align: middle;
    }
    .order_details table td{
        border:none;
        border-bottom: 1px solid #ccc;
    } .order_details table th{
        border:none;
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
                    <h1 class="h1">Transaction History</h1>
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
                                <th>Product</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Unit Price <sub>(1)</sub></th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>CMO001</td>
                                <td>
                                    <div style="width: 50px; border-radius: 5px; overflow: hidden;">
                                        <img src="{{ asset('assets/dashboard/img/product/p2.png') }}" alt="" class="w-100 h-100 object-fit-cover">
                                    </div>
                                </td>
                                <td>CM01</td>
                                <td>Four Seasons - Naked bulk pack Pure Pink Qty: 144 Size: 54mm</td>
                                <td>$10.00</td>
                                <td>2</td>
                                <td>$20.00</td>
                                <td>2023-01-01</td>
                                <td>
                                    <span class="custom_badge badge_pending">Pending</span>
                                </td>
                                <td>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href=""
                                            role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"> <i
                                                class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right"
                                            aria-labelledby="dropdownMenuLink">
                                            <a href="javscript:void(0)" class="dropdown-item d-flex align-items-center justify-content-start gap-10 delete-center"
                                                data-toggle="modal" data-target="#view_product"><i class="fa fa-eye"></i>view</a>
                                            

                                        </div>
                                    </div>
                                </td>
                            </tr>
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
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Code",
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
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'order_id',
                            name: 'order_id'
                        },
                        {
                            data: 'product',
                            name: 'product',
                             orderable: false,
                            searchable: false,
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },
                        {
                            data: 'order_date',
                            name: 'order_date'
                        },
                        {
                            data: 'status',
                            name: 'status'
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
