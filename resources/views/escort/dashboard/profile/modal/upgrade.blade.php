<div class="modal fade upload-modal" id="upgrade_modal" tabindex="-1" role="dialog" aria-labelledby="extendBumpUpProfile" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form id="upgrade_modal_form" action="{{route('escort.upgrade_list')}}" method="POST">
        {{ csrf_field() }}
        <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
          <div class="modal-header">
            <h5 class="modal-title">
              <img src="/assets/app/img/bump-up.png" class="custompopicon" alt="extend" style="margin-right: 10px;">
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
                    <label class="col-sm-3" for="">Membership:</label>
                    <div class="col-sm-8 pr-2">
                      <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                              id="membershipId"
                              name="membership"
                              data-parsley-errors-container="#membershipId-errors"
                              required
                              data-parsley-required-message="Select Membership">
                        <option value="">Select Membership</option>
                        <option value="1">Platinum</option>
                        <option value="2">Gold</option>
                      </select>
                      <span id="membershipId-errors"></span>
                    </div>
                  </div>
  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="">Fee:</label>
                    <div class="col-sm-4">
                      <div class="input-group input-group-sm">
                        <input type="text" class="form-control"  name="upgrade_amount" id="upgrade_amount" value="0.00">
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
                     
                      </ol>
                    </div>
                  </div>
  
                </div>
              </div>
            </div>
          </div>
  
          <div class="modal-footer" style="text-align: center; display: block;">
            <input type="hidden" name="profile_id">
            <button type="submit" id="saveBumpupButton" class="btn-success-modal">Proceed to Payment</button>
          </div>
        </div>
      </form>
    </div>
  </div>