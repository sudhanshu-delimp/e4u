 {{-- View Modal --}}
    <div class="modal fade upload-modal bd-example-modal-lg" id="view_report" tabindex="-1" role="dialog"
        aria-labelledby="view_reportLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title"><img
                            src="{{ asset('assets/dashboard/img/docs.png') }}" class="custompopicon"><span>Massage
                        Centre Report</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="report_container">

                            <div class="header">
                                <h3>Merged Documents Ready</h3>
                                <p>Document 2 (Multiple) — 5 personalized documents ready</p>
                            </div>

                            <!-- Select All -->
                            <div class="select-all">
                                <label style="cursor:pointer;">
                                    <input type="checkbox" id="selectAll">
                                    Select All
                                </label>
                                </div>

                            <!-- List Items -->
                            <div class="item">
                                <div class="left">
                                <input type="checkbox" class="itemCheckbox">
                                <div>
                                    <strong>Body Heat Massage</strong><br>
                                    <small>62 Gordon Rd East Osborne Park</small>
                                </div>
                                </div>

                                <div class="action_btn">
                                <button>Print</button>
                                {{-- <button>Save</button> --}}
                                <button>Email</button>
                                </div>
                            </div>

                            <div class="item">
                                <div class="left">
                                <input type="checkbox" class="itemCheckbox">
                                <div>
                                    <strong>Healthland</strong><br>
                                    <small>510 Murray St Perth</small>
                                </div>
                                </div>

                                <div class="action_btn">
                                <button>Print</button>
                                {{-- <button>Save</button> --}}
                                <button>Email</button>
                                </div>
                            </div>

                            <div class="item">
                                <div class="left">
                                <input type="checkbox" class="itemCheckbox">
                                <div>
                                    <strong>Zen Massage Centre</strong><br>
                                    <small>88 William St Perth</small>
                                </div>
                                </div>

                                <div class="action_btn">
                                <button>Print</button>
                                {{-- <button>Save</button> --}}
                                <button>Email</button>
                                </div>
                            </div>

                            <div class="item">
                                <div class="left">
                                <input type="checkbox" class="itemCheckbox">
                                <div>
                                    <strong>Baba Ram Dev Centre</strong><br>
                                    <small>88 William St Perth</small>
                                </div>
                                </div>

                                <div class="action_btn">
                                <button>Print</button>
                                {{-- <button>Save</button> --}}
                                <button>Email</button>
                                </div>
                            </div>
                        </div>           
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end gap-10">
                         <button type="button" class="btn-success-modal">Print</button>
                         <button type="button" class="btn-success-modal">Save</button>
                         <button type="button" class="btn-success-modal">Email</button>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}