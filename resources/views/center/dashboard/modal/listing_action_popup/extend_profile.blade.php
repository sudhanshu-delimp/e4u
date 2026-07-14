    <!-- extend profile modal start here -->
    <div class="modal fade upload-modal" id="extend_profile" tabindex="-1" role="dialog" aria-labelledby="extendProfileTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">
                  <img src="{{ asset('/assets/dashboard/img/extend-profile.png') }}" class="custompopicon" alt="extend">
                  Extend Profile
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">
                    <img id="modal_close_extend" src="{{ asset('assets/app/img/newcross.png') }}" class="img_resize_in_smscreen">
                  </span>
                </button>
              </div>
      
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="container p-0">
                        <form action="{{ route('center.extend-profile-checkout')}}" method="POST" id="extend_form">
                            {{ csrf_field() }}
                            <!-- Profile select -->
                            <div class="form-group row">
                                <label class="col-sm-3" for="">Profile:</label>
                                <div class="col-sm-9">
                                <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                        id="extendProfileId"
                                        name="escort_id[]"
                                        data-parsley-errors-container="#extend-profile-errors"
                                        required
                                        data-parsley-required-message="Select Profile">
                                    <option value="">Select Profile</option>
                                     @foreach ($active_profile as $profile)
                                    
                                         @php
                                         $purchase = $profile->latestPurchase;
                                         if($purchase && (!empty($profile->latestExtend)))
                                         continue;
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
                                <span id="extend-profile-errors"></span>
                                </div>
                            </div>
            
                            <!-- Extend Period -->
                            <div class="form-group row extend--profile">
                                <label class="col-sm-3">Extend Period:</label>
                                <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-7">
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input extend-period" type="radio" name="extend_days" id="extendDay1" value="1" disabled>
                                    <label class="form-check-label" for="extendDay1">1 day</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input extend-period" type="radio" name="extend_days" id="extendDay5" value="5" disabled>
                                    <label class="form-check-label" for="extendDay5">5 days</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input extend-period" type="radio" name="extend_days" id="extendDay10" value="10" disabled>
                                    <label class="form-check-label" for="extendDay10">10 days</label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <input type="hidden" name="membership[]" id="extendMembership">
                                    <input type="hidden" name="start_date[]" id="extendStartDate">
                                    <input type="text" id="extendEndDate" class="form-control form-control-sm removebox_shdow js_datepicker" name="end_date[]" required disabled>
                                </div>
                                </div>
                                </div>
                            </div>
            
                            <!-- Fee -->
                            {{-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="">Fee:</label>
                                <div class="col-sm-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" style="border-radius: 0rem; font-size:0.8rem;padding: 0px 10px;">$</span>
                                    <span class="form-control" id="extendFeeLive" style="background-color: #e9ecef; border: 1px solid #ced4da;">0.00</span>
                                </div>
                                </div>
                            </div> --}}
            
                            <hr style="background-color: #0C223D" class="mt-4">
            
                            <!-- Notes -->
                            <div class="form-group row">
                                <div class="col-lg-12">
                                <p class="mb-1"><b>Notes:</b></p>
                                <ol class="pl-4 text-justify">
                                    <li>The Fee is calculated according to the Membership Type.</li>
                                    <li>You agree to your Card being debited the Fee.</li>
                                    <li>Details of this transaction can be viewed in the Transaction Summary.</li>
                                </ol>
                                </div>
                            </div>
                            <div class="modal-footer" style="text-align: right; display: block;">
                                    <button type="button" class="btn-success-modal transaction_summury">Proceed to Payment</button>
                                </div>
                            </form>
                    </div>
                  </div>
                </div>
              </div>
      
              
            </div>
        </div>
      </div>      
  <!-- end extend profile modal -->  