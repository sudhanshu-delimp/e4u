  {{-- Modal: View database Centre --}}
    <div class="modal fade upload-modal" id="view_data_summary" tabindex="-1" aria-labelledby="view_data_summarLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/add-center.png') }}" class="custompopicon"
                            alt="View Centre">
                       Agent Summary - [Territory]
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        
                        <thead class="table-bg">
                            <tr>
                                <th>Deployed</th>
                                <th>Agent</th>
                                <th>Agent ID</th>
                                <th>Agent Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>23-02-2026</td>
                                <td>ABC Pty Ltd</td>
                                <td>A60148</td>
                                <td>
                                    <span class="custom_badge badge_active">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td>01-12-2025</td>
                                <td>XYZ Pty Ltd</td>
                                <td>A60123</td>
                                <td>
                                    <span class="custom_badge badge_active">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td>01-12-2025</td>
                                <td>LMN Pty Ltd</td>
                                <td>A60115</td>
                                <td>
                                    <span class="custom_badge badge_active">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td>01-12-2025</td>
                                <td>EFG Pty Ltd</td>
                                <td>A60095</td>
                                <td>
                                    <span class="custom_badge badge_suspended">Suspended</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn-success-modal">Print</button>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}