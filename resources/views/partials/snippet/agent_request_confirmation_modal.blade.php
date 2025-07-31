<div class="modal fade upload-modal" id="agentconfirmationPopup" tabindex="-1" role="dialog" aria-labelledby="confirmationPopup" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="confirmationPopup"> <img src="{{asset('assets/dashboard/img/request-submit.png')}}" style="width:40px; margin-right:10px;" alt="Agent Request Submitted"> Agent Request Submitted</h5>
             <button type="button" class="close close_request_modal" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
             </button>
          </div>
          <div class="modal-body pb-0">
                <div class="row">
                   <div class="col-12 mb-3">
                        <p>Your Request for a Support Agent has been submitted. A Support Agent will be in touch
                            with you according to your preferred method.</p>
                            <p>If a Support Agent has not contacted you within 24 hours, please raise a Support Ticket
                                quoting the following reference : 
                                @if(session('req_ref_number'))
                                {{ session('req_ref_number') }}.
                                @endif
                            </p>
                   </div>
                </div>
          </div>
          <div class="modal-footer text-center justify-content-center">             
             <button type="button" class="btn-success-modal close_request_modal" data-dismiss="modal" aria-label="Close">Close</button>
          </div>
       </div>
    </div>
 </div>