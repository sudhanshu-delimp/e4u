<div class="modal fade upload-modal modal-form-upgrade" id="upgrade_modal" tabindex="-1" role="dialog" aria-labelledby="extendBumpUpProfile" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <form id="upgrade_modal_form" action="{{route('escort.upgrade_list')}}" method="POST">
      {{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <img src="{{ asset('assets/dashboard/img/upgrade.png') }}" class="custompopicon" alt="Upgrade">
            Upgrade
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
                  <label class="col-sm-3" for=""> Profile:</label>
                  <div class="col-sm-9">
                    <select
                      class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                      id="upgrade_profile_id" name="escort_id"
                      data-parsley-errors-container="#upgrade_profile-errors" required
                      data-parsley-required-message="Select Profile">

                    </select>
                    <span id="profile-errors"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3" for="">Upgrade to:</label>
                  <div class="col-sm-9">
                    <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                      id="membershipId"
                      name="membership"
                      data-parsley-errors-container="#membershipId-errors"
                      required
                      data-parsley-required-message="Select Membership">
                      <option value="">Select Membership</option>
                      <option value="1">Platinum</option>
                      <option value="2">Gold</option>
                      <option value="3">Silver</option>
                    </select>
                    <span id="membershipId-errors"></span>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" for="">Fee:</label>
                  <div class="col-sm-4">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 0rem;">$</span>
                      </div>
                      <input type="text" class="form-control" name="upgrade_amount" id="upgrade_amount" value="0.00" style="border-radius: 0rem;" disabled>
                    </div>
                  </div>
                </div>

                <hr style="background-color: #0C223D" class="mt-4">

                <!-- Notes -->
                <div class="form-group row">
                  <div class="col-lg-12">
                    <p class="mb-1"><b>Notes:</b></p>
                    <ol class="pl-4 text-justify">
                      <li>The Fee is calculated according to the upgraded Membership Type. Your original Membership Type Fee has been deducted from the new Fee.</li>
                      <li>You agree to your Card being debited the Fee.</li>
                      <li>Details of this transaction can be viewed in the Transaction Summary.</li>
                    </ol>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer" style="text-align: right; display: block;">
          <button id="modalPaymentButton" class="btn-success-modal text-white" type="button" data-toggle="modal" data-target="#process-payment-modal" data-backdrop="static" data-keyboard="false" name="action" value="upgrade">Proceed to Payment</button>
          <button type="submit" id="saveBumpupButton" class="btn-success-modal d-none">Proceed to Payment</button>
        </div>
      </div>
    </form>
  </div>
</div>