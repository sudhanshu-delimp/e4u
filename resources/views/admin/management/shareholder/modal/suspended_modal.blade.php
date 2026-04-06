 <!-- add new shareholder popupform -->
        <div class="modal fade upload-modal" id="suspendAccount" tabindex="-1" role="dialog"
            aria-labelledby="suspendAccountLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="suspendAccountTitle"><img
                                src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon"> Account Suspended</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <h5 class="custom_modal_text">Your account has been suspended.</h5>
                    </div>
                    <div class="justify-content-center modal-footer pt-0">                                     
                        <button type="button" class="btn-cancel-modal ml-2" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end -->