  {{-- Modal: View database Centre --}}
    <div class="modal fade upload-modal" id="view_data_center" tabindex="-1" aria-labelledby="view_data_centerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/add-center.png') }}" class="custompopicon"
                            alt="View Centre">
                        Data File Summary
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body" style="max-height: 50vh; overflow-y: auto;">
                        {{-- Loader --}}
                <div id="modal_loader" class="text-center py-5" style="display: none;">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Loading data, please wait...</p>
                </div>

                {{-- Error Message --}}
                <div id="modal_error" class="text-center py-4" style="display: none;">
                    <p class="text-danger"><i class="fas fa-exclamation-circle"></i> Failed to load details.</p>
                </div>
                    <table class="table table-bordered">
                        <tbody id="viewSummeryData">
                            <tr>
                                <th><b>Status</b></th>
                                <td>Active</td>
                            </tr>
                            <tr>
                                <th><b>Uploaded</b></th>
                                <td>27-02-2026</td>
                            </tr>
                            <tr>
                                <th><b>Territory</b></th>
                                <td>Western Australia</td>
                            </tr>
                            <tr>
                                <th><b>Centres</b></th>
                                <td>625</td>
                            </tr>
                            <tr>
                                <th><b>Mobiles</b></th>
                                <td>450</td>
                            </tr>
                            <tr>
                                <th><b>Landlines</b></th>
                                <td>225</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn-success-modal js-pdf" data-pdf-id="">Print</button>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}