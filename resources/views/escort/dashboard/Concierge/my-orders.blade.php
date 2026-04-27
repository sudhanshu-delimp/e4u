@extends('layouts.escort')
@section('style')
<style>
    table td{
        vertical-align: baseline !important;
    }
</style>
@stop
@section('content')

<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">My Orders</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol class="pl-4">
                        
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive-xl">
                <table class="table" id="productOrderlist">
                    <thead class="table-bg">
                        <tr>
                            <th scope="col">Code
                            </th>
                            <th scope="col">Items</th>
                            <th scope="col">
                                Short Description
                            </th>
                            <th>Unit Price<sup>(1)</sup></th>
                            <th>Price</th>
                            <th scope="col">Total</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>CM01</td>
                            <td>
                                <img src="{{ asset('assets/dashboard/img/product/placeholder.png') }}" alt="products" class="rounded" style="width:75px;">
                            </td>
                            <td>
                                <p>Four Seasons - Naked bulk pack Pure Pink Qty: 144 Size: 54mm $</p>
                            </td>
                            <td>Qty : 1</td>
                            <td>$ 45.00 </td>
                            <td>$ 45.00 </td>
                            <td>27-04-2026</td>
                            <td>
                                <span class="custom_badge badge_pending">Pending</span>
                            </td>

                                <td class=" text-center"><div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style=""><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center edit-agent-btn" href="javascript:void(0)" data-id="172" data-toggle="modal"> <i class="fa fa-pen"></i> Edit </a><div class="dropdown-divider"></div><a class="dropdown-item d-flex justify-content-start gap-10 align-items-center account-suspend-btn" href="javascript:void(0)" data-id="172">   <i class="fa fa-ban"></i> Suspend</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="javascript:void(0)" data-id="172">  <i class="fa fa-eye "></i> View Account</a></div>
                            </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- open success popup -->
    <div class="modal fade upload-modal" id="successModal" tabindex="-1" role="dialog"
        aria-labelledby="successModallabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img id="image_icon" class="custompopicon" src="{{ asset('assets/dashboard/img/unblock.png') }}">
                        <span id="success_task_title"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <div class="pb-3 pt-2 text-center" id="success_form_html">
                        <h4 id="success_msg"></h4>
                        <button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal"
                            aria-label="Close">OK</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
       
        //DataTable initialization
        var table = $("#productOrderlist").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Title"
            },
            processing: true,
            serverSide: true,
           
            columns: [{
                    data: 'ref',
                    name: 'ref'
                },
                {
                    data: 'image',
                    name: 'image',

                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'posted_date',
                    name: 'posted_date'

                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
            ],
            order: [],
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10
        });


    </script>

@endpush
