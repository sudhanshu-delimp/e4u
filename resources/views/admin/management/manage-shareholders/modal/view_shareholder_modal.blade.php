 <!--View Account shareholder popupform -->
 <div class="modal fade upload-modal" id="viewShareholder" tabindex="-1" role="dialog"
     aria-labelledby="viewShareholderLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="viewShareholderTitle"><img
                         src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon">View Account</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                             class="img-fluid img_resize_in_smscreen"></span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col-sm-12">

                         <!-- Avatar -->
                         <div class="d-flex align-items-center mb-3">
                             <img src="{{ asset('assets/img/default_user.png') }}" alt="Avatar"
                                 class="rounded-circle mr-3" width="50" height="50">
                             <h6 class="mb-0">NA</h6>
                         </div>

                         <!-- Details Table -->
                         <table class="table table-bordered mb-3">
                             <tr>
                                 <th>Shareholder</th>
                                 <td>Waykar Pty Ltd</td>
                             </tr>
                             <tr>
                                 <th>Address</th>
                                 <td>123, Aus</td>
                             </tr>
                             <tr>
                                 <th>Contact</th>
                                 <td>Wayne Primrose</td>
                             </tr>
                             <tr>
                                 <th>Mobile</th>
                                 <td>0438 028 728</td>
                             </tr>
                             <tr>
                                 <th>Email</th>
                                 <td>wayne@waykar.com.au</td>
                             </tr>
                             <tr>
                                 <th>Method of Contact:</th>
                                 <td>Email</td>
                             </tr>
                             <tr>
                                 <th>Idle Time Preference</th>
                                 <td>Never</td>
                             </tr>
                             <tr>
                                 <th>2FA Authentication</th>
                                 <td>Text</td>
                             </tr>
                         </table>



                     </div>
                 </div>
             </div>
             
            <div class="d-flex justify-content-end modal-footer">
            <!-- Print Button -->

            <button class="btn-success-modal d-block btn-print" data-agent='${safeData}'>
                    <i class="fa fa-print text-white"></i> Print
            </button>

        
            <button type="button" class="btn-cancel-modal ml-2" data-dismiss="modal" aria-label="Close">Close</button>
        </div>
         </div>
     </div>
 </div>
 <!-- end -->
