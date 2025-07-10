
@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

<style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')

<div class="container-fluid pl-3 pl-lg-5">
    <!--middle content start here-->
        <div class="row">
            <div class="col-md-12">
                <div class="v-main-heading h3" style="display: inline-block;">Agent Request</div>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
            </div>
            <div class="col-md-12 mt-4 mb-5">
                <div class="row collapse" id="notes">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                              <h3 class="NotesHeader"><b>Notes:</b> </h3>
                              <ol>
                                <li>
                                    This form will be pre-populated with your details according to what you have selected in
                                    My Account - <a href="{{ route('centre.notifications-and-features') }}" class="custom_links_design">Notifications & Features</a>.
                                </li>
                                <li>
                                    Complete the form to request a Support Agent for assistance. When completing the form
                                    please ensure all of the details are correct and you have selected the correct option for
                                    communications. Once a Support Agent is appointed, they will remain your Support
                                    Agent for you to <a href="agent-messages" class="custom_links_design">communicate</a> with and address any of your
                                    concerns.
                                </li>
                                  <li>Once the Agent has accepted your request for support, you will receive a confirmation
                                    email.</li>
                              </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <form class=" ">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group w-50">
                                <label for="email"><b>Business Name</b> </label>
                                <input id="name" placeholder="Business Name" name="b_name" type="text" class="form-control" required="">
                            </div>
                            <div class="form-group w-50">
                                <label for="email"><b>Your Address</b> </label>
                                <input id="name" placeholder="Your Address" name="address" type="text" class="form-control" required="">

                            </div>

                            <div class="form-group w-50">
                                <label for="email"><b>Email</b></label>
                                <input id="name" placeholder="Email Address" name="email" type="email" class="form-control" required="">

                            </div>

                            <div class="form-group w-50">
                                <label for="email"><b>Business Number</b> </label>
                                <input id="name" placeholder="Mobile or Business Number" name="b_number" type="number" class="form-control" required="">
                            </div>

                            {{-- <div class="form-group custom-radio mb-0">
                                <label for="email"><b>Contact preference</b> </label><br>
                                <input type="radio" id="html" name="fav_language" value="HTML">
                                <label class="m-0" for="html">Show me Agent list</label><br><input type="radio" id="css" name="fav_language" value="CSS">
                                <label for="css">Have Agent contact me (select method below)</label><br>
                            </div> --}}

                            <div class="form-group">
                                <label for="email"><b>Agent</b></label><br>
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" id="Method_Message" value="option1">
                                    <label class="form-check-label" for="Method_Message">Contact me by email</label>
                                </div>
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" id="Method_Text" value="option1">
                                    <label class="form-check-label" for="Method_Text">Contact me by mobile</label>
                                </div>
                            </div>
                            <div class="form-group w-50">
                                <label for="exampleFormControlTextarea1">
                                    <b>Comments</b> (please provide any additional information to assist us)
                                </label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Up to 300 characters"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Submit Request" class="new-btn-sec btn btn-primary shadow-none" name="submit">
                </form>
            </div>
        </div>
    <!--middle content end here-->
</div>

{{-- <button data-toggle="modal" data-target="#confirmationPopup">test</button> --}}
<div class="modal fade upload-modal" id="confirmationPopup" tabindex="-1" role="dialog" aria-labelledby="confirmationPopup" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="confirmationPopup">Agent Request Submitted</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
             </button>
          </div>
          <div class="modal-body pb-0">
                <div class="row">
                   <div class="col-12 mb-3">
                        <p>Your Request for a Support Agent has been submitted. A Support Agent will be in touch
                            with you according to your preferred method.</p>
                            <p>If a Support Agent has not contacted you within 24 hours, please raise a Support Ticket
                                quoting the following reference: [Reference number from pool].</p>
                   </div>
                </div>
          </div>
          <div class="modal-footer text-center justify-content-center">             
             <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Close</button>
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
