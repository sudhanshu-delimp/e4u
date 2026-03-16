 <!-- Merged List Modal -->
 <div class="modal fade upload-modal" id="mergeList" tabindex="-1" role="dialog" aria-labelledby="mergeListlabel"
     aria-hidden="true" data-backdrop="static">

     <div class="modal-dialog modal-dialog-centered" style="max-width: 1200px" role="document">
         <div class="modal-content">

             <!-- Header -->
             <div class="modal-header">
                 <h5 class="modal-title">
                     <img src="{{ asset('assets/dashboard/img/merge.png') }}" class="custompopicon">
                     <span class="text-white">
                         Merged Information Document ([post code range])
                     </span>
                 </h5>

                 <button type="button" class="close" data-dismiss="modal">
                     <span aria-hidden="true">
                         <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                     </span>
                 </button>
             </div>

             <!-- Body -->
             <div class="modal-body" style="max-height:500px; overflow-y:auto;">

                 <div class="table-responsive">
                     <table class="table table-bordered table-sm">
                         <thead class="table-bg">
                             <tr>
                                 <th colspan="3">Agent Business Details</th>                                 
                                 <th>Date</th>
                                 <th colspan="3">Agent Details</th>
                                 <th>Agent's Signature</th>
                                 <th colspan="2">Centre Details</th>
                                 <th class="text-center">Actions</th>
                             </tr>
                         </thead>
                         <tbody>

                             <tr>  
                                <td colspan="3">
                                    <div class="profile_list">
                                         <i class="fa fa-briefcase" aria-hidden="true"></i>
                                         <span class="profile_label"> Business Name (Agent) </span>ABC Marketing
                                     </div>
                                     <div class="profile_list">
                                         <i class="fa fa-user" aria-hidden="true"></i>
                                         <span class="profile_label">Agent's (business) Name</span>John Smith

                                     </div>
                                     <div class="profile_list">
                                         <i class="fa fa-envelope" aria-hidden="true"></i>
                                         <span class="profile_label">Agent's email address</span>john@example.com
                                     </div>
                                </td>
                                   <td>02-03-2026</td>
                                 <td colspan="3">
                                     <div class="profile_list">
                                         <i class="fa fa-user" aria-hidden="true"></i>
                                         <span class="profile_label">Agent's Name </span>John Doe 
                                     </div>
                                     <div class="profile_list">
                                         <i class="fa fa-phone" aria-hidden="true"></i>
                                         <span class="profile_label">Agent's Mobile</span>040 000 0000
                                     </div>

                                     <div class="profile_list">
                                         <i class="fa fa-envelope" aria-hidden="true"></i>
                                         <span class="profile_label">Agent's Email </span>john@example.com
                                     </div>

                                 </td>
                                 <td>Signed</td>
                                 <td colspan="2">
                                    <div class="profile_list">
                                         <i class="fa fa-briefcase" aria-hidden="true"></i>
                                         <span class="profile_label">Business Name (Centre)</span>Relax Spa
                                     </div>
                                     <div class="profile_list">
                                         <i class="fa fa-map-marker-alt" aria-hidden="true"></i>
                                         <span class="profile_label"> Address (Centre)</span>123 Main Street

                                     </div>
                                 </td>
                              
                                 <td class="text-center">
                                    <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button"
                                        id="dropdownMenuLink" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="true">
                                        <i
                                            class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink"
                                        x-placement="bottom-end">
                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                            href="{{ route('printreport') }}" target="_blank"> <i class="fa fa-print"></i>
                                            Print</a>
                                        <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                            href="#"> <i class="fa fa-save"></i>
                                            Save</a>

                                    </div>
                                </div>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>

             </div>

             <!-- Footer -->
             <div class="modal-footer justify-content-end">
                 <button type="button" class="btn-success-modal">Print</button>
                 <button type="button" class="btn-success-modal">Save</button>
                 <button type="button" class="btn-cancel-modal" data-dismiss="modal">
                     Close
                 </button>
             </div>

         </div>
     </div>
 </div>
