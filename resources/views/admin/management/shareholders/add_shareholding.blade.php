 <!-- add new shareholder popupform -->
 <div class="modal fade upload-modal" id="addShareholder" tabindex="-1" role="dialog" aria-labelledby="addShareholderLabel"
     aria-hidden="true" data-keyboard="false" data-backdrop="static">
     <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addShareholderTitle"><img
                         src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon"> Add New
                     Shareholding</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                             class="img-fluid img_resize_in_smscreen"></span>
                 </button>
             </div>
             <div class="modal-body">
                 <form name="add_shareholding" id="add_shareholding" method="POST"
                     action="{{ route('admin.add.shareholding') }}" enctype="multipart/form-data">
                     <div class="modal-body">
                         <div class="row">

                             <!-- Section: Shareholder Details -->
                             <div class="col-12 mb-3">
                                 <h6 class="border-bottom pb-1 text-blue-primary">Shareholder Details</h6>
                             </div>

                             <!-- Dropdown -->
                             <div class="col-12 mb-3">
                                 <label for="shareholder_id">Select Shareholder</label>
                                 <select name="shareholder_id" id="shareholder_id" class="form-control rounded-0">
                                     <option value="">Select Shareholder</option>
                                     @foreach ($shareholders as $share)
                                         <option value="{{ $share->id }}" data-name="{{ $share->business_name }}"
                                             data-memberid="{{ $share->member_id }}">{{ $share->business_name }}
                                         </option>
                                     @endforeach

                                 </select>
                                 <span class="text-danger error-shareholder_id"></span>
                             </div>

                             <!-- Shareholder Name -->
                             <div class="col-md-6 mb-3">
                                 <label for="name">Shareholder</label>
                                 <input type="text" class="form-control rounded-0 bg-light" name="name"
                                     id="name" readonly>
                                 <span class="text-danger error-name"></span>
                             </div>

                             <!-- Member ID -->
                             <div class="col-md-6 mb-3">
                                 <label for="member_id">Member ID</label>
                                 <input type="text" class="form-control rounded-0 bg-light" name="member_id"
                                     id="member_id" readonly>
                                 <span class="text-danger error-member_id"></span>
                             </div>

                             <!-- Date of Entry -->
                             <div class="col-md-6 mb-3">
                                 <label for="date_of_entry">Date of Entry</label>
                                 <input type="text" class="form-control rounded-0 js_datepicker" name="date_of_entry"
                                     id="date_of_entry">
                                 <span class="text-danger error-date_of_entry"></span>
                             </div>

                             <!-- Membership Type -->
                             <div class="col-md-6 mb-3">
                                 <label for="membership_type">Membership Type</label>
                                 <select class="form-control rounded-0" name="member_type" id="membership_type">
                                     <option value="">Select Membership Type</option>
                                     @foreach (config('common.membership_type') as $key => $typeName)
                                         <option value="{{ $key }}">{{ $typeName }}</option>
                                     @endforeach
                                 </select>
                                 <span class="text-danger error-member_type"></span>
                             </div>

                             <!-- Threshold -->
                             <div class="col-md-6 mb-3">
                                 <label>Threshold</label>
                                 <div>
                                     <div class="form-check form-check-inline ml-0">
                                         <input class="form-check-input" type="radio" name="threshold"
                                             id="threshold_yes" value="yes">
                                         <label class="form-check-label" for="threshold_yes">Yes</label>
                                     </div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="radio" name="threshold"
                                             id="threshold_no" value="no" checked>
                                         <label class="form-check-label" for="threshold_no">No</label>
                                     </div>
                                 </div>
                                 <span class="text-danger error-threshold"></span>
                             </div>

                             <!-- Number of Shares -->
                             <div class="col-md-6 mb-3">
                                 <label for="number_of_shares">Number of Shares</label>
                                 <input type="text" autocomplete="off" class="form-control rounded-0"
                                     name="number_of_shares" id="number_of_shares"
                                     oninput="this.value = this.value.replace(/[^0-9]/g,'');">
                                 <span class="text-danger error-number_of_shares"></span>
                             </div>

                             <!-- Shareholding -->
                             <div class="col-md-6 mb-3">
                                 <label for="shareholding">Shareholding</label>
                                 <div class="input-group">
                                     <input type="text" class="form-control rounded-0" name="shareholding"
                                         id="shareholding" placeholder="e.g. 25"
                                         oninput="this.value = this.value.replace(/[^0-9]/g,'');">
                                     <span class="input-group-text rounded-0">%</span>
                                 </div>
                                 <span class="text-danger error-shareholding"></span>
                             </div>

                             <!-- Beneficial Status -->
                             <div class="col-12 mt-3 mb-3">
                                 <h6 class="border-bottom pb-1 text-blue-primary">Beneficial Status</h6>
                             </div>

                             <!-- Held on Trust -->
                             <div class="col-md-6 mb-3">
                                 <label>Held on Trust</label>
                                 <div>
                                     <div class="form-check form-check-inline ml-0">
                                         <input class="form-check-input" type="radio" name="held_on_trust"
                                             id="held_on_trust_yes" value="yes">
                                         <label class="form-check-label" for="held_on_trust_yes">Yes</label>
                                     </div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="radio" name="held_on_trust"
                                             id="held_on_trust_no" value="no" checked>
                                         <label class="form-check-label" for="held_on_trust_no">No</label>
                                     </div>
                                     <span class="text-danger error-held_on_trust"></span>
                                 </div>
                             </div>

                             <!-- Trustee -->
                             <div class="row col-md-12 mb-3 trust-fields d-none">
                                 {{--  <label for="trustee">Upload Trust Deed <a href="#"
                                         class="custom_links_design" data-target="#trust_deed_modal"
                                         data-toggle="modal">here</a>.</label> --}}
                                 <div class="col-3">
                                     <label for="trustee">Upload Trust Deed: </label>
                                 </div>
                                 <div class="col-9">
                                     <input type="file" name="trust_deed_file" id="trust_deed_file">
                                 </div>
                                 <span class="text-danger error-trust_deed_file"></span>
                             </div>
                         </div>
                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn-success-modal">Save</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- end -->
