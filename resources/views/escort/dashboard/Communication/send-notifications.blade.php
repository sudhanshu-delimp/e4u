@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style>
    .swal2-title {
        font-size: 20px !important;
    }
    </style>

@endsection
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                {{-- Page Heading   --}}

                <div class="row">
                    <div class="col-md-12 custom-heading-wrapper">
                        <h1 class="h1">Notifications</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes" style="">
                            <div class="card-body">
                               <h3 class="NotesHeader"><b>Notes:</b></h3>
                                <ol>
                                    <li>Use this feature for displaying a list of your Viewers who have flagged you in
                                        their Legbox.</li>
                                    <li>You can send a notification to a Viewer or all of the Viewers. Simply select
                                        and click the ‘Send Notification’ button. The Viewer will be notified of your
                                        impending visit to their Location according to their preferred method.</li>

                                    <li>Use the Block Viewer feature to restrict a Viewer from communicating with
                                        you or from seeing any of your Profiles (Viewer must be logged in for feature
                                        to have effect).</li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- my viewers --}}
            

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                        <div class="bothsearch-form" style="gap: 10px;">
                            <button type="button" class="create-tour-sec" data-toggle="modal" data-target="#new-ban">Send
                                Notification</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <!-- <table id="sendNotificationTable" class="table display" width="100%">
                                <thead class="table-bg">
                                    <tr>
                                        <th>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox1">
                                            </div>
                                        </th>
                                        <th>Viewer Name</th>
                                        <th>Tagged</th>
                                        <th>
                                            Home State

                                        </th>

                                        <th>Contact Method</th>
                                        <th>Notification</th>
                                        <th>Block Viewer</th>
                                    </tr>
                                </thead>
                                <tbody class="table-content">
                                    <tr>
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox1">
                                            </div>
                                        </td>
                                        <td><img src="{{ asset('assets/app/img/profile-img.png') }}"
                                                class="img-profile rounded-circle playmats-img ">Skusta clee</td>
                                        <td>10-10-2025</td>
                                        <td>SA</td>
                                        <td>Email</td>
                                        <td>By email</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch_1">
                                                <label class="custom-control-label" for="customSwitch_1"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox1">
                                            </div>
                                        </td>
                                        <td><img src="{{ asset('assets/app/img/profile-img.png') }}"
                                                class="img-profile rounded-circle playmats-img ">Johny Bravo</td>
                                        <td>11-10-20254</td>
                                        <td>WA</td>
                                        <td>Mobile</td>
                                        <td>Mobile</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch_2">
                                                <label class="custom-control-label" for="customSwitch_2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> -->

                    <table id="viewerTable" class="table custom--newtable" width="100%">
                        <thead class="bg-first">
                            <tr>
                                <th>Viewer Name </th>
                                <th>Home State</th>
                                <th>Tagged </th>
                                <th>Notifications
                                    Enabled</th>
                               
                                <th>Contact
                                    Method</th>
                               
                                <th>Block
                                    Viewer</th>
                             
                            </tr>
                        </thead>
                       <tbody class="table-content">
                    </tbody>
                    </table>





                        </div>
                    </div>
                </div>



                {{-- end --}}
                <!--middle content-->
              
            </div>
        </div>
    </div>



    {{-- Send Notification Popup --}}
    <form id="sendNotificationForm">
    @csrf
    <div class="modal fade upload-modal" id="new-ban" tabindex="-1" role="dialog" aria-labelledby="new-ban"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-ban"><img src="/assets/app/img/paper-plane-send.png"
                            class="custompopicon" alt="cross"> Send Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <form>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <select class="form-control rounded-0 mb-3" id="state_id" name="state_id">
                                            <option value="">Select Home State</option>
                                            @foreach($myStateList as $state_list)
                                            <option value="{{$state_list['state_id']}}">{{ $state_list['state']}}</option>
                                            @endforeach
                                            
                                </select>
                                <label class="form-check-label" for="exampleCheck1"
                                    style="color: #323C47; display:none">You are
                                    about to send notification to all viewers located in Home State. </label>

                                <!-- if only one selected -->

                                <label class="form-check-label" for="exampleCheck1" style="color: #323C47;">You are
                                    about to send notification to <span>Viewers name</span> and viewers located in
                                    <span>Location</span>. </label>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group text-left">
                                    {{-- in not selected any --}}
                                    <hr style="background-color: #0C223D" class="mt-4">

                                    <div class="card-body px-0">
                                        <p class="mb-1"><b>Notes:</b></p>
                                        <ol class="pl-4 text-justify">
                                            <li>The Viewer will only receive this Notification if they have the feature
                                                enabled.</li>
                                            <li>The Notification will identify you by your Membership ID and Stage Name.
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-check-label pr-2" for="exampleCheck1">Date:<span
                                    class="ml-1">{{ date('d-m-Y')}}</span></label>
                            <label class="form-check-label" for="exampleCheck1"> No. of Viewers:<span class="ml-1" id="viewer_count">0</span></label>
                        </div>
                    </div>
                    <button type="submit" class="btn-success-modal btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    {{-- end --}}




   
