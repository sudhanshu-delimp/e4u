
@extends('layouts.userDashboard')
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
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
    <!-- Page Heading -->
    <div class="row">
        <div class="custom-heading-wrapper col-md-12"><h1 class="h1">Notifications</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <ol>
                        <li>Use this feature to enable and disable your notification preferences..</li>
                        <li>Please note that for an Advertiser to receive any of your Requests, the Advertiser
                            must have enabled the corresponding feature in their preference settings.</li>
                            <li>Legbox Notifications from Escorts are an Alert that the Escort is on Tour and will be
                                visiting your Location the day after you receive the Notification. To receive the
                                Notification you must have this feature enabled.</li>
                            <li>Note also the default setting for 2FA authentification.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">        
        <form class="v-form-design">
        <div class="col-md-12">
            <div class="form-group">
                <h3 class="h3">Alert notifications</h3>
            
                <p class="my-3">From an Advertiser:</p>
            
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="alert-email">
                    <label class="custom-control-label" for="alert-email">Email</label>
                </div>
            
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="text" checked>
                    <label class="custom-control-label" for="text">Text</label>
                </div>
            
                <div class="mt-2">
                    <i>How an Escort or Massage Centre will communicate with you, including when on Tour.</i>
                </div>
            
                <p class="my-3">By Escorts4U:</p>
            
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="email">
                    <label class="custom-control-label" for="email">Email</label>
                </div>
            
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="alert-text" checked>
                    <label class="custom-control-label" for="alert-text">Text</label>
                </div>
            
                <div class="mt-2">
                    <i>How Escorts4U will communicate with you.</i>
                </div>
            </div>
            
            
            <div class="form-group">
                <h3 class="h3">Idle Time Preference</h3>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="idle_time" id="idle_15" value="15">
                    <label class="form-check-label" for="idle_15">15 minutes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="idle_time" id="idle_30" value="30" checked>
                    <label class="form-check-label" for="idle_30">30 minutes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="idle_time" id="idle_60" value="60">
                    <label class="form-check-label" for="idle_60">60 minutes</label>
                </div> 
                 <!-- Info -->
                 <div class="pt-1">
                    <i>Set the Idle time you want before you are logged out of your Console.</i>
                </div>           
            </div>
            <div class="form-group">
                <h3 class="h3">2FA Authentication</h3>
            
                <!-- Email Option -->
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="auth" id="auth_email" value="1">
                    <label class="form-check-label" for="auth_email">Email</label>
                </div>
            
                <!-- Text Option (default selected) -->
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="auth" id="auth_text" value="2" checked>
                    <label class="form-check-label" for="auth_text">Text</label>
                </div>
            
                <!-- Info -->
                <div class="pt-1">
                    <i>How your authentication code will be sent to you.</i>
                </div>
            </div>
            

            {{-- <div class="form-group notification_checkbox_div">
                <label for="email">Features</label><br>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="viewer_notification" value="viewer_notification" checked>
                    <label class="form-check-label">Viewer notifications, forward V-Alerts test</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="viewer_ask_question" value="viewer_ask_question" checked>
                    <label class="form-check-label">Allow Viewers to ask you a question</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="viewer_send_text" value="viewer_send_text" checked>
                    <label class="form-check-label">Allow Viewers to send you a text message</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" name="available_playmate" type="checkbox" value="1" {{ auth()->user()->available_playmate == 1 ? 'checked' : '' }}>
                    <label class="form-check-label">I’m available as a playmate</label>
                </div>

                <div class="pt-1"><i>Some features are enabled by default unless you disable them.</i></div>
            </div>

             <div class="form-group">
                <label for="email">Features <!-- (enabled by default) --></label><br>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="Method_Message" value="viewer_notification" checked>
                <label class="form-check-label" for="Method_Message">Viewer notifications, forward V-Alerts</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="Method_Text" value="viewer_ask_question" checked>
                <label class="form-check-label" for="Method_Text">Allow Viewers to ask you a question</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="Method_Email" value="viewer_send_text" checked>
                <label class="form-check-label" for="Method_Email">Allow Viewers to send you a text message</label>
                </div>
                <div class="form-check">
                <input class="form-check-input akhplaymate" name="playmate" type="checkbox" id="Method_Email" value="1" {{auth()->user()->available_playmate == 1 ? 'checked' : ''}} >
                <label class="form-check-label " for="Method_Email">I’m available as a playmate</label>
                </div>
                <div class="pt-1"><i>Some features are enabled by default unless you disable them.</i></div>
            </div> 
            <div class="form-group">
                <label for="email">Escort Agency</label><br>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="Method_Message" value="option1">
                <label class="form-check-label" for="Method_Message">Receive communications</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="Method_Text" value="option1">
                <label class="form-check-label" for="Method_Text">Send communications</label>
                </div>
                <div class="pt-1"><i>Enable communications between you and your Escort Agency (if applicable).</i></div>
            </div>
            <div class="form-group">
                <label for="email">Alert notifications</label><br>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="Method_Message" value="option1">
                <label class="form-check-label" for="Method_Message">Email (A-Alert)</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="Method_Text" value="option1">
                <label class="form-check-label" for="Method_Text">Text</label>
                </div>
                <div class="pt-1"><i>How Escorts4U will communicate with you.</i></div>
            </div> --}}
            <input type="submit" value="save" class="btn-common" name="submit">
        </div>
        
        </form>
    </div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <h3 class="h3 mb-4">Set Legbox Notifications </h3>
            <div class="table-responsive">
                <table id="userNotificationList" class="table table-bordered display" width="100%">
                    <thead class="bg-first">
                    <tr>
                        <th>Member ID</th>
                        <th>Stage Name / Business name</th>
                        <th>Notification</th>                       
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        <td>E60587</td>
                        <td>Western Australia</td>
                        <td>Joanne </td>
                        
                        <td class="theme-color text-center bg-white">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i
                                        class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                     aria-labelledby="dropdownMenuLink">
                                     
                                     <div class="custom-tooltip-container">
                                         <a class="dropdown-item align-item-custom" href="#"> <i class="fa fa-bell"></i> Enable</a>
                                        
                                         <div class="dropdown-divider"></div>
                                     </div>
                                     <div class="custom-tooltip-container">
                                         <a class="dropdown-item align-item-custom" href="#"> <i class="fa fa-bell-slash" aria-hidden="true"></i>
                                            Disable</a>
                                     </div>
                                 </div>
 
                            </div>
                        </td> 
                    
                    </tbody>
              </table>
            </div>
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

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function() {
       $('#userNotificationList').DataTable({
           responsive: true,
           language: {
               search: "Search: _INPUT_",
               searchPlaceholder: "Search by Member ID...",
               lengthMenu: "Show _MENU_ entries",
               zeroRecords: "No matching records found",
               info: "Showing _START_ to _END_ of _TOTAL_ entries",
               infoEmpty: "No entries available",
               infoFiltered: "(filtered from _MAX_ total entries)"
           },
           paging: true,
       });
   });
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
            console.log('data');
            console.log(data);

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
    $('.akhplaymate').on('click', function(e) {
        var id = $(this).val();
        if($(this).is(":checked") == true)
        {
            $.post({
                    type: 'POST',
                    url: "{{ route('escort.dashboard.my-playmates') }}",
                    data: {
                        available_playmate: id,
                        
                        //membership: membership,

                    },
                    headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                }).done(function (data) {
                    console.log(data);
                });
           
        } 
        if($(this).is(":checked") == false)
        {
            $.post({
                    type: 'POST',
                    url: "{{ route('escort.dashboard.my-playmates') }}",
                    data: {
                        available_playmate: null,
                        
                        //membership: membership,

                    },
                    headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                }).done(function (data) {
                    console.log(data);
                });
        }
        
    });


</script>

@endpush
