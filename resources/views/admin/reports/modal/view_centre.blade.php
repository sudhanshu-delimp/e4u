<div class="modal fade" id="view-centre" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" style="color: white;"><img src="{{ asset('assets/dashboard/img/verify-image.png') }}"
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
                  <table class="table w-100 text-center">
                    <thead class="table-bg">
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>004</td>
                            <td>18-02-2026</td>
                            <td>Lia</td>
                            <td>
                                <span class="custom_badge badge_accepted">Verified image</span>
                            </td>
                        </tr>

                        
                        <tr>
                            <td>002</td>
                            <td>18-02-2026</td>
                            <td>Jane</td>
                            <td>
                                <span class="custom_badge badge_rejected">Rejected image</span>
                            </td>
                        </tr>

                        
                        <tr>
                            <td>003</td>
                            <td>16-02-2026</td>
                            <td>Ming</td>
                            <td>
                                <span class="custom_badge badge_accepted">Verified image</span>
                            </td>
                        </tr>

                        
                        <tr>
                            <td>001</td>
                            <td>31-01-2026</td>
                            <td>Joy</td>
                            <td>
                                <span class="custom_badge badge_pending">Pending image</span>
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
