@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
        list-style: none;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
        <div class="row">
            <div class="col-md-12">
                <div class="v-main-heading h3" style="display: inline-block;">Add Credit</div>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
            </div>
        </div>

        <div class="row collapse" id="notes">
                            <div class="col-md-12 mb-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                        <ol>
                                            <li>You can select a payment option by clicking the card, or simply insert the amount you want to pay.</li>
                                            <li>SMS 2FA applies to this feature.</li>
                                            <li>You can enable the Auto Recharge feature <a href="#" class="custom_links_design">here</a> as well.</li>
                                            <li>You can view how much credit you have available in the summary below. When creating a Listing or Tour, your available credit will be displayed on the payment page.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
    <!-- Member Details -->
    <div class="mt-5 mb-4 p-3 bg-light rounded">
        <h2 class="h4 mb-4">Member Details</h2>
            <div class="row">
                <div class="col-md-6">
                    <p>Membership ID: <strong>E12345</strong></p>
        <p>Available Credit: <strong>AU$<span id="available-credit">250.00</span></strong></p>
        <p>Average spend per day: <strong>AU$15.00</strong></p>
                </div>
                <div class="col-md-6">  
                <p>Average listing period: <strong>30 days</strong></p>
        <p>Last top up: <strong>01 June 2025</strong></p>
        <p>Average top up: <strong>AU$200.00</strong></p>
                </div>
            </div>
      </div>

  <!-- Top Up Options -->
  <div class="row text-center add--credit">

    <div>
      <div class="card">
        <div class="card-body">
          <img src="{{ asset('assets/app/img/logo.svg') }}" class="img-fluid mb-2" alt="E4U Logo">
          <h5 class="card-title">Top Up Credit</h5>
          <p class="h4 mb-3">AU$100.00</p>
          <button class="save_profile_btn btn-block" onclick="selectAmount(100)">Continue</button>
        </div>
      </div>
    </div>

    <div>
      <div class="card">
        <div class="card-body">
          <img src="{{ asset('assets/app/img/logo.svg') }}" class="img-fluid mb-2" alt="E4U Logo">
          <h5 class="card-title">Top Up Credit</h5>
          <p class="h4 mb-3">AU$250.00</p>
          <button class="save_profile_btn btn-block" onclick="selectAmount(250)">Continue</button>
        </div>
      </div>
    </div>

    <div>
      <div class="card">
        <div class="card-body">
          <img src="{{ asset('assets/app/img/logo.svg') }}" class="img-fluid mb-2" alt="E4U Logo">
          <h5 class="card-title">Top Up Credit</h5>
          <p class="h4 mb-3">AU$500.00</p>
          <button class="save_profile_btn btn-block" onclick="selectAmount(500)">Continue</button>
        </div>
      </div>
    </div>

    <div>
      <div class="card">
        <div class="card-body">
          <img src="{{ asset('assets/app/img/logo.svg') }}" class="img-fluid mb-2" alt="E4U Logo">
          <h5 class="card-title">Top Up Credit</h5>
          <input type="number" class="form-control mb-2" placeholder="Enter Amount" id="customAmount">
          <button class="save_profile_btn btn-block" onclick="customAmountSelected()">Continue</button>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Add Credit to My Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body text-center">
        <div class="spinner-border text-primary my-3" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <p class="lead">You have opted to top up your Account in the amount of <strong>AU$<span id="selectedAmountDisplay"></span></strong>.</p>
        <p>Are you sure that is the correct amount? If the amount is correct click <strong>Proceed</strong> to complete your payment.</p>

        <div class="mt-3 p-2 bg-light rounded">
          <h5>Never Worry About Running Out of Credit</h5>
          <p>Would you like to enable Auto-recharge?</p>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="autoRechargeCheck">
            <label class="form-check-label" for="autoRechargeCheck">Yes</label>
          </div>
          <small class="d-block text-muted mt-2">If enabled, the recharge will occur automatically when balance falls below AU$100.00.</small>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary p-2" data-dismiss="modal">Cancel</button>
        <button type="button" class="nex_sterp_btn btn btn-success p-2" onclick="proceedPayment()">Proceed</button>
      </div>

    </div>
  </div>
</div>

</div>

@endsection
@push('script')
<!-- file upload plugin start here -->



    <!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

<script>
    let selectedAmount = 0;
  
    function selectAmount(amount) {
      selectedAmount = amount;
      document.getElementById('selectedAmountDisplay').innerText = selectedAmount.toFixed(2);
      $('#confirmModal').modal('show');
    }
  
    function customAmountSelected() {
      const input = document.getElementById('customAmount').value;
      if (input && input > 0) {
        selectAmount(Number(input));
      } else {
        alert('Please enter a valid amount.');
      }
    }
  
    function proceedPayment() {
      const autoRecharge = document.getElementById('autoRechargeCheck').checked;
      alert('Payment of AU$' + selectedAmount.toFixed(2) + ' submitted.\nAuto Recharge: ' + (autoRecharge ? 'Enabled' : 'Disabled'));
      $('#confirmModal').modal('hide');
      // Add further integration (2FA, API submission, etc.) here
    }
  </script> 

<script type="text/javascript">

    $('#userProfile').parsley({

    });



    $('#userProfile').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        if (form.parsley().isValid()) {

            var url = form.attr('action');
            var data = new FormData(form[0]);
            $.ajax({
                method: form.attr('method'),
                url: url,
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (!data.error) {
                        $.toast({
                            heading: 'Success',
                            text: 'Details successfully saved',
                            icon: 'success',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });

                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });

                    }
                },

            });
        }
    });
    $('#city').select2({
        allowClear: true,
        placeholder :'Select City',
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: false // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('city.list') }}",
            dataType: "json",
            type: "GET",
            data: function(params) {
                console.log(params);
                var queryParameters = {
                    query: params.term,
                    state_id: $('#state').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });

    $('#state').select2({
        allowClear: true,
        placeholder :'Select State',
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: false // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('state.list') }}",
            dataType: "json",
            type: "GET",
            data: function(params) {
                console.log(params);
                var queryParameters = {
                    query: params.term,
                    country_id: $('#country').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });


    $('#country').on('change', function(e) {
        if($(this).val()) {
            $('#state').prop('disabled', false);
            $('#state').select2('open');
        } else {
            $('#state').prop('disabled', true);
        }
    });

    $('#state').on('change', function(e) {
        if($(this).val()) {
            $('#city').prop('disabled', false);
            $('#city').select2('open');
        } else {
            $('#city').prop('disabled', true);
        }
    });


</script>

@endpush
