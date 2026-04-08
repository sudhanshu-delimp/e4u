  {{-- Modal: View database Centre --}}
    <div class="modal fade upload-modal" id="confirm" tabindex="-1" aria-labelledby="confirmLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/unblock.png') }}" class="custompopicon"
                            alt="View Centre">
                      Confirm
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body">
                  <h5 class="custom_modal_text">
                    Are You Sure Cancel Current Discount?
                  </h5>
                </div>
                <div class="modal-footer justify-content-center pt-0">
                  <form id="cancel_discount_form" method="POST" action="{{ route('advertiser.cancel_fee_discount') }}">
                    <input type="hidden" name="discount_id">
                    <button type="submit" class="btn-successs-modal">Yes</button>
                    <button class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                  </form>  
                </div>
               
            </div>
        </div>
    </div>
    {{-- end --}}
    @push('script')
    <script>
      $('#confirm').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let modal = $(this);
          modal.find('input[name="discount_id"]').val(button.data('discount_id'));
        });

        $(document).on('submit', '#cancel_discount_form', function (e) {
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
                  $("#confirm").modal('hide');
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
    