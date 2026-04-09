  {{-- Modal: View database Centre --}}
    <div class="modal fade upload-modal" id="renew_discount" tabindex="-1" aria-labelledby="renew_discountLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/refresh.png') }}" class="custompopicon"
                            alt="View Centre">
                     Renew Discount
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                 <form id="renew_discount_form" method="POST" action="{{ route('advertiser.renew_fee_discount') }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="discount">Discount</label>
                                <div class="input-group">
                                    <input type="text" 
                                        class="form-control rounded-0" 
                                        placeholder="Discount"
                                        name="discount">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="end_date">End Date</label>
                                <input type="text" class="form-control rounded-0 js_datepicker min_today" placeholder="End Date"
                                    name="end_date" id="end_date">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <input type="hidden" name="discount_id">
                        <input type="hidden" name="advertiser_id">
                        <button type="submit" class="btn-success-modal">Renew</button>
                        <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end --}}
    @push('script')
    <script>
        $('#renew_discount').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        // set inside modal
        let modal = $(this);
        modal.find('input[name="discount"]').val(button.data('discount_value'));
        modal.find('input[name="discount_id"]').val(button.data('discount_id'));
        modal.find('input[name="advertiser_id"]').val(button.data('user_id'));
        });

    $(document).on('submit', '#renew_discount_form', function (e) {
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
                form[0].reset();
                $("#renew_discount").modal('hide');
                table.draw();
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
        }
    });
});
    </script>
    @endpush