@extends('layouts.admin')
@section('style')
@endsection
@section('content')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                    <!--middle content-->
                    <div class="row">
                        <div class="custom-heading-wrapper col-md-12">
                            <h1 class="h1">Feedback</h1>
                            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="card collapse" id="notes">
                                <div class="card-body">
                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                    <ol>
                                        <li>Feedback is generated from the public Website.</li>
                                        <li>When Feedback is received, print and refer the Feedback to the Managing
                                            Director.</li>
                                        <li>No action is to be taken on Feedback without the Managing Director’s approval.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="panel with-nav-tabs panel-warning">
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active show" id="tab1warning">
                                            <div class="table-responsive-xl">
                                                <table class="table" id="feedbackReportTable">
                                                    <thead class="table-bg">
                                                        <tr>
                                                            <th scope="col">Ref </th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Subject</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col" class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-content">
                                                        <tr class="row-color">
                                                            <td class="theme-color">123</td>
                                                            <td class="theme-color">2025-06-09 8:36:54</td>
                                                            <td class="theme-color">National Ugly Mugs Feature [header tile
                                                                in email]</td>
                                                            <td class="theme-color">a@yopmial.com</td>
                                                            <td class="theme-color">Pending</td>
                                                            <td class="theme-color text-center">
                                                                <div class="dropdown no-arrow">
                                                                    <a class="dropdown-toggle" href="#" role="button"
                                                                        id="dropdownMenuLink" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        <i
                                                                            class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                        aria-labelledby="dropdownMenuLink" style="">


                                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                            href="#" data-toggle="modal"
                                                                            data-target="#postOffivereport"> <i
                                                                                class="fa fa-eye"></i> View </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                            href="#"> <i
                                                                                class="fa fa-fw fa-print"></i> Print </a>

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Popup Post Office Report: [date & time] -->


    {{-- <div class="modal fade upload-modal bd-example-modal-lg" id="postOffivereport" tabindex="-1" role="dialog" aria-labelledby="postOffivereportLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
      <div class="modal-content basic-modal modal-lg">
         <div class="modal-header">
            <h5 class="modal-title" id="postOffivereport"><img src="{{ asset('assets/dashboard/img/post-office-report.png') }}" class="custompopicon">Post Office Report</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <table border="1" cellpadding="10" cellspacing="0" width="100%" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
                <!-- Header Row -->
                <tr style="background-color: #0c223d; color: white;">
                    <td colspan="5" style="font-weight: bold; text-align: center;">Post Office Report: date & time</td>
                </tr>

                <!-- Table Headings -->
                <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                    <td style="text-align:center;">Date & Time</td>
                    <td style="text-align:center;" >Member ID</td>
                    <td style="text-align:center;" >Member</td>
                    <td style="text-align:center;" >Subject</td>
                    <td style="text-align:center;" >Result</td>
                </tr>

                <!-- Row 1 -->
                <tr>
                    <td style="text-align:center;">2025-06-09 8:36:54</td>
                    <td style="text-align:center;">E60123</td>
                    <td style="text-align:center;">Joy</td>
                    <td style="text-align:center;">National Ugly Mugs Feature</td>
                    <td style="color: green; font-weight: bold; text-align:center;">Sent</td>
                </tr>

                <!-- Row 2 -->
                <tr>
                    <td style="text-align:center;">2025-06-09 8:36:54</td>
                    <td style="text-align:center;">E20158</td>
                    <td style="text-align:center;">Mary</td>
                    <td style="text-align:center;">National Ugly Mugs Feature</td>
                    <td style="color: green; font-weight: bold;text-align:center;">Sent</td>
                </tr>

                <!-- Footer Row -->
                <tr>
                    <td colspan="4" style="background-color: #0c2340; color: white; font-weight: bold;">Sent: 156</td>
                    <td style="background-color: #ff3c5f; text-align: center;">
                        <a href="#" style="color: white; text-decoration: none; font-weight: bold;">Print Report</a>
                    </td>
                </tr>
            </table>

         </div>
      </div>
   </div>
</div> --}}

    <!-- end -->
    @include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')

    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    <script>
        $(document).ready(function() {
            var table = $("#feedbackReportTable").DataTable({
                processing: true,
                serverSide: true,
                lengthChange: true,
                searching: true,
                bStateSave: false,

                ajax: {
                    url: "{{ route('admin.feedback.dataTable') }}",
                    type: 'GET',
                    dataType: 'json'
                },

                // columns: [
                //     { data: 'ref_number', name: 'ref_number', orderable: true, defaultContent: 'NA' },
                //     { data: 'feedback_date', name: 'feedback_date', orderable: true, defaultContent: 'NA' },
                //     { data: 'member_id', name: 'member_id', orderable: true, defaultContent: 'NA' },
                //     { data: 'email', name: 'email', orderable: true, defaultContent: 'NA' },
                //     { data: 'subject', name: 'subject', orderable: false, defaultContent: 'NA' },
                //     { data: 'status', name: 'status', orderable: true, defaultContent: 'Pending' },
                //     { data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center' }
                // ],

                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                order: [
                    [1, 'desc']
                ], // Date desc
                pageLength: 10,
            });

            $('#feedbackReportTable').on('init.dt', function() {
                $('.dataTables_filter input[type="search"]')
                    .attr('placeholder', 'Search by Ref or Member ID');
            });

        });
    </script>
@endpush
