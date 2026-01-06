<div class="modal fade upload-modal" id="bumpup_profile" tabindex="-1" role="dialog" aria-labelledby="extendBumpUpProfile" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form id="bumpup_profile_form" action="{{route('escort.bumpup_register')}}" method="POST">
        {{ csrf_field() }}
        <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
          <div class="modal-header">
            <h5 class="modal-title">
              <img src="/assets/app/img/bump-up.png" class="custompopicon" alt="extend" style="margin-right: 10px;">
              Bump Up Profile
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">
                <img id="modal_close_extend" src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
              </span>
            </button>
          </div>
  
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="container p-0">
  
                  <!-- Profile select -->
                  <div class="form-group row">
                    <label class="col-sm-3" for="">Profile:</label>
                    <div class="col-sm-8 pr-2">
                      <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                              id="bumpUpProfileId"
                              name="escort_id"
                              data-parsley-errors-container="#extend-profile-errors"
                              required
                              data-parsley-required-message="Select Profile">
                        <option value="">Select Profile</option>
                        
                      </select>
                      <span id="extend-profile-errors"></span>
                    </div>
                  </div>
  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="">Fee:</label>
                    <div class="col-sm-4">
                      <div class="input-group input-group-sm">
                        <span class="input-group-text" style="border-radius: 0rem; font-size:0.8rem;padding: 0px 10px;">$</span>
                        <span class="form-control" id="extendFeeLive" style="background-color: #e9ecef; border: 1px solid #ced4da;">{{ getBumpupFee() }}</span>
                      </div>
                    </div>
                  </div>
  
                  <hr style="background-color: #0C223D" class="mt-4">
  
                  <!-- Notes -->
                  <div class="form-group row">
                    <div class="col-lg-12">
                      <p class="mb-1"><b>Notes:</b></p>
                      <ol class="pl-4 text-justify">
                        <li>Your nominated Profile will be Bumped Up to the top of your nominated Membership Type in the Listings.</li>
                        <li>Any Membership Type Profile can be Bumped Up. They will remain in the Bumped Up position for 24 hours, after which, they will re-enter the nominated Membership Type Listings and be subject to the reshuffling rules.</li>
                        <li>The Fee is fixed for each occasion you apply a Bump Up to a Listed Profile. You can Bump Up as often as you like.</li>
                        <li>Details of this transaction can be viewed in the Transaction Summary.</li>
                      </ol>
                    </div>
                  </div>
  
                </div>
              </div>
            </div>
          </div>
  
          <div class="modal-footer" style="text-align: center; display: block;">
            <button type="submit" id="saveBumpupButton" class="btn-success-modal">Proceed to Payment</button>
          </div>
        </div>
      </form>
    </div>
  </div>