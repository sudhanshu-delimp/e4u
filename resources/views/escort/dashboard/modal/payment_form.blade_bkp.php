<div class="modal fade upload-modal" id="process-payment-modal" tabindex="-1" aria-labelledby="renew_discountLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/set-commission.png') }}" class="custompopicon"
                        alt="View Centre">
                        Secure Payment
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('escort.payment.process')}}" class="pin" method="post" id="payment-form">
                    @csrf
                    <div class="errors alert alert-danger" style="display:none">
                      <h5></h5>
                      <ul></ul>
                    </div>
          
                    <!-- Billing -->
                    <h6>Billing Details</h6>
          
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <input id="address-line1" class="form-control" placeholder="Address 1">
                      </div>
                      <div class="form-group col-md-6">
                        <input id="address-line2" class="form-control" placeholder="Address 2">
                      </div>
                    </div>
          
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <input id="address-city" class="form-control" placeholder="City">
                      </div>
                      <div class="form-group col-md-4">
                        <input id="address-state" class="form-control" placeholder="State">
                      </div>
                      <div class="form-group col-md-4">
                        <input id="address-postcode" class="form-control" placeholder="Postcode">
                      </div>
                    </div>
          
                    <div class="form-group">
                      <input id="address-country" class="form-control" placeholder="Country">
                    </div>
          
                    <hr>
          
                    <!-- Card -->
                    <h6>Card Details</h6>
          
                    <div class="form-group">
                      <input id="cc-number" class="form-control" placeholder="Card Number">
                    </div>
          
                    <div class="form-group">
                      <input id="cc-name" class="form-control" placeholder="Name on Card">
                    </div>
          
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <input id="cc-expiry-month" class="form-control" placeholder="MM">
                      </div>
                      <div class="form-group col-md-4">
                        <input id="cc-expiry-year" class="form-control" placeholder="YYYY">
                      </div>
                      <div class="form-group col-md-4">
                        <input id="cc-cvc" class="form-control" placeholder="CVC">
                      </div>
                    </div>
          
                    <button type="submit" class="btn btn-success btn-block">
                      Pay Now
                    </button>
          
                  </form>
            </div>
        </div>
    </div>
</div>
  {{-- end --}}
  @push('script')
  <script src='https://cdn.pinpayments.com/pin.v2.js'></script>
  <script>
    $(function() {
    
    var pinApi = new Pin.Api('{{config("app.payment.publish_key")}}', 'test');
    
    var form = $('form.pin'),
        submitButton = form.find(":submit"),
        errorContainer = form.find('.errors'),
        errorList = errorContainer.find('ul'),
        errorHeading = errorContainer.find('h3');
    
    form.submit(function(e) {
      e.preventDefault();
    
      errorList.empty();
      errorHeading.empty();
      errorContainer.hide();
    
      submitButton.attr({disabled: true});
    
      var card = {
        number:           $('#cc-number').val(),
        name:             $('#cc-name').val(),
        expiry_month:     $('#cc-expiry-month').val(),
        expiry_year:      $('#cc-expiry-year').val(),
        cvc:              $('#cc-cvc').val(),
        address_line1:    $('#address-line1').val(),
        address_line2:    $('#address-line2').val(),
        address_city:     $('#address-city').val(),
        address_state:    $('#address-state').val(),
        address_postcode: $('#address-postcode').val(),
        address_country:  $('#address-country').val()
      };
    
      pinApi.createCardToken(card).then(handleSuccess, handleError).done();
    });
    
    function handleSuccess(card) {
      $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: {
          _token: '{{ csrf_token() }}',
          pin_token: card.token
        },
        success: function(response) {
        console.log(response);
          submitButton.removeAttr('disabled');
    
          // success UI
          errorContainer
            .removeClass('alert-danger')
            .addClass('alert-success')
            .show();
    
          errorHeading.text('Payment Successful');
          errorList.html('<li>' + response.message + '</li>');
          if(response.redirect_url){
            location.assign(response.redirect_url);
          }
    
          // close modal after delay
          setTimeout(function() {
            $('#paymentModal').modal('hide');
          }, 1500);
        },
        error: function(xhr) {
    
          submitButton.removeAttr('disabled');
    
          let res = xhr.responseJSON;
    
          errorContainer
            .removeClass('alert-success')
            .addClass('alert-danger')
            .show();
    
          errorHeading.text('Payment Failed');
    
          errorList.empty();
    
          if (res && res.message) {
            $('<li>').text(res.message).appendTo(errorList);
          } else {
            $('<li>').text('Something went wrong').appendTo(errorList);
          }
        }
      });
    }
    
    function handleError(response) {
    
      errorHeading.text(response.error_description);
    
      if (response.messages) {
        $.each(response.messages, function(index, paramError) {
          $('<li>')
            .text(paramError.param + ": " + paramError.message)
            .appendTo(errorList);
        });
      }
    
      errorContainer
        .removeClass('alert-success')
        .addClass('alert-danger')
        .show();
    
      submitButton.removeAttr('disabled');
    }
    
    });
    </script>
  @endpush 