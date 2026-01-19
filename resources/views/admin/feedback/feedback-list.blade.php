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


    <div class="modal fade upload-modal bd-example-modal-lg" id="feedbackReportView" tabindex="-1" role="dialog" aria-labelledby="feedbackReportViewLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
      <div class="modal-content basic-modal modal-lg">
         <div class="modal-header">
            <h5 class="modal-title" id="feedbackReportView"><img src="{{ asset('assets/dashboard/img/post-office-report.png') }}" class="custompopicon">Post Office Report</h5>
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
</div> 

<!-- confirm modal here  -->

<div class="modal fade upload-modal" id="confirm-popup" tabindex="-1" role="dialog" aria-labelledby="confirmPopupLabel" aria-modal="true" style="padding-right: 15px;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <input type="hidden" id="status_data_id" value="334">
                    <input type="hidden" id="status_data_value" value="7">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{asset('assets/dashboard/img/question-mark.png')}}" alt="resolved" class="custompopicon">
                        <span>Confirmation</span>
                    </h5>
                    <input type="hidden" id="status_data_id" name="status_data_id" value="">
                    <input type="hidden" id="status_data_value" name="status_data_value" value="">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 teop-text text-center">
                    <h5 class="popu_heading_style mt-2">
                        Are you sure you want to perform this action.
                    </h5>

                </div>
                <div class="modal-footer justify-content-center border-0 pb-4">

                    <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal" aria-label="Close">Yes</button> <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">No</button>
                </div>
            </div>
        </div>
    </div>

<!-- confirm modal end here -->

    <!-- end -->
    @include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
confirm-popup
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

                columns: [
                    { data: 'ref_number', name: 'ref_number', defaultContent: 'NA' },
                    { data: 'date', name: 'date', defaultContent: 'NA' },
                    { data: 'subject', name: 'subject', defaultContent: 'NA' },
                    { data: 'email', name: 'email', defaultContent: 'NA' },
                    { data: 'status', name: 'status', defaultContent: 'NA' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ],

                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],

                order: [[0, 'desc']],
                pageLength: 10
            });


            $('#feedbackReportTable').on('init.dt', function () {
                $('.dataTables_filter input[type="search"]').attr('placeholder', 'Search by Ref, subject, email, or status');
            });

            $(document).off('click','.completed_btn');
            let feedbackID = null;
            $(document).on('click','.completed_btn', function(){
                feedbackID = $(this).attr('data-id');
                $('#confirm-popup').modal('show');
            });

            $('.saveStatus').click(function(){
                $.ajax({
                    url: '{{route("admin.feedback.status.change")}}', 
                    method: 'POST',                     
                    dataType: 'json',
                    data:{id: feedbackID,status:2, _token: '{{ csrf_token() }}'},
                    success:function(data){
                        feedbackID = null;
                        $('#feedbackReportTable').DataTable().ajax.reload(null, false);
                        $(".head_modal_title").html("Feedback Updated");
                        $('.comman_msg').html("The feedback status has been successfully changed to Completed.");
                        $('#comman_modal').modal('show');
                    }               
                })
            });

            $(document).on('click','.view-feedback-btn', function(){
                $('#feedbackReportView').modal('show');
            });
        });
    </script>
@endpush
