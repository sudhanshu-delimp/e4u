 {{-- View Modal --}}
 <div class="modal fade upload-modal bd-example-modal-lg" id="view_report" tabindex="-1" role="dialog" aria-labelledby="view_reportLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modal_title"><img src="{{ asset('assets/dashboard/img/docs.png') }}"
                         class="custompopicon"><span>Massage Centre Report</span>
                 </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                             class="img-fluid img_resize_in_smscreen">
                     </span>
                 </button>
             </div>
             <div class="modal-body">
                {{-- Loder --}}
                 <div id="report_loader" class="text-center py-4" style="display:none;">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Loading...</p>
                </div>

                <div id="report_items_list"></div>

             </div>

             <div class="modal-footer">
                 <div class="d-flex justify-content-end gap-10">
                     <span id="selectedCount" class="badge badge-primary" style="display:none;">
                         0 Selected
                     </span>

                     <div class="d-flex gap-10">
                         <button type="button" class="btn-success-modal" id="footerPrintBtn">
                             Print
                         </button>
                         <button type="button" class="btn-success-modal" id="footerSaveBtn">
                             Save
                         </button>
                     </div>
                 </div>
             </div>

             
         </div>
     </div>
 </div>
 {{-- end --}}
