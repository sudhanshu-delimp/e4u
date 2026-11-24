@php
    $title = 'View & Replay Query';
    $inputHelp = 'Please enter a your query.';
@endphp

<style>
    .modal-title{color: #fff;}
    .custompopicon{max-width: 32px !important;}
    </style>

@if ($console == 'operator')

    <div class="modal fade upload-modal opr-modal center" id="queryConversationModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white"><img
                            src="{{ asset('assets/dashboard/img/operator/view-reply.png') }}"
                            class="custompopicon">{{ $title }}</h5>
                    <a href="" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/dashboard/img/operator/close.png') }}" class="opr-close-btn">
                    </a>
                </div>
    @else
            <div class="modal fade upload-modal center" id="queryConversationModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static"
                        aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-content border-0">
                                    <div class="modal-header">
                                        <span class="custom-pop-wrapper"><img src="/assets/dashboard/img/view-reply.png"
                                                class="custompopicon" alt="cross">
                                            <h5 class="modal-title" id="ticket_name">{{ $title }}</h5>
                                        </span>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                                    class="img-fluid img_resize_in_smscreen"></span>
                                        </button>
                                    </div>
    @endif
            <div class="modal-body my-custom-modal-body">
                <div class="row">
                    <div class="col-sm-12 conv-main" id="conv-main">

                    </div>
                </div>
            </div>
                <div class="reply-wrapper p-3">
                    <form name="queryForm" id="queryForm">
                        <div class="reply-message-box">
                            {{ csrf_field() }}
                            <input type="hidden" name="report_for" id="report_for" value="{{ $reportFor }}">
                            <input type="hidden" name="fee_id" id="fee_id" value="">
                            <input type="hidden" name="fee_status" id="fee_status" value="">
                            <textarea class="messageBox" name="query_note" id="query_note" rows="4" required></textarea>
                            <button type="button" class="btn-cancel-modal" id="submitQuery">Send</button>
                        </div>
                        <small type="button" class="text-danger d-none" id="message_error">{{ $inputHelp }}</small>
                    </form>
                </div>
            </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {

            $(document).on('click', '#openQueryModel', function() {
                $('#queryForm')[0].reset();
                let id = $(this).data('id');
                let status = $(this).data('status');
                $('#fee_id').val(id);
                $('#fee_status').val(status);
                var url = "{{ route('web.monthly.report.view.query') }}";

                $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if ($.trim(response) === "") {
                        swal_error_popup("Query not found.");
                    } else {

                        $('#renderMonthlyRaiseQuery').html(response);
                        $('#viewMonthlyQueryModel').modal('show');
                    }
                },
                error: function() {
                    alert("Error loading form");
                }
            });
                $('#queryConversationModal').modal('show');
            });

            /*** Submit the query */
            $(document).on('click', '#submitQuery', function(e) {
                e.preventDefault();
                let id = $('#fee_id').val();
                let status = $('#fee_status').val();
                let reportFor = $('#report_for').val();
                let note = $('#query_note').val();
                var url = "{{ route('web.monthly.report.query') }}";
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        id: id,
                        status: status,
                        note: note,
                        report_for: reportFor,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.close();
                        $('#queryConversationModal').modal('hide');
                        if (response.status) {
                            //table.ajax.reload(null, false);
                            swal_success_popup(response.message);
                        } else {
                            swal_error_popup(response.message);
                        }
                    },
                    error: function() {
                        alert("Error occurred while updating the status.");
                    }
                });
            });
        });
    </script>
@endpush
