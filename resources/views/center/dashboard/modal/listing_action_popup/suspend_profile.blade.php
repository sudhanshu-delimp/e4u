  
  <div class="modal fade upload-modal" id="suspend_profile" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
    aria-modal="true">
  
  

        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form id="suspend_form" name="suspend_form" method="post">
                <div class="modal-content">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">
                                <img src="{{ asset('assets/app/img/deactivate.png')}}" class="custompopicon" alt="cross"> Suspend Profile</h5>
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
                                        <div class="form-group row">
                                            <label class="col-sm-3" for=""> Profile:</label>
                                            <div class="col-sm-9">
                                                <select
                                                    class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                                    id="suspendProfileId" name="suspend_profile_id"
                                                    data-parsley-errors-container="#profile-errors" required
                                                    data-parsley-required-message="Select Profile">
                                                    <option value="">Select Profile</option>
                                                     @foreach ($active_profile as $profile)
                                                   
                                                        @php
                                                            $purchase = $profile->latestPurchase;
                                                        @endphp
                                                              

                                                    
                                                    <option 
                                                        value="{{ $profile['id'] }}"
                                                        profile_name="{{ $profile['business_name'] }}"
                                                        data-start= "{{ ($purchase) ?   date('d-m-Y',strtotime($purchase['start_date'])) : '' }}"
                                                        data-end="{{ ($purchase) ?  date('d-m-Y',strtotime($purchase['end_date'])) : '' }}"
                                                        data-membership= "{{ ($purchase) ? $purchase['membership_id']  : '' }}"
                                                        data-parsley-type="" 
                                                        data-parsley-type-message="">
                                                        {{ $profile['id'] }} - {{ $profile['business_name'] }} 
                                                        
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <span id="profile-errors"></span>
                                            </div>
                                            {{-- <div class="col-sm-1"></div> --}}
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3" for=""> Suspension Period:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                    <input type="text" id="suspendStartDate" required
                                                        class="form-control form-control-sm removebox_shdow js_datepicker"
                                                        name="start_date"
                                                        data-parsley-type="" data-parsley-type-message="">
                                                    <span id="brb-time-errors"></span>
                                                </div>
                                                <div class="col-sm-1">
                                                    <span>to:</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" id="suspendEndDate" required
                                                        class="form-control form-control-sm removebox_shdow js_datepicker"
                                                        name="end_date" data-parsley-type=""
                                                        data-parsley-type-message="">
                                                    <span id="brb-time-errors"></span>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="">Credit:</label>
                                            <div class="col-sm-4">
                                                <div class="input-group input-group-sm" style="padding-right: 25px;">
                                                    <span class="input-group-text"
                                                        style="border-radius: 0rem; font-size:0.8rem;padding: 0px 10px;">$</span>
                                                    <span class="form-control" id='creditCalculationLive'
                                                        style="background-color: #e9ecef; border: 1px solid #ced4da;">0.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    <hr style="background-color: #0C223D" class="mt-4"> 
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <p class="mb-1"><b>Notes:</b></p>
                                                <ol class="pl-4 text-justify">
                                                    {{-- <li> Use this feature to review and
                                                        make changes to your Profiles. Any changes you make to a Profile
                                                        will be applied to the
                                                        Profile once the changes are saved.</li> --}}
                                                    
                                                    <li> To suspend a Listing, select the Profile and suspension period, then click Suspend. You will be credited with the Fees according to the suspension period.</li>
                                                        <li> Once your Profile is suspended, it cannot be reinstated for the
                                                        suspended period.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="text-align: end; display: block;">
                            <button type="submit" class="btn-success-modal" id="save_brb" disabled>Suspend</button>
                            <button type="submit" class="btn-cancel-modal" id="save_brb" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>