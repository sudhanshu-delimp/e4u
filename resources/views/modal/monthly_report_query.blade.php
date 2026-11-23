@if($console == 'operator')

<div class="modal fade upload-modal opr-modal center" id="queryConversationModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered"
         role="document">
        <div class="modal-content">
         
                 <div class="modal-header">

                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/operator/view-reply.png') }}"
                        class="custompopicon">Query</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/dashboard/img/operator/close.png') }}" class="opr-close-btn">
                </a>
            </div>
                <div class="modal-body my-custom-modal-body" >
                    <div class="row">
                        <div class="col-sm-12 conv-main" id="conv-main">

                        </div>
                    </div>
                </div>
                <div class="reply-wrapper p-3">
                    <form id="sendMessage">
                       <div class="reply-message-box">
                        <textarea class="messageBox" name="message" id="message" rows="4" required></textarea>
                        <input type="hidden" name="reference_id" id="reference_id" >
                        <button class="btn-cancel-modal" id="submit_message">Send</button>
                       </div>
                       <small class="text-danger d-none" id="message_error">Please enter a message.</small>
                    </form>
                </div>
        </div>
    </div>
</div>
@else 
<div class="modal fade upload-modal center" id="queryConversationModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered"
         role="document">
        <div class="modal-content">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <span class="custom-pop-wrapper"><img src="/assets/dashboard/img/view-reply.png" class="custompopicon" alt="cross"><h5 class="modal-title" id="ticket_name">Query</h5></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
                                                      class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body my-custom-modal-body" >
                    <div class="row">
                        <div class="col-sm-12 conv-main" id="conv-main">

                        </div>
                    </div>
                </div>
                <div class="reply-wrapper p-3">
                    <form id="sendMessage">
                       <div class="reply-message-box">
                        <textarea class="messageBox" name="message" id="message" rows="4" required></textarea>
                        <input type="hidden" name="reference_id" id="reference_id" >
                        <button class="btn-cancel-modal py-3" id="submit_message">Send</button>
                       </div>
                       <small class="text-danger d-none" id="message_error">Please enter a message.</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif