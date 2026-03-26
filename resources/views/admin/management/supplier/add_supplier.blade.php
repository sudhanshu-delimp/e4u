 <form name="add_supplier" id="add_supplier" method="POST" action="{{ route('admin.add.supplier') }}"
     enctype="multipart/form-data">
     <div class="row">
         <!-- Section: Personal Details -->
         <div class="col-12 my-2">
             <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
         </div>
         <div class="col-6 mb-3">
             <label for="merchant_id">Merchant ID</label>
             <input type="text" class="form-control rounded-0" name="merchant_id" id="merchant_id" readonly>
             <span class="text-danger error-merchant_id"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="date_appointed">Date Appointed</label>
             <input type="text" class="form-control rounded-0" name="date_appointed" id="date_appointed" readonly>
             <span class="text-danger error-date_appointed"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="business_name">Business Name</label>
             <input type="text" class="form-control rounded-0" name="business_name" id="business_name">
             <span class="text-danger error-business_name"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="abn">ABN</label>
             <input type="text" class="form-control rounded-0" name="abn" id="abn">
             <span class="text-danger error-abn"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="business_address">Business Address</label>
             <input type="text" class="form-control rounded-0" name="business_address" id="business_address">
             <span class="text-danger error-business_address"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="business_number">Business Number</label>
             <input type="text" class="form-control rounded-0" name="business_number" id="business_number">
             <span class="text-danger error-business_number"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="point_of_contact">Point of Contact</label>
             <input type="text" class="form-control rounded-0" name="point_of_contact" id="point_of_contact">
             <span class="text-danger error-point_of_contact"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="phone">Mobile</label>
             <input type="text" class="form-control rounded-0" name="phone" id="phone">
             <span class="text-danger error-phone"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="email">Private Email</label>
             <input type="email" class="form-control rounded-0" name="email" id="email">
             <span class="text-danger error-email"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="location">Location</label>
             <select class="form-control rounded-0" name="location" id="location">
                 <option value="">Select Location</option>
                 @foreach (config('escorts.profile.states') as $skey => $state)
                     <option value="{{ $skey }}">{{ $state['stateName'] }}</option>
                 @endforeach
             </select>
             <span class="text-danger error-location"></span>
         </div>
         <div class="col-12 mb-3">
             <label for="concierge_service">Concierge Service</label>
             <select class="form-control rounded-0" name="concierge_service" id="concierge_service">
                 <option value="">Select Service</option>
                 <option value="email">Email</option>
                 <option value="product">Product</option>
                 <option value="sim">SIM</option>
             </select>
             <span class="text-danger error-concierge_service"></span>
         </div>
         <!-- Section: Agreement Details -->
         <div class="col-12 my-2">
             <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
         </div>
         <div class="col-6 mb-3">
             <label for="agreement_date">Agreement Date</label>
             <input type="text" class="form-control rounded-0 js_datepicker" name="agreement_date" id="agreement_date">
             <span class="text-danger error-agreement_date"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="term">Term</label>
             <input type="text" class="form-control rounded-0" name="term" id="term">
             <span class="text-danger error-term"></span>
         </div>
         <!-- Section: Bank Account -->
         <div class="col-12 my-2">
             <h6 class="border-bottom pb-1 text-blue-primary">Bank Account</h6>
         </div>
         <div class="col-6 mb-3">
             <label for="bank">Bank</label>
             <input type="text" class="form-control rounded-0" name="bank" id="bank">
             <span class="text-danger error-bank"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="account_name">Account Name</label>
             <input type="text" class="form-control rounded-0" name="account_name" id="account_name">
             <span class="text-danger error-account_name"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="bsb">BSB</label>
             <input type="text" class="form-control rounded-0" name="bsb" id="bsb">
             <span class="text-danger error-bsb"></span>
         </div>
         <div class="col-6 mb-3">
             <label for="account_number">Account Number</label>
             <input type="text" class="form-control rounded-0" name="account_number" id="account_number">
             <span class="text-danger error-account_number"></span>
         </div>
     </div>
     <div class="modal-footer px-0">
         <button type="submit" class="btn-success-modal">Save</button>
     </div>
 </form>
