@php
    $title = 'View & Reply';
    $inputHelp = 'Please enter a your query.';
    $maxlength = 500;
@endphp

<style>
    .modal-title{color: #fff;}
    .custompopicon{max-width: 32px !important;}
    .conversation {
    display: inline-block;
    margin: 10px 0px;
}
.conversation {
    margin-bottom: 10px;
}

.adminMessage {
    background: #f1f1f1;
    padding: 12px;
    border-radius: 10px;
    max-height: 150px;
    overflow-y: auto;
}

.userMessage {
    background: #d9fdd3;
    padding: 12px;
    border-radius: 10px;
    max-height: 150px;
     overflow-y: auto;
}

.conversation p {
    margin: 0;
    word-break: break-word;
}

.message_time {
    font-size: 11px;
    color: #888;
}
.modal-dialog-scrollable .modal-body {
    overflow-y: auto;
    scroll-behavior: smooth;
}
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
                <div class="reply-wrapper p-3" id="showHideQueryForm">
                    <form name="queryForm" id="queryForm">
                        <div class="reply-message-box">
                            {{ csrf_field() }}
                            <input type="hidden" name="original_status" id="original_status" value="">
                            <input type="hidden" name="report_for" id="report_for" value="{{ $reportFor }}">
                            <input type="hidden" name="fee_id" id="fee_id" value="">
                            <input type="hidden" name="fee_status" id="fee_status" value="">
                            <textarea class="messageBox" name="query_note" id="query_note" rows="4" placeholder="Enter your query..." maxlength="{{$maxlength}}" required></textarea>
                             <button type="button" class="btn-cancel-modal" id="submitQuery" >Send</button>
                        </div>
                        <div class="text-end">
                                <small id="query_note_count">{{$maxlength}} characters remaining</small>
                            </div>
                        <small type="button" class="text-danger d-none" id="message_error">{{ $inputHelp }}</small>
                    </form>
                </div>
            </div>
    </div>
</div>

@push('script')
    <script>
        var dataTableId = '{{$dataTableId}}';
        let maxLength = parseInt('{{$maxlength}}');
        $("#showHideQueryForm").show();
        $(document).ready(function() {

            $(document).on('click', '#openQueryModel', function() {
                $('#queryForm')[0].reset();
                let id = $(this).data('id');
                let status = $(this).data('origin_status');
                let origin_status = $(this).data('original_status');
                $('#fee_id').val(id);
                $('#fee_status').val(status);
                 $('#original_status').val(origin_status);
                  $("#showHideQueryForm").show();
                 if(origin_status == 'paid') {
                    $("#queryForm").hide();
                 }
                

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
                        //swal_error_popup("Query not found.");
                    } else {
                            let html = '';
                            const messages = response.conversations.messages || [];

                            $.each(messages, function (index, message) {

                                let isReceiver = message.side === 'receiver';
                                html += `
                                    <div class="row mb-3 ${isReceiver ? '' : 'justify-content-end'}">
                                        <div class="col-sm-6 conversation">
                                            <div class="${isReceiver ? 'adminMessage' : 'userMessage'}">
                                                <p>${escapeHtml(message.message ?? '')}</p>
                                            </div>
                                            <span class="message_time">
                                                Member ID: ${escapeHtml(message.member_id ?? '')},
                                                ${date_time_format(message.report_date)}
                                            </span>
                                        </div>
                                    </div>
                                `;
                            });
                            $("#conv-main").html(html);
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
                        $("#queryForm")[0].reset();
                         $('#'+dataTableId).DataTable().ajax.reload(null, false);
                        if (response.status) {
                            $('#queryConversationModal').modal('hide');
                            swal_success_popup(response.message);
                        } else {
                            swal_error_popup(response.message);
                        }
                    },
                    error: function() {
                        swal_error_popup("Error occurred while updating the status.");
                    }
                });
            });

            $('#query_note').on('input', function () {

                let currentLength = $(this).val().length;
                let remaining = maxLength - currentLength;
                $('#query_note_count').text(remaining + ' characters remaining');  
            });
        });
        function escapeHtml(value) {
            return $('<div>').text(value).html();
        }

        
    </script>
@endpush
