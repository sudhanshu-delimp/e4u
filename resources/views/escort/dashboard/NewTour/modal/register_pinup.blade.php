<div class="modal fade upload-modal" id="pinup_profile" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
        aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            
                <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id=""><img src="/assets/app/img/register.png" class="custompopicon" alt="cross" style="width:32px"> Register for Pin Up</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img id="modal_close"
                                        src="{{ asset('assets/app/img/newcross.png') }}"
                                        class="img-fluid img_resize_in_smscreen"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="container p-0">
                                    <form id="pinup_profile_form" action="{{route('pinup.register')}}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-3" for=""> Location:</label>
                                            <div class="col-sm-8">
                                                <select
                                                    class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                                    id="pinup_location_id" name="pinup_location_id"
                                                    data-parsley-errors-container="#pinup_location-errors" required
                                                    data-parsley-required-message="Select Profile">
                                                   
                                                </select>
                                                <span id="location-errors"></span>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3" for=""> Profile:</label>
                                            <div class="col-sm-8">
                                                <select
                                                    class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                                    id="pinup_profile_id" name="pinup_profile_id"
                                                    data-parsley-errors-container="#pinup_profile-errors" required
                                                    data-parsley-required-message="Select Profile">
                                                   
                                                </select>
                                                <span id="profile-errors"></span>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3" for=""> Next available:</label>
                                            <div class="col-sm-8">
                                                <select
                                                    class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                                    id="pinup_week" name="pinup_week"
                                                    data-parsley-errors-container="#pinup_week-errors" required
                                                    data-parsley-required-message="Select Profile">
                                                    <option value="">Select Week</option>
                                                </select>
                                                <span id="profile-errors"></span>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="">Fee:</label>
                                            <div class="col-sm-4">
                                              <div class="input-group input-group-sm">
                                                <span class="input-group-text" style="border-radius: 0rem; font-size:0.8rem;padding: 0px 10px;">$</span>
                                                <span class="form-control" id="extendFeeLive" style="background-color: #e9ecef; border: 1px solid #ced4da;">{{getPinupFee()}}</span>
                                              </div>
                                            </div>
                                          </div>
                                        <div class="form-group row custom-pin-button">
                                            <div class="col-sm-12 text-center">
                                                <input type="hidden" name="tour_location_id">
                                                <button type="submit" class="btn btn-primary"
                                                    id="savePinupButton">Proceed to Payment</button>
                                            </div>
                                        </div>
                                        </form>
                                        <hr style="background-color: #0C223D" class="mt-4"> 
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <p class="mb-1"><b>Notes:</b></p>
                                                <ol class="pl-4 text-justify">
                                                    <li> You must have a Current Platinum Listing to register as a Pin Up.</li>
                                                    <li> If the date period you have selected is not available, and your
                                                        Current Listing period
                                                        exceeds the requested period, you will be added to the pool.</li>
                                                    <li> If a position becomes available from the pool, you will be
                                                        automatically listed. If
                                                        your Listed Profile has been Suspended or Cancelled, the Pin Up
                                                        listing will also
                                                        cancel.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>