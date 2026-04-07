 <!-- add new shareholder popupform -->
        <div class="modal fade upload-modal" id="addShareholder" tabindex="-1" role="dialog"
            aria-labelledby="addShareholderLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addShareholderTitle"><img
                                src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon"> Add New Shareholding</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="shareholderDetailsForm">
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
                                <option value="1" data-name="John Doe" data-memberid="MEM001">John Doe</option>
                                <option value="2" data-name="Jane Smith" data-memberid="MEM002">Jane Smith</option>
                                <option value="3" data-name="Michael Johnson" data-memberid="MEM003">Michael Johnson</option>
                                <option value="4" data-name="Emily Davis" data-memberid="MEM004">Emily Davis</option>
                                <option value="5" data-name="David Wilson" data-memberid="MEM005">David Wilson</option>
                            </select>
                            <span class="text-danger error-shareholder_id"></span>
                        </div>

                        <!-- Shareholder Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name">Shareholder</label>
                            <input type="text" class="form-control rounded-0 bg-light" name="name" id="name" readonly>
                            <span class="text-danger error-name"></span>
                        </div>

                        <!-- Member ID -->
                        <div class="col-md-6 mb-3">
                            <label for="member_id">Member ID</label>
                            <input type="text" class="form-control rounded-0 bg-light" name="member_id" id="member_id" readonly>
                            <span class="text-danger error-member_id"></span>
                        </div>

                        <!-- Date of Entry -->
                        <div class="col-md-6 mb-3">
                            <label for="date_of_entry">Date of Entry</label>
                            <input type="date" class="form-control rounded-0" name="date_of_entry" id="date_of_entry">
                            <span class="text-danger error-date_of_entry"></span>
                        </div>

                        <!-- Membership Type -->
                        <div class="col-md-6 mb-3">
                            <label for="membership_type">Membership Type</label>
                            <select class="form-control rounded-0" name="membership_type" id="membership_type">
                                <option value="">Select Membership Type</option>
                                <option value="Ordinary">Ordinary</option>
                                <option value="Corporate">Corporate</option>
                                <option value="Associate">Associate</option>
                            </select>
                            <span class="text-danger error-membership_type"></span>
                        </div>

                        <!-- Threshold -->
                        <div class="col-md-6 mb-3">
                            <label>Threshold</label>
                            <div>
                                <div class="form-check form-check-inline ml-0">
                                    <input class="form-check-input" type="radio" name="threshold" id="threshold_yes" value="Yes" >
                                    <label class="form-check-label" for="threshold_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="threshold" id="threshold_no" value="No" checked>
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
                                <input type="text" class="form-control rounded-0" name="shareholding" id="shareholding" placeholder="e.g. 25"  oninput="this.value = this.value.replace(/[^0-9]/g,'');">
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
                                    <input class="form-check-input" type="radio" name="held_on_trust" id="held_on_trust_yes" value="Yes">
                                    <label class="form-check-label" for="held_on_trust_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="held_on_trust" id="held_on_trust_no" value="No" checked>
                                    <label class="form-check-label" for="held_on_trust_no">No</label>
                                </div>
                            </div>
                        </div>

                        <!-- Trustee -->
                        <div class="col-md-12 mb-3 trust-fields d-none">
                            <label for="trustee">Upload Trust Deed <a href="#" class="custom_links_design" data-target="#trust_deed_modal" data-toggle="modal">here</a>.</label>
                           
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