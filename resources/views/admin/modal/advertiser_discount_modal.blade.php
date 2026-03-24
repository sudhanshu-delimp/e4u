  {{-- Modal: View database Centre --}}
  <div class="modal fade upload-modal" id="advertiser_discount" tabindex="-1" aria-labelledby="renew_discountLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">
                      <img src="{{ asset('assets/dashboard/img/set-commission.png') }}" class="custompopicon"
                          alt="View Centre">
                      Advertiser Discount
                  </h5>
                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                      <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                  </button>
              </div>
              
               
                    <div class="modal-body">
                        <form action="">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="input-group">
                                        <input type="text" 
                                            class="form-control rounded-0" 
                                            placeholder="Member Id" 
                                            name="business_name" style="padding: 22px 10px">
                                        <button class="btn-success-modal rounded-0" type="submit">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            
                            <div class="col-12 mb-3">

                                <table class="table w-100 table-bordered">
                                    <thead class="">
                                        <th><b>Name</b></th>
                                         <th><b>Agent ID</b></th>
                                         <th><b>Home State</b></th>
                                    </thead>
                                    <tbody>
                                        <tr>                                            
                                            <td>Name Kumar</td>
                                            <td>A10203</td>                                            
                                            <td>Uttar Pradesh</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                         <form name="add_agent" method="POST" action="{{ route('staff.add-agent') }}" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6 mb-3">
                                <label for="discount">Discount</label>
                                <div class="input-group">
                                    <input type="text" 
                                        class="form-control rounded-0" 
                                        placeholder="Discount"
                                        name="discount" 
                                        id="discount">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control rounded-0" placeholder="End Date"
                                    name="end_date" id="end_date">
                            </div>
                            </div>
                             <div class="modal-footer d-flex justify-content-end pr-0">
                                <button type="button" class="btn-success-modal">Apply</button>
                                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                            </div>
                         </form>
                    </div>
                   
             
          </div>
      </div>
  </div>
  {{-- end --}}
