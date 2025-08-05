@extends('layouts.escort')
@section('style')
<style>
   td,
   th {
       vertical-align: middle !important;
       text-align: center;
   }
   #transactionSummaryTable td {
    white-space: normal !important;
    word-break: break-word;
}
.avatar img {
   width: 60px; height: 60px;
   border-radius: 50%;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <div class="row">
      <div class="col-md-12 custom-heading-wrapper">
         <h1 class="h1">Transaction Summary</h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
      </div>
   </div>
   <div class="row collapse" id="notes">
      <div class="col-md-12 mb-4">
         <div class="card">
            <div class="card-body">
               <h3 class="NotesHeader"><b>Notes:</b> </h3>
               <ol class="mb-0">
                  <li>All Advertiser transactions are recorded here.</li>
                  <li>You can view any historical transaction as well as print or email the transaction
                     summary.</li>
                  <li class="mb-0">To download the transaction summary, click Download located in the Action options.</li>
              </ol>
            </div>
         </div>
      </div>
   </div>

   <!--middle content-->
   <div class="row">
    <div class="col-md-12">        
        <div class="table-responsive membership--inner">
            <table class="table table-bordered text-center display" id="transactionSummaryTable">
                 <thead class="table-bg">
                   <tr>
                    <th>Ref</th>
                    <th>Service Type</th>
                    <th>Transaction Date</th>
                    <th>Transaction Value</th>
                    <th>Card</th>
                    <th>Completed By</th>
                    <th>Action</th>
                   </tr>
                </thead>
                <tbody>
                  <tr>
                     <td>323456</td>
                     <td>Listing</td>
                     <td>25-07-2025</td>
                     <td><span>$</span> 80.00</td>
                     <td>E40125</td>
                     <td>1235 1258 4123 xxxx</td>
                     <td>
                        <div class="dropdown no-arrow">
                           <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                           </a>
                           <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                              
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#view-listing" > <i class="fa fa-eye"></i> View </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" > <i class="fa fa-fw fa-download" ></i> Download </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" onclick="window.print();"> <i class="fa fa-fw fa-print" ></i> Print </a>
                              
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



<div class="modal fade upload-modal" id="view-listing" tabindex="-1" role="dialog" aria-labelledby="view-listingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="view-listing"><img src="{{ asset('assets/dashboard/img/transaction.png')}}" alt="alert" style="width:29px;">
                    Transaction Summary
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0">
               <div class="row">
                  <div class="col-12 mb-3">
                        <div id="listingModalContent">
                        <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
                           <tbody>
                              <tr>
                              <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Ref</strong></td>
                              <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">323456</td>
                              </tr>
                              <tr>
                              <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Member ID</strong></td>
                              <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">E40125</td>
                              </tr>
                              <tr>
                              <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Completed
                                 By</strong></td>
                              <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">E40125</td>
                              </tr>
                              <tr>
                              <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Service Type</strong></td>
                              <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">Listing</td>
                              </tr>
                              <tr>
                              <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Transaction
                                 Date</strong></td>
                              <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">25-07-2025</td>
                              </tr>
                              <tr>
                              <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Transaction
                                 Value</strong></td>
                              <td style="border: 1px solid #ccc; padding: 8px; text-align:left;"><span>$</span> 80.00</td>
                              </tr>
                              <tr>
                              <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Card</strong></td>
                              <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">235 1258 4123 xxxx </td>
                              </tr>
                           </tbody>
                        </table>

                        </div>
                  </div>
               </div>
            </div>
            <!-- <div class="modal-footer pb-4 mb-2">
                <button type="button" class="btn btn-primary">Publish</button>
            </div> -->
        </div>
    </div>
</div>


 @endsection
@section('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
   var table = $("#transactionSummaryTable").DataTable({
    language: {
        search: "Search: _INPUT_",
        searchPlaceholder: "Search by Ref No..."
    },
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    bStateSave: true,
    order: [[1, 'desc']],
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10
});

 </script>

@endsection
