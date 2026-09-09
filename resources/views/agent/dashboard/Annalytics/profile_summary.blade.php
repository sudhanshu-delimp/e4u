  <div class="modal fade upload-modal bd-example-modal-lg" id="profile_summary" tabindex="-1" role="dialog"
        aria-labelledby="profile_summaryLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profile_summary"><img
                            src="{{ asset('assets/dashboard/img/profile-summary.png') }}" class="custompopicon">Profile
                        Summary - E60165</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive profile_summary">
                        <table cellpadding="8" cellspacing="0" width="100%"
                            style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">

                            <thead>
                                <!-- Table Headings -->
                                <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                                    <td style="text-align:center;">Masseur ID</td>
                                    <td style="text-align:center;">Start Date</td>
                                    <td style="text-align:center;">Finish Date</td>
                                    <td style="text-align:center;">Days</td>
                                    <td style="text-align:center; width:110px">Listing Fee</td>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- Main Row -->
                                <tr>
                                    <td style="text-align:center; font-weight:bold;"></td>
                                    <td style="text-align:center;">01-01-2025</td>
                                    <td style="text-align:center;">15-04-2025</td>
                                    <td style="text-align:center;">104</td>
                                    <td style="text-align:right;"><div class="num_value">$<span>3,120.00 </span></div></td>
                                </tr>

                                <!-- Sub Rows -->
                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">001</td>
                                    <td style="text-align:center;">01-01-2025</td>
                                    <td style="text-align:center;">28-01-2025</td>
                                    <td style="text-align:center;">15</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td style="text-align:center;">002</td>
                                    <td style="text-align:center;">29-01-2025</td>
                                    <td style="text-align:center;">23-02-2025</td>
                                    <td style="text-align:center;">26</td>
                                    <td></td>
                                </tr>

                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">003</td>
                                    <td style="text-align:center;">29-01-2025</td>
                                    <td style="text-align:center;">23-02-2025</td>
                                    <td style="text-align:center;">26</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td style="text-align:center;">004</td>
                                    <td style="text-align:center;">24-02-2025</td>
                                    <td style="text-align:center;">05-03-2025</td>
                                    <td style="text-align:center;">10</td>
                                    <td></td>
                                </tr>

                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">005</td>
                                    <td style="text-align:center;">06-03-2025</td>
                                    <td style="text-align:center;">31-03-2025</td>
                                    <td style="text-align:center;">26</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td style="text-align:center;">006</td>
                                    <td style="text-align:center;">01-04-2025</td>
                                    <td style="text-align:center;">15-04-2025</td>
                                    <td style="text-align:center;">15</td>
                                    <td></td>
                                </tr>

                                <!-- Footer -->
                                <tr style="font-weight:bold;">
                                    <td colspan="3" style="text-align:right;">Total days Masseurs:</td>
                                    <td style="text-align:center;">104</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer justify-content-end mt-3">
                        
                        <button type="button" class="btn-cancel-modal" id="save_change">Print</button>
                        <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                            id="close_change">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>