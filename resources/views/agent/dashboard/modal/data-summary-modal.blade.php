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
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Status</th>
                                <td>Active</td>
                            </tr>
                            <tr>
                                <th>Uploaded </th>
                                <td>27-02-2026</td>
                            </tr>
                            <tr>
                                <th>Territory</th>
                                <td>Western Australia</td>
                            </tr>
                            <tr>
                                <th>Centres</th>
                                <td>625</td>
                            </tr>
                            <tr>
                                <th>Mobiles</th>
                                <td>450</td>
                            </tr>
                            <tr>
                                <th>Landlines</th>
                                <td>225</td>
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