@extends('layouts.admin')
@section('style') 
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
      <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
         <div class="row">

            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Discount to Fees</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                           <li>
                              Discounts to Fees (<b>Discounts</b>) must be approved by the Managing Director (Level 1).
                           </li>

                           <li>
                              Discounts only apply to the Advertiser’s Membership Type.
                           </li>

                           <li>
                              Where a Discount has been applied, the Loyalty Program falls away.
                           </li>
                        </ol>
                     </div>
               </div>
            </div> 
         </div>

         <div class="row mb-3">
            <div class="col-lg-12">
               <div class="d-flex justify-content-between gap-10">
                  <div class="d-flex justify-content-between gap-10">
                     <div class="total_listing">
                        <div><span>Escorts Discount : </span></div>
                        <div><span class="totalInprogressTask">1</span></div>
                     </div>
                     
                     <div class="total_listing">
                           <div><span>Centres Discount : </span></div>
                           <div><span class="totalInprogressTask">2</span></div>
                     </div>
                  </div>
                  <button class="btn-success-modal" type="button" data-target="#advertiser_discount" data-toggle="modal">
                     Advertiser Discount
                  </button>
               </div>
            </div>
         </div>

          <div class="row">
            <div class="col-sm-12">
               <div class="table-responsive">
                  <table class="table w-100 " id="discountFeetable">
                     <thead class="table-bg">
                        
                        <tr>
                           <th>Member ID</th>
                           <th>Name</th>
                           <th>Agent ID</th>
                           <th>Rate</th>
                           <th>Discount</th>
                           <th>Granted</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                           
                     </thead>
                     <tbody>
                        <tr>
                           <td>M40156</td>
                           <td>CBD Massage</td>
                           <td>A40489</td>
                           <td><div class="num_value">$<span>20.00</span></div></td>
                           <td>33.0%</td>
                           <td>31-03-2026</td>
                           <td>Expires: 30-06-2026</td>
                           <td>
                              <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="custom-tooltip-container"><a
                                                        class="dropdown-item align-item-custom toggle-massage-notification"
                                                        href="#" title="Click to disable notification">
                                                    </a>
                                                    <a class="dropdown-item align-item-custom" data-toggle="modal"
                                                        data-target="#confirm" href=""> <i
                                                            class="fa fa-times" aria-hidden="true"></i>
                                                        Cancel</a>
                                                    <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#discount_history"> <i
                                                            class="fa fa-history" aria-hidden="true"></i>
                                                        History</a>
                                                        <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#renew_discount"> <i
                                                            class="fa fa-sync" aria-hidden="true"></i>
                                                        Renew</a>
                                                </div>
                                            </div>

                                        </div>
                           </td>
                        </tr>

                         <tr>
                           <td>M60789</td>
                           <td>Lin’s Massage Lounge</td>
                           <td>-----</td>
                           <td><div class="num_value">$<span>10.00</span></div></td>
                           <td>66.0%</td>
                           <td>1-03-2026</td>
                           <td>Expired</td>
                           <td>
                              <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="custom-tooltip-container"><a
                                                        class="dropdown-item align-item-custom toggle-massage-notification"
                                                        href="#" title="Click to disable notification">
                                                    </a>
                                                    <a class="dropdown-item align-item-custom" data-toggle="modal"
                                                        data-target="#confirm" href=""> <i
                                                            class="fa fa-times" aria-hidden="true"></i>
                                                        Cancel</a>
                                                    <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#discount_history"> <i
                                                            class="fa fa-history" aria-hidden="true"></i>
                                                        History</a>
                                                        <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#renew_discount"> <i
                                                            class="fa fa-sync" aria-hidden="true"></i>
                                                        Renew</a>
                                                </div>
                                            </div>

                                        </div>
                           </td>
                        </tr>

                         <tr>
                           <td>E60492</td>
                           <td>Karlee</td>
                           <td>----</td>
                           <td>
                              <div class="num_value">P:$<span>9.00</span></div>
                              <div class="num_value">G:$<span>7.20</span></div>
                              <div class="num_value">S:$<span>5.40</span></div>
                           </td>
                           <td>10.0%</td>
                           <td>12-12-2025</td>
                           <td>Expires: 31-03-2026</td>
                           <td>
                              <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="custom-tooltip-container"><a
                                                        class="dropdown-item align-item-custom toggle-massage-notification"
                                                        href="#" title="Click to disable notification">
                                                    </a>
                                                    <a class="dropdown-item align-item-custom" data-toggle="modal"
                                                        data-target="#confirm" href=""> <i
                                                            class="fa fa-times" aria-hidden="true"></i>
                                                        Cancel</a>
                                                    <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#discount_history"> <i
                                                            class="fa fa-history" aria-hidden="true"></i>
                                                        History</a>
                                                        <div class="dropdown-divider"></div>
                                                     <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#renew_discount"> <i
                                                            class="fa fa-sync" aria-hidden="true"></i>
                                                        Renew</a>
                                                </div>
                                            </div>

                                        </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>

      </div>
</div>

@include('admin/management/fee_discount/modal/discount_history_modal')
@include('admin/management/fee_discount/modal/advertiser_discount_modal')
@include('admin/management/fee_discount/modal/renew_discount_modal')
@include('admin/management/fee_discount/modal/confirm_modal')

@endsection

@prepend('script')
<script>
    var table = $("#discountFeetable").DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Member ID"
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
               { data: 'member_id', name: 'member_id', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'agent_id', name: 'agent_id', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'rate', name: 'rate', searchable: true, orderable:false ,defaultContent: 'NA'},
               { data: 'discount', name: 'discount', searchable: true, orderable:false,defaultContent: 'NA' },
               { data: 'granted', name: 'granted', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'status', name: 'status', searchable: true, orderable:true,defaultContent: 'NA' },
               { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
           ],
    });
</script>
@endprepend

