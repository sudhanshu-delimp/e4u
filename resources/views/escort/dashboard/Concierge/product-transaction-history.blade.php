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
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table w-100" id="productsHistoryTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Transaction ID</th>
                                <th>Transaction Method</th>
                                <th>Reference ID</th>
                                <th>Amount</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>EPAY_20201104T062121446Z357074</td>
                                <td>
                                    Credit card
                                </td>
                                <td>43558</td>
                                <td>$ 45.00</td>
                                <td>Skate Peter</td>
                                <td>
                                    <span class="custom_badge badge_accepted">Success</span>
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

                    columns: [
                        {
                            data: 'transaction_id',
                            name: 'transaction_id'
                        },
                        {
                            data: 't_method',
                            name: 't_method'
                        },
                        {
                            data: 'ref_Id',
                            name: 'ref_Id'
                        },
                        {
                            data: 'amount',
                            name: 'amount'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'status',
                            name: 'status'
                          
                            
                        }
                    ]
                });
            });
        </script>
    @endpush
