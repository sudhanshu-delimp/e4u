{{-- Modal: View database Centre --}}
<div class="modal fade upload-modal" id="view_data_summary" tabindex="-1" aria-labelledby="view_data_summarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/add-center.png') }}" class="custompopicon"
                        alt="View Centre">
                    Agent Summary - <span id="modal_territory_name">[Territory]</span>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </button>
            </div>

            <div class="modal-body">

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

                {{-- Table --}}
                <div id="modal_table_wrapper">
                    <table class="table table-bordered">
                        <thead class="table-bg">
                            <tr>
                                <th>Deployed</th>
                                <th>Agent</th>
                                <th>Agent ID</th>
                                <th>Agent Status</th>
                            </tr>
                        </thead>
                        <tbody id="modal_table_body">
                          
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="modal-footer d-flex justify-content-end">
                <button type="submit" id="pdf-download" data-pdf-id="" class="btn-success-modal">Print</button>
                <button type="button"   class="btn-cancel-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- end --}}