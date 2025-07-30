@extends('layouts.escort')
@section('style')
    <style>
        .table td {
            vertical-align: middle;
            padding: 12px !important;
        }

        #viewerTable_length {
            float: left;
            padding: 10px 0px;
        }

        #viewerTable_filter {
            float: right;
            padding: 10px 0px;
        }

        #viewerTable_filter input[type='search'] {
            width: 45% !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="v-main-heading h3 mb-2 d-flex align-items-center">
                <h1 class="p-0">My Legbox Viewers</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 my-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <p></p>
                        <ol>
                            <li>Registered Viewers who have flagged you in their Legbox are listed here. You can
                                also see your Viewers <a href="{{ url('escort-dashboard/send-notofications') }}"
                                    class="custom_links_design">here</a>.</li>
                            <li>The status for each Viewer is Summarised here and includes Notifications and
                                Contact.</li>
                            <li>The Viewer can set their preferences for Notifications and Contact. You can also set
                                your preferences here, which will override the Viewer’s settings.</li>
                            <li>If you Block a Viewer, the Viewer will not be able to view any of your Profiles or
                                communicate with you, while logged onto the Website. That includes Notifications
                                when you are on Tour.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-2">
            <!-- My Legbox -->
            <div class="col-md-12 mb-4">
                <div class="mb-2 d-flex align-items-center justify-content-end flex-wrap gap-10">

                    <div class="total_listing">
                        <div><span>Total Viewers Legbox : </span></div>
                        <div><span class="total_viewer_legbox">0</span></div>
                    </div>
                </div>
                <div class="table-responsive custom-responsive">
                    <table id="viewerTable" class="table table-bordered custom--newtable" width="100%">
                        <thead class="bg-first">
                            <tr>
                                <th class="text-left">Viewer ID </th>
                                <th class="text-left">Home State</th>
                                <th class="text-left">Profile ID</th>
                                <th class="text-center">Notifications
                                    Enabled</th>
                                <th class="text-center">Contact
                                    Enabled</th>
                                <th class="text-center">Contact
                                    Method</th>
                                <th class="text-center">Viewer
                                    Communication</th>
                                <th class="text-center">My Playbox
                                    Subscription</th>
                                <th class="text-center">Block
                                    Viewer</th>
                                <th class="text-center remove--icon">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td class="text-center">V60587</td>
                                <td class="text-center">Western Australia</td>
                                <td class="text-center">Yes or No </td>
                                <td class="text-center">Yes</td>
                                <td class="text-center">Text</td>
                                <td>0438 028 728</td>
                                <td class="text-center">Yes</td>
                                <td class="text-center">

                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1"></label>
                                    </div>

                                </td>

                                <td class="theme-color text-center bg-white">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            <a class="dropdown-item align-item-custom" href="#"> <i
                                                    class="fa fa-phone-slash"></i> Disable Contact</a>

                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item align-item-custom" href="#"> <i
                                                    class="fa fa-bell-slash" aria-hidden="true"></i> Disable
                                                Notifications</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <td class="text-center">V30789</td>
                                <td class="text-center">Victoria</td>
                                <td class="text-center">Yes or No</td>
                                <td class="text-center">Yes</td>
                                <td class="text-center">Text</td>
                                <td>viewer@gmail.com </td>
                                <td class="text-center">Yes</td>
                                <td class="text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                        <label class="custom-control-label" for="customSwitch2"></label>
                                    </div>
                                </td>

                                <td class="theme-color text-center bg-white">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            <a class="dropdown-item align-item-custom" href="#"> <i
                                                    class="fa fa-phone-slash"></i> Disable Contact</a>

                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item align-item-custom" href="#"> <i
                                                    class="fa fa-bell-slash" aria-hidden="true"></i> Disable
                                                Notifications</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Escort Profile Not Found Modal --}}
    <div class="modal fade upload-modal" id="escortProfileModal" tabindex="-1" role="dialog"
        aria-labelledby="escortProfileMissingLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/unblock.png') }}" style="width:40px; padding-right:10px;" class="modal_title_img">
                        <span class="text-white modal_title_span">Contact</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 agent-tour">
                    <div class="row">
                        <div class="col-md-12 my-4  text-center">
                            <h5 class=" body_text mb-2">This Escort does not presently have any Listed Profiles.</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group d-flex align-items-center justify-content-center">
                                <button type="button" class="btn-success-modal " data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- End Modal --}}
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {
            var viewerTable = $('#viewerTable').DataTable({
                responsive: true,
                language: {
                    search: "Search:", // ✅ This will show the label
                    searchPlaceholder: "Search by ID or Profile Name", // ✅ This is the placeholder
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching records found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
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
                    { data: 'viewer_id', name: 'viewer_id' },                         // 0
                    { data: 'home_state', name: 'home_state' },                        // 2
                    { data: 'escort_profile', name: 'escort_profile' },                        // 2
                    { data: 'notification_enabled', name: 'notification_enabled' },                        // 2
                    { data: 'contact_enabled', name: 'contact_enabled' },                               // 3
                    { data: 'contact_method', name: 'contact_method' },                   // 4
                    { data: 'viewer_comm', name: 'viewer_comm' }, // 5
                    { data: 'playbox_subscription', name: 'playbox_subscription' },       // 6
                    { data: 'block_viewer', name: 'block_viewer' },                       // 9
                    { data: 'action', name: 'action', orderable: false, searchable: false } // 10
                ],
                columnDefs: [
                    // {
                    //     targets: 8,            // column index (e.g., 'id' column)
                    //     width: "15%",          // set width here
                    // }
                ]
            });

            // Event to set total count
            viewerTable.on('xhr', function () {
                var json = viewerTable.ajax.json(); // full JSON response
                if (json && json.recordsTotal !== undefined) {
                    $('.total_viewer_legbox').text(json.recordsTotal);
                }
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

            $(document).on('click', '.toggle-contact', function (e) {
                e.preventDefault();
                const $this = $(this);
                let escortId = $(this).attr('data-escort-id');
                const viewerId = $this.data('id');
                const currentStatus = $this.data('status'); // disable or enable
                const newStatus = currentStatus === 'disable' ? 'enable' : 'disable';
                let url = '{{ route("escort.viewer-interaction.update") }}';

                let data = {
                    'viewer_id' : viewerId,
                    'current_status' : currentStatus,
                    'escort_id' : escortId,
                    'escort_disabled_contact' : newStatus,
                    'type' : 'contact',
                    'message' : 'Viewer contact is '+ newStatus + 'd successfully!',
                }
                if(newStatus == 'disable'){
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/no-phone.png")}}');
                }else{
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/phone.png")}}');
                }
                return  ajaxCall(url, data, $this);
            });

            $(document).on('click', '.toggle-notification', function (e) {
                e.preventDefault();
                const $this = $(this);
                const viewerId = $this.data('id');
                const escortId = $(this).attr('data-escort-id');
                const currentStatus = $this.data('status');
                const newStatus = currentStatus === 'disable' ? 'enable' : 'disable';
                let url = '{{ route("escort.viewer-interaction.update") }}';

                let data = {
                    'viewer_id' : viewerId,
                    'current_status' : currentStatus,
                    'escort_id' : escortId,
                    'escort_disabled_notification' : newStatus,
                    'type' : 'notification',
                    'message' : 'Viewer notification is '+ newStatus + 'd successfully!',
                }

                if(newStatus == 'disable'){
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/disable_notification.png")}}');
                }else{
                    $(".modal_title_img").attr('src','{{asset("assets/dashboard/img/enable_notification.png")}}');
                }

                return  ajaxCall(url, data, $this);
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
@endsection
