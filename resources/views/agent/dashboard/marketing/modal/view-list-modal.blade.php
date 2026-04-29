 {{-- view Modal --}}
 <div class="modal fade upload-modal bd-example-modal-lg" id="view_centerlist" tabindex="-1" role="dialog"
     aria-labelledby="view_listLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="view_list"><img
                         src="{{ asset('assets/dashboard/img/profile-report.png') }}" class="custompopicon">Massage
                     Centre Report
                 </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                             class="img-fluid img_resize_in_smscreen"></span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="table-responsive profile_summary">
                     <table cellpadding="8" cellspacing="0" width="100%"
                         style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">

                         <thead class="bg-first">
                             <!-- Table Headings -->
                             <tr>
                                 <td>ID</td>
                                 <td>Business Name</td>
                                 <td>Address</td>
                                 <td>Post Code</td>
                                 <td>Mobile Number</td>
                                 <td>Business Number</td>
                                 {{-- <td>Select</td> --}}
                             </tr>
                         </thead>
                         <tbody id="centerlist_items">

                         </tbody>

                     </table>
                 </div>

                 <div class="d-flex justify-content-end gap-10 mt-3">
                     <span id="viewSelectedCount" class="badge badge-primary" style="display:none;">
                         0 Selected
                     </span>

                     {{-- <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                         id="close_change">Print</button> --}}
                     {{-- <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                         id="close_change">Save</button> --}}
                     <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close"
                         id="close_change">Close</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
