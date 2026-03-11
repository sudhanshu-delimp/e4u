<div class="modal fade upload-modal" id="tour_location_cancel" tabindex="-1" aria-labelledby="new-ban-3" data-backdrop="static" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{asset('assets/dashboard/img/travel.png')}}" class="custompopicon">
                    <span class="text-white">  Cancel Tour</span>                        
                 </h5>
                <button type="button" class="close cancelTourcloseSuccessBtn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            
            <div class="modal-body pb-0 agent-tour">
                <form id="cancelTourForm" action="{{route('escort.tour.cancel_tour_location')}}" method="POST">
                    <h5 class="text-center">You are about to cancel your Tour. Are you sure you<br> want to cancel your Tour?</h5>
                    <hr style="background-color: #0C223D" class="mt-3">
                    <input type="hidden" id="cancel_tour_id" value="119">
                    <div class="note">
                        <p class="font-weight-bold">Notes:</p>
                        <ol>
                            <li>If you cancel your Tour, any remaining Fees paid will be credited back to
                                you. Cancellation is immediate.</li>
                            <li>You can reactivate this Tour by going to the Tours group in the menu.</li>
                        </ol>
                    </div>
                    <div class="row">
                        <div class="col-md-12 my-3">

                            <div class="form-group d-flex align-items-center justify-content-end gap-10">
                                <input type="hidden" name="item_id">
                                <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Cancel</button>
                                <button type="submit" class="btn-success-modal cancelTourbtn">Cancel Tour</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>