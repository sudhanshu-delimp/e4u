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
                        <form id="advertiserForm" action="{{ route('advertiser.detail') }}" method="POST">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="input-group">
                                        <input type="text" 
                                            class="form-control rounded-0" 
                                            placeholder="Member Id" 
                                            name="keyword" style="padding: 22px 10px">
                                        <button class="btn-success-modal rounded-0" type="submit">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            
                            <div class="col-12 mb-3">

                                <table class="table w-100 table-bordered advertiserDetail">
                                    <thead class="">
                                        <th><b>Name</b></th>
                                         <th><b>Agent ID</b></th>
                                         <th><b>Home State</b></th>
                                    </thead>
                                    <tbody>
                                        <tr>                                            
                                            <td id="advertiser_name">N/A</td>
                                            <td id="agent_member_id">N/A</td>                                            
                                            <td id="advertiser_state">N/A</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                         <form id="apply_fee_discount" method="POST" action="{{ route('advertiser.apply_fee_discount') }}" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6 mb-3">
                                <label for="discount">Discount</label>
                                <div class="input-group">
                                    <input type="text" 
                                        class="form-control rounded-0 only_digits" 
                                        placeholder="Discount"
                                        name="discount" 
                                        id="discount">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="end_date">End Date</label>
                                <input type="text" class="form-control rounded-0 js_datepicker min_today" placeholder="End Date"
                                    name="end_date" id="fee_discount_end_date">
                            </div>
                            </div>
                             <div class="modal-footer d-flex justify-content-end pr-0">
                                <input type="hidden" name="advertiser_id">
                                <button type="submit" class="btn-success-modal">Apply</button>
                                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                            </div>
                         </form>
                    </div>
                   
             
          </div>
      </div>
  </div>
  {{-- end --}}
  @push('script')
  <script>

$(document).on('submit', '#advertiserForm', function (e) {
    e.preventDefault();

    let form = $(this);
    let url = form.attr('action');   // ✅ GET URL FROM FORM
    let formData = form.serialize(); // includes id + _token (if present)

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,

        beforeSend: function () {
            Swal.fire({
                title: 'Please wait...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        },

        success: function (res, textStatus, xhr) {
            Swal.close();
            let option = getStatusOption(xhr);
            if (res.status) {
                $('#advertiser_name').text(res.data.name);
                $('#agent_member_id').text(res.data.my_agent.member_id);
                $('#advertiser_state').text(res.data.state.name);
                $("input[name='advertiser_id']").val(res.data.id);
            } else {
                Swal.fire({
                    icon: option.icon,
                    title: option.title,
                    text: option.message
                });
            }
        },

        error: function (xhr) {
            Swal.close();
            let res = xhr.responseJSON;
            let message = res?.message || 'Something went wrong';
            let option = getStatusOption(xhr);
            Swal.fire({
                icon: option.icon,
                title: option.title,
                text: option.message
            });

            $('.advertiserDetail td').text('N/A');
           
        }
    });
});

$(document).on('submit', '#apply_fee_discount', function (e) {
    e.preventDefault();

    let form = $(this);
    let url = form.attr('action');   // ✅ GET URL FROM FORM
    let formData = form.serialize(); // includes id + _token (if present)

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,

        beforeSend: function () {
            Swal.fire({
                title: 'Please wait...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        },

        success: function (res, textStatus, xhr) {
            Swal.close();
            let option = getStatusOption(xhr);
            if (res.status) {
                
            }

            Swal.fire({
                icon: option.icon,
                title: option.title,
                text: option.message
            });
        },

        error: function (xhr) {
            Swal.close();
            let option = getStatusOption(xhr);
            Swal.fire({
                icon: option.icon,
                title: option.title,
                text: option.message
            });

            $('.advertiserDetail td').text('N/A');
           
        }
    });
});
  </script>
  @endpush 