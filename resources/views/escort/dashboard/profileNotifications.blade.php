@extends('layouts.escort')
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
                <div class="v-main-heading h3" style="display: inline-block;">Notifications & Features</div>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
            </div>
            <div class="col-md-12 mt-4" id="profile_and_tour_options">
                <div class="card collapse  mb-4" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Use this feature to enable and disable your notification and feature
                                preferences.</li>
                            <li>Please note that for a Viewer or Agent to receive your Notifications, the
                                Viewer or Agent has to have enabled the corresponding feature in their preference settings.</li>
                        </ol>
                    </div>
                </div>

                <form class="v-form-design" id="profile_notification_options" action="{{ route('escort.notification.update')}}" method="POST">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="email">Features <!-- (enabled by default) --></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="Method_Message" value="option1" checked>
                            <label class="form-check-label" for="Method_Message">Viewer notifications, forward V-Alerts</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Method_Text" value="option1" checked>
                            <label class="form-check-label" for="Method_Text">Allow Viewers to ask you a question</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Method_Email" value="option1" checked>
                            <label class="form-check-label" for="Method_Email">Allow Viewers to send you a text message</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input akhplaymate" name="playmate" type="checkbox" id="method_Email_dummy" value="1" {{auth()->user()->available_playmate == 1 ? 'checked' : ''}} >
                            <label class="form-check-label " for="Method_Email">I'm available as a playmate</label>
                        </div>
                        <div class="pt-1"><i>Some features are enabled by default unless you disable them.</i></div>
                        </div>
                        <div class="form-group">
                        <label for="email">Agent</label><br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agent_communications1" value="1"  name="agent_communications[]" @if(!empty(auth()->user()->agent_communications)) {{(in_array(1 , auth()->user()->agent_communications)) ? 'checked' : null }} @endif >
                            <label class="form-check-label" for="agent_communications1">Receive communications</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agent_communications2" value="2" name="agent_communications[]" @if(!empty(auth()->user()->agent_communications)) {{(in_array(2 , auth()->user()->agent_communications)) ? 'checked' : null }} @endif >
                            <label class="form-check-label" for="agent_communications2">Send communications</label>
                        </div>
                        <div class="pt-1"><i>Enable communications between you and your Escort Agency (if applicable).</i></div>
                        </div>
                        <div class="form-group">
                        <label for="email">Alert notifications</label><br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="alert_notifications[]" id="Method_Message" value="1" @if(!empty(auth()->user()->alert_notifications)) {{(in_array(1 , auth()->user()->alert_notifications)) ? 'checked' : null }} @endif>
                            <label class="form-check-label" for="Method_Message">Email (A-Alert)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="alert_notifications[]" type="checkbox" id="Method_Text" value="2"  @if(!empty(auth()->user()->alert_notifications)) {{(in_array(2 , auth()->user()->alert_notifications)) ? 'checked' : null }} @endif>
                            <label class="form-check-label" for="Method_Text">Text</label>
                        </div>
                        <div class="pt-1"><i>How Escorts4U will communicate with you.</i></div>
                        </div>
                    </div>
                    </div>
                    <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit">
              </form>
            </div>
        </div>
    <!--middle content end here-->
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



    $('#method_Email_dummy').on('click', function(e) {
        var id = $(this).val();

        // var url = "{{ route('escort.playmate.check') }}";

       var url = "{{ route('escort.playmate.check') }}";
        if($(this).is(":checked") == true)
        {
            console.log("true");

            //             $.post(url, function(response){
            //       alert("success");
            //     //   $("#mypar").html(response.amount);
            // });



            // console.log('jshjsj', url);

            $.post(
                    url,

                    {
                        available_playmate: id,

                        //membership: membership,

                    }
                    //headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                ).done(function (data) {
                    console.log(data);
                }).error(function(err){
                    console.log(err)
                });

        }
        if($(this).is(":checked") == false)
        {

            console.log("false");
            console.log(url);
            $.post(
                    url,
                     {
                        available_playmate: null,

                        //membership: membership,

                    },
                    //headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
            ).done(function (data) {
                console.log(data);
            }).error(function(err){
                console.log(err)
            });
        }

    });

    $('#profile_notification_options').on('submit', function(e) {
      e.preventDefault();
         $("#modal-title").text('Notifications & Features');
        var form = $(this);
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
              $('.comman_msg').html("Saved");
              //$("#my_account_modal").modal('show');
              //$("#my_account_modal").show();
              $("#comman_modal").modal('show');

            } else {
              $('.comman_msg').html("Oops.. sumthing wrong Please try again");
              $("#comman_modal").show();

            }
          },

        });

    });
</script>

@endpush
