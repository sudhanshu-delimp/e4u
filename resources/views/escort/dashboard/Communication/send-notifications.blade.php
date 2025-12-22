@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
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
                                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
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
                <div class="row mb-5">

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table w-100">
                                <thead class="table-bg">
                                    <tr>
                                        <th colspan="3" class="text-center">My Viewers</th>
                                    </tr>

                                </thead>
                                <tbody class="table-content">
                                    <tr>

                                        <td class="font-weight-bold">State</td>

                                        <td class="text-center font-weight-bold">Viewers</td>
                                        <td class="text-center font-weight-bold">Notifications</td>
                                    </tr>
                                    <tr>
                                        <td>ACT:</td>
                                        <td class="text-center">10</td>
                                        <td class="text-center">25</td>
                                    </tr>
                                    <tr>
                                        <td>NSW:</td>
                                        <td class="text-center">23</td>
                                        <td class="text-center">54</td>
                                    </tr>
                                    <tr>
                                        <td>Qld:</td>
                                        <td class="text-center">33</td>
                                        <td class="text-center">65</td>
                                    </tr>
                                    <tr>
                                        <td>NT:</td>
                                        <td class="text-center">44</td>
                                        <td class="text-center">66</td>
                                    </tr>
                                    <tr>
                                        <td>SA:</td>
                                        <td class="text-center">71</td>
                                        <td class="text-center">11</td>
                                    </tr>
                                    <tr>
                                        <td>Tas:</td>
                                        <td class="text-center">22</td>
                                        <td class="text-center">31</td>
                                    </tr>
                                    <tr>
                                        <td>Vic:</td>
                                        <td class="text-center">54</td>
                                        <td class="text-center">43</td>
                                    </tr>
                                    <tr>
                                        <td>WA:</td>
                                        <td class="text-center">3</td>
                                        <td class="text-center">109</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Totals</td>
                                        <td class="text-center">200</td>
                                        <td class="text-center">250</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- end --}}
                <!--middle content-->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                        <div class="bothsearch-form" style="gap: 10px;">
                            <button type="button" class="create-tour-sec" data-toggle="modal" data-target="#new-ban">Send
                                Notification</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="sendNotificationTable" class="table display" width="100%">
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Send Notification Popup --}}
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
                                <select class="form-control rounded-0">
                                    <option>Select Home State</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group text-left"
                                    style="border: 2px dashed #e3e6f0;padding: 15px 10px 35px 10px;">
                                    {{-- in not selected any --}}
    <label class="form-check-label" for="exampleCheck1" style="color: #323C47; display:none">You are
        about to send notification to all viewers located in Home State. </label>

    <!-- if only one selected -->

    <label class="form-check-label" for="exampleCheck1" style="color: #323C47;">You are
        about to send notification to <span>Viewers name</span> and viewers located in
        <span>Location</span>. </label>
    <div class="card-body px-0">
        <h4 class="NotesHeader"><b>Notes:</b> </h4>
        <ol>
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
    <div class="modal-footer pr-3">
        <div class="col-10 pl-0">
            <div class="form-group">
                <label class="form-check-label pr-4" for="exampleCheck1">Date:<span
                        class="ml-1">10-10-2025</span></label>
                <label class="form-check-label pr-4" for="exampleCheck1"> No. of Viewers:<span
                        class="ml-1">100</span></label>
            </div>
        </div>
        <button type="button" class="btn-success-modal">Send</button>
    </div>
    </div>
    </div>
    </div>
    {{-- end --}}


    {{-- Notification invalid Popup --}}
    <div class="modal fade upload-modal" id="invalidNotification" tabindex="-1" role="dialog" aria-labelledby="invalidNotification"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invalidNotification"><img src="/assets/dashboard/img/invalid-notification.png"
                            class="custompopicon" alt="cross"> Notification invalid</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <form>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <select class="form-control rounded-0">
                                    <option>Select Home State</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group text-left"
                                    style="border: 2px dashed #e3e6f0;padding: 15px 10px 35px 10px;">

                                    <label class="form-check-label" for="exampleCheck1" style="color: #323C47;">Your
                                        request to send a notification to
                                        <span>Viewers name</span> if only one selected, or <span>Your Viewers</span> is
                                        invalid as you do not have a current or impending Profile in <span>Location</span>.
                                    </label>
                                    <div class="card-body px-0">
                                        <h4 class="NotesHeader"><b>Notes:</b> </h4>
                                        <ol>
                                            <li>You must have a posted or impending Profile (a part of a Tour) to use this
                                                feature.</li>
                                            <li>If you have enabled the Notification feature in your settings, you do not
                                                need to use this feature as Notifications will be sent out automatically
                                                whenever you create a Profile or Tour.
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer pr-3">
                    <div class="col-10 pl-0">
                        <div class="form-group">
                            <label class="form-check-label pr-4" for="exampleCheck1">Date:<span
                                    class="ml-1">10-10-2025</span></label>
                           
                        </div>
                    </div>
                    <button type="button" class="btn-success-modal">Send</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {
            $('#sendNotificationTable').DataTable({
                responsive: true,
                initComplete: function() {
                    if ($('#returnToReportBtn').length === 0) {
                        $('.dataTables_filter').append(
                            '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
                        );
                    }
                    $('#returnToReportBtn').on('click', function() {
                        var table = $('#sendNotificationTable').DataTable();
                        table.search('').draw();
                    });
                },
                "language": {
                    "zeroRecords": "There is no record of the search criteria you entered.",
                    searchPlaceholder: "Search by Viewer Name"
                },
                paging: true,
                columns: [
                    { data: 'check', name: 'check' },
                    { data: 'name', name: 'name' },
                    { data: 'tagged', name: 'tagged', orderable: true },
                    { 
                        data: 'home_state', name: 'home_state',
                        orderable: true,
                        searchable: false
                    },
                    { data: 'contact_method', name: 'contact_method', orderable: true},
                    { data: 'notification', name: 'notification', orderable: true },
                    { data: 'block', name: 'block', orderable: true, class:'text-center' }
                ]
            });
        });
    </script>
@endpush
