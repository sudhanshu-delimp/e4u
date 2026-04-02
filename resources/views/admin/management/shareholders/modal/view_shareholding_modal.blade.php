 <!--View Account shareholder popupform -->
 <div class="modal fade upload-modal" id="viewShareholding" tabindex="-1" role="dialog"
     aria-labelledby="viewShareholdingLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="viewShareholdingTitle"><img
                         src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon">View Account</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                             class="img-fluid img_resize_in_smscreen"></span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col-sm-12">

                         <!-- Details Table -->
                         <table class="table table-bordered mb-3">
                             <tr>
                                 <th>Shareholder</th>
                                 <td>Waykar Pty Ltd</td>
                             </tr>
                             <tr>
                                 <th>Date of Entry</th>
                                 <td>06-04-2023</td>
                             </tr>
                             <tr>
                                 <th>Type</th>
                                 <td>Ordinary</td>
                             </tr>
                             <tr>
                                 <th>Shares</th>
                                 <td>27,500</td>
                             </tr>
                             <tr>
                                 <th>Shareholding</th>
                                 <td>55%</td>
                             </tr>
                             <tr>
                                 <th>Threshold</th>
                                 <td>Yes</td>
                             </tr>
                             <tr>
                                 <th>Beneficially Held</th>
                                 <td>Yes</td>
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
