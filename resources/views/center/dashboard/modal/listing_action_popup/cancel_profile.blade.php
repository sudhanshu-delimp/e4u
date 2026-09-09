  
  <div class="modal fade upload-modal" id="cancel_profile_modal_form" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
    aria-modal="true">
  
  

        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 600px;">
            <form id="cancel_form" name="cancel_form" method="post">
                <div class="modal-content">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">
                                <img src="{{ asset('assets/app/img/deactivate.png')}}" class="custompopicon" alt="cross"> Cancel Listing</h5>
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
                                                    id="cancelProfileId" name="cancel_profile_id"
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
                                            <label class="col-sm-3 col-form-label" for="">Credit:</label>
                                            <div class="col-sm-4">
                                                <div class="input-group input-group-sm" style="padding-right: 25px;">
                                                    <span class="input-group-text"
                                                        style="border-radius: 0rem; font-size:0.8rem;padding: 0px 10px;">$</span>
                                                    <span class="form-control" id='cancelCreditCalculationLive'
                                                        style="background-color: #e9ecef; border: 1px solid #ced4da;">0.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    <hr style="background-color: #0C223D" class="mt-4"> 
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                            <div class="col-lg-12">
                                                    <p class="mb-1"><b>Notes:</b></p>
                                                    <ol class="pl-4 text-justify">

                                                        <li> Your nominated Listing will be permanently canceled and removed from the Website.</li>
                                                        <li> Your Profile will be archived.</li>
                                                        <li> You will be credited according to the remaining period for the Listing.</li>
                                                        <li> The Listing is removed from the website, and the Profile moves from Listed Profiles to Archives.&nbsp; The Current Listing is also removed and goes to Past.</li>
                                                    </ol>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="text-align: end; display: block;">
                            <button type="submit" class="btn-success-modal" id="cancel_profile_button">Proceed to Cancel Listing</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>