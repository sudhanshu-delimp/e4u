<div class="modal fade upload-modal" id="view-centre" style="display: none">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><img src="{{ asset('assets/dashboard/img/verify-image.png') }}"
                        class="custompopicon"> Verification Images - Masseurs 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body" >
               <div class="verify_ing_masseurs">
                  <table class="table w-100 text-center" id="">
                    <thead class="table-bg">
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="viewCentreTableBody">
                        <tr>
                            <td>004</td>
                            <td>18-02-2026</td>
                            <td>Lia</td>
                            <td>Selfie</td>
                            <td>
                                <span class="custom_badge badge_accepted">Verified</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
               </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" >Close</button>
            </div>

        </div>
    </div>
</div>