@endsection
@push('script')
   
   
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>

    let stateList = @json($myStateList);
    $('#state_id').on('change', function () {
        let stateId = $(this).val();
        let state = stateList.find(item => item.state_id == stateId);
        $('#viewer_count').text(state ? state.viewers : 0);
    });


    $('#sendNotificationForm').on('submit', function(e)
    {
        e.preventDefault();
        swal_waiting_popup({'title': 'Sending Notification...'});
        var formData = new FormData(document.getElementById('sendNotificationForm'));
        $.ajax({
            url: "{{ route('escort.sendNotification') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('.btn-primary').prop('disabled', true).text('Sending...');
            },
            success: function(response){
                Swal.close();
                $('.btn-primary').prop('disabled', false).text('Send Notification');
                if(response.status)
                {   
                    //viewerTable.ajax.reload();
                    $('#new-ban').modal('hide');
                    swal_success_popup(response.message ?? 'Notification send successfully');
                    $('#sendNotificationForm')[0].reset();
                    $('#viewer_count').text(0);
                     
                }
                else
                {
                     swal_error_warning(response.message);
                    
                }
            },
            error:function(xhr){
                $('.btn-primary').prop('disabled', false).text('Send Notification');
                if(xhr.status == 422)
                {    
                    let response = JSON.parse(xhr.responseText);
                    $.each(response.errors, function(key, value) {
                     swal_error_warning(value[0]);
                    });
                }
                else
                {
                    swal_error_popup('Something went wrong.');
                }
            }
        });

    });



    //   var viewerTable =  $('#viewerNotificationTable').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         searching: false,
    //         ordering: false,
    //         paging: false,
    //         info: false,
    //         ajax: {
    //             url: "{{ route('escort.viewers-notification.ajax') }}"
    //         },
    //         columns: [
    //             {
    //                 data: 'state',
    //                 name: 'state'
    //             },
    //             {
    //                 data: 'viewers',
    //                 name: 'viewers',
    //                 className: 'text-center'
    //             },
    //             {
    //                 data: 'notifications',
    //                 name: 'notifications',
    //                 className: 'text-center'
    //             }
    //         ]
    //     });


    $(document).ready(function() {
            var viewerTable = $('#viewerTable').DataTable({
                responsive: true,
                pageLength: {{$datatable_entries }},
                lengthMenu: [{{ config('app.paginate_range') }}],   
                language: {
                    search: "Search:", // ✅ This will show the label
                    searchPlaceholder: "Search by Viewer ID or Profile ID", // ✅ This is the placeholder
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching records found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                },
                initComplete: function() {
                    // if ($('#returnToReportBtn').length === 0) {
                    //     $('.dataTables_filter').append(
                    //         '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
                    //     );
                    // }
                    $('#returnToReportBtn').on('click', function() {
                        var table = $('#viewerTable').DataTable();
                        table.search('').draw();
                    });
                },
                "language": {
                    "zeroRecords": "There is no record of the search criteria you entered.",
                    searchPlaceholder: "Search by ID or Profile Name"
                },
                paging: true,
                ajax: {
                    url: "{{ route('escort.viewer-legbox-list') }}",
                    data: function(data) {
                        console.log('data');
                        // d.type = 'player';
                            // console.log('data');
                            // console.log(data);
                    }
                },
                columns: [
                    { data: 'viewer_name', name: 'viewer_name' },                         // 0
                    { data: 'home_state', name: 'home_state' },                        // 2
                    { data: 'tagged_date', name: 'tagged_date' },                        // 2
                    { data: 'notification_enabled', name: 'notification_enabled' },                  
                    { data: 'contact_method', name: 'contact_method' },                   // 4
                     { data: 'block_viewer', name: 'block_viewer' }, 
                    //{ data: 'playbox_subscription', name: 'playbox_subscription' },       // 6
                                         // 9
                  
                ],
               
                autoWidth: false,
                
            });




        $(document).on('change', '.isBlockedButton', function() {
            let viewerId = $(this).data('id');;
            let escortId = $(this).attr('data-escort-id');
            let isBlocked = $(this).is(':checked') ? 1 : 0;
            let data = {
                'viewer_id' : viewerId,
                'escort_id' : escortId,
                'is_blocked' : isBlocked,
                'type' : 'block',
                'message' : 'Viewer is '+(isBlocked ? 'Blocked' : 'UnBlocked')+' successfully!',
            }

            if(isBlocked){
                $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/block.png")}}');
            }else{
                $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/unblock.png")}}');
            }

            console.log(data);

            let url = '{{ route("escort.viewer-interaction.update") }}';
            return  ajaxCall(url, data, $(this));
            
        });


         function ajaxCall(actionUrl,rowData,thisObj)
            {
                rowData.token = '{{ csrf_token() }}';
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: rowData,
                    success: function(response) {
                        console.log('response');
                        console.log(response);
                        $('#escortProfileModal').modal('show');
                        $('#viewerTable').DataTable().ajax.reload(null, false);
                        if(response.type == 'block'){
                            $(".modal_title_span").text('Viewer Block');
                            $(".body_text").text(response.message);
                        }
                        if(response.type == 'contact'){
                            $(".modal_title_span").text('Viewer Contact');
                            $(".body_text").text(response.message);
                        }
                        if(response.type == 'notification'){
                            $(".modal_title_span").text('Viewer Notification');
                            $(".body_text").text(response.message);
                        }
                    },
                    error: function(err) {
                        //showGlobalAlert("Something went wrong.", "danger");
                    }
                });
            }

    });



       
    </script>
@endpush
