 <!-- edit shareholder popupform -->
        <div class="modal fade upload-modal" id="editShareholder" tabindex="-1" role="dialog"
            aria-labelledby="editShareholderLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editShareholderTitle"><img
                                src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon"> Edit Shareholder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="add_shareholder" id="add_shareholder" method="POST"
                     action="{{ route('admin.store-shareholder') }}" enctype="multipart/form-data">
                     <div class="row">
                         <!-- Section: Personal Details -->
                         <div class="col-12 my-2">
                             <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                         </div>

                         <div class="col-6 mb-3">
                             <input type="hidden" name="user_id" id="user_id_edit">
                             <label class="form-check-label" for="name">Shareholder</label>
                             <input type="text" class="form-control rounded-0" name="business_name"
                                 id="business_name_edit">
                             <span class="text-danger error-business_name"></span>
                         </div>
                         <div class="col-6 mb-3">
                             <label class="form-check-label" for="business_address">Address</label>
                             <input type="text" class="form-control rounded-0" name="business_address"
                                 id="business_address_edit">
                             <span class="text-danger error-business_address"></span>
                         </div>
                         <div class="col-6 mb-3">
                             <label class="form-check-label" for="contact">Contact</label>
                             <input type="tel" maxlength="100" autocomplete="off" class="form-control rounded-0"
                                 name="contact_person" id="contact_person_edit">
                             <span class="text-danger error-contact_person"></span>
                         </div>
                         <div class="col-6 mb-3">
                             <label class="form-check-label" for="phone">Mobile</label>
                             <input type="tel" maxlength="10" autocomplete="off" class="form-control rounded-0"
                                 name="phone" id="phone_edit" oninput="this.value = this.value.replace(/\D/g,'');">
                             <span class="text-danger error-phone"></span>
                         </div>
                         <div class="col-6 mb-3">
                             <label class="form-check-label" for="email_edit">Email</label>
                             <input type="email" class="form-control rounded-0" name="email" id="email_edit">
                             <span class="text-danger error-email"></span>
                         </div>

                         <div class="col-12 mb-3">
                             <h6 class="border-bottom pb-1 text-blue-primary">Method of Contact:</h6>
                             <div class="d-flex align-items-center justify-content-start gap-10 flex-wrap">

                                 {{-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_1"
                                        name="contact_type[]" value="1">
                                    <label class="form-check-label" for="viewer_contact_type_1">Messaging</label>
                                </div> --}}
                                 <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="checkbox" id="viewer_contact_type_2_edit"
                                         name="contact_type[]" value="2">
                                     <label class="form-check-label" for="viewer_contact_type_2">Text</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="checkbox" id="viewer_contact_type_3_edit"
                                         name="contact_type[]" value="3">
                                     <label class="form-check-label" for="viewer_contact_type_3">Email</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="checkbox" id="viewer_contact_type_4_edit"
                                         name="contact_type[]" value="4">
                                     <label class="form-check-label" for="viewer_contact_type_4">Call Us</label>
                                 </div>

                             </div>
                             <span class="text-danger error-contact_type"></span>
                         </div>
                         <div class="col-12">

                             <div class="form-group">
                                 <h6 class="border-bottom pb-1 text-blue-primary">Idle Time Preference</h6>

                                 <div class="form-check form-check-inline ml-0">
                                     <input class="form-check-input" type="radio" name="idle_preference_time"
                                         id="idle_preference_time_15_edit" value="15">
                                     <label class="form-check-label" for="idle_preference_time_15_edit">15
                                         minutes</label>
                                 </div>

                                 <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="radio" name="idle_preference_time"
                                         id="idle_preference_time_30_edit" value="30">

                                     <label class="form-check-label" for="idle_preference_time_30_edit">30
                                         minutes</label>
                                 </div>

                                 <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="radio" name="idle_preference_time"
                                         id="idle_preference_time_60" value="60" checked>
                                     <label class="form-check-label" for="idle_preference_time_60">60
                                         minutes</label>
                                 </div>

                                 <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="radio" name="idle_preference_time"
                                         id="idle_preference_time_never_edit"
                                         value="{{ config('staff.idle_vever_minute') }}">
                                     <label class="form-check-label" for="idle_preference_time_never_edit">Never</label>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <h6 class="border-bottom pb-1 text-blue-primary">2FA Authentication</h6>

                                 <div class="form-check form-check-inline ml-0">
                                     <input class="form-check-input" type="radio" name="twofa" id="twofa_1_edit"
                                         value="1">
                                     <label class="form-check-label" for="twofa_1_edit">Email</label>
                                 </div>

                                 <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="radio" name="twofa" id="twofa_2_edit"
                                         value="2" checked>

                                     <label class="form-check-label" for="twofa_2_edit">Text</label>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="modal-footer p-0">
                         <button type="submit" class="btn-success-modal mr-3">Update</button>
                     </div>
                 </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end -->