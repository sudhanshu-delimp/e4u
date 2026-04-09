 {{-- View Modal --}}
    <div class="modal fade upload-modal bd-example-modal-lg" id="view_report" tabindex="-1" role="dialog"
        aria-labelledby="view_reportLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title"><img
                            src="{{ asset('assets/dashboard/img/docs.png') }}" class="custompopicon"><span>Massage
                        Centre Report</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive profile_summary">
                       <iframe src="{{ asset('assets/dashboard/document/Agent_Console_Marketing_Document_1_(09-2025).pdf') }}" width="100%" height="600px" id="pdfNo">
                       </iframe>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end gap-10">
                         <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close"
                            id="close_change">Close</button>
                            <a href="{{ route('agent.single-merge-report') }}" target="_blank" class="btn-success-modal" id="single-continue">Continue</a>
                            <a href="{{ route('agent.merge-report') }}" target="_blank" class="btn-success-modal" id="multiple-continue">Continue</a>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}