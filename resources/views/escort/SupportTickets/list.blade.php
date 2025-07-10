@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
.conversation {
    display: inline-block;
    margin-bottom: 15px;
}
.adminMessage, .userMessage {
        padding: 10px;
        border-radius: 10px;
    }
.userMessage {
        background-color: lightgray;
    }
    .adminMessage {
        background-color: #ff3c5fc9;
        color: white;
    }
    .message_time {
        font-size: 10px;
        position: absolute;
        right: 5%;
        /*bottom: 0;*/
    }
    .modal-body {
        min-height: 200px;
    }
    .messageBox {
        border-radius: 10px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content start here-->
{{-- Page Heading   --}}
<div class="row">
    <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
        <h1 class="h1">My Support Tickets </h1>
        <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
    </div>
    <div class="col-md-12 my-2">
        <div class="card collapse" id="notes" style="">
        <div class="card-body">
            <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
            <ol>
                {{-- <li>Use this feature to review and make changes to your Profiles.</li>
                              <li>You can view and edit a Profile by selecting 'Action'. By selecting the Action function, you will be able to View, Edit or Delete the Profile.</li>
                              <li>To suspend a Profile listing go to <a href="/escort-dashboard/listings/upcoming">View Listings</a></li>
                           --}}
            </ol>
        </div>
        </div>
    </div>
</div>
{{-- end --}}
    <div id="content">
        <div class="container-fluid">
        </div>
        <!-- /.container-fluid --><br>
        <div class="row">
            <div class="col-md-12">
                <div class="box-body table table-hover">
                    <table class="table table-hover" id="supportTicketsTable">
                        <thead id="table-sec" class="table-bg">
                        <tr>
                            <th>Ticket ID </th>
                            <th>Department</th>
                            <th>Priority</th>
                            <th>Service Type</th>
                            <th>Subject</th>
                            <th>Date Created</th>
                            <th>Document</th>
                            <th>Status</th>
                            <!--<th>Joined E4U</th>-->
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!--middle content end here-->
  <!--right side bar start from here-->
</div>



<div class="modal fade upload-modal" id="conversation_modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable"
         role="document"> {{--NOTE:: use  modal-dialog-scrollable instead of modal-dialog to make body scrollable only--}}
        <div class="modal-content" style="width: 900px;position: absolute;">
            {{-- {{ route('escort.upload.gallery') }} --}}
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticket_name">Support Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
                                                      class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 conv-main" id="conv-main">

                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid;">
                    <form id="sendMessage">
                        <textarea class="messageBox" name="message" id="message" rows="4" cols="50" required></textarea>
                        <button class="btn btn-info" id="submit_message">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    var ticketId = 0;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {

    var table = $("#supportTicketsTable").DataTable({
        language: {
            zeroRecords: "No record(s) found."
        },
        processing: true,
        serverSide: true,
        lengthChange: true,
        searching: true,
        bStateSave: false,

        ajax: {
            url: "{{ route('support-ticket.dataTable') }}",
            type: 'GET',
            data: function (d) {
                d.type = 'player';
                // You can add additional filters here if needed
            }
        },

        columns: [
            { data: 'ref_number', name: 'ref_number', orderable: true, defaultContent: 'NA' },
            { data: 'department', name: 'department', orderable: true, defaultContent: 'NA' },
            { data: 'priority', name: 'priority', orderable: true, defaultContent: 'NA' },
            { data: 'service_type', name: 'service_type', orderable: true, defaultContent: 'NA' },
            { data: 'subject', name: 'subject', orderable: true, defaultContent: 'NA' },
            { data: 'created_on', name: 'created_on', orderable: true, defaultContent: 'NA' },
            { data: 'file', name: 'file', orderable: true, defaultContent: 'NA' },
            { data: 'status_mod', name: 'status_mod', orderable: true, defaultContent: 'NA' },
            { data: 'action', name: 'action', orderable: false, searchable: false, defaultContent: 'NA' },
        ],

        order: [[6, 'desc']], // Default sort by created_on descending

        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        pageLength: 10,
    });

    // ✅ Add placeholder to search input
    $('#supportTicketsTable').on('init.dt', function () {
        $('.dataTables_filter input[type="search"]').attr('placeholder', 'Search by ID or Profile Name');
    });

    // 🟠 Cancel Ticket
    $(document).on('click', ".cancelTicket", function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, withdraw it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var ticketId = $(this).data('id');
                var cancelTicketBtn = $(this);
                $.ajax({
                    method: "PUT",
                    dataType: "json",
                    url: "{{ route('support-ticket.withdraw', ':id') }}".replace(':id', ticketId),
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (data) {
                        if (data.status == "success") {
                            cancelTicketBtn.closest('tr').find('.status').data('status-id', 4).html('Withdrawn');
                            cancelTicketBtn.closest('tr').find('.cancelTicket').remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Withdrawn',
                                text: 'Your ticket withdrawn successfully.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire(
                                'Oops!',
                                data.message,
                                'error'
                            );
                        }
                    }
                });
            }
        });
    });

    // 🟠 View Ticket
    $(document).on('click', ".view_ticket", function () {
        var ticketId = $(this).data("id");
        _load_conversations(ticketId);
    });

    // 🟠 Auto Open Ticket if ID in URL
    @if(request()->segment(3) && is_numeric(request()->segment(3)))
        $("#conversation_modal").modal('show');
        _load_conversations({{ request()->segment(3) }});
    @endif
});


   function _load_conversations(tId) {
       $("#conv-main").html('');
       $.ajax({
           method: "GET",
           url: "{{ route('support-ticket.conversations') }}" + '/' + tId,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success: function (data) {
               if(data.status_id == 3 || data.status_id == 4) {
                   $("#sendMessage").parent().hide();
               }
               var modalHeading = "<b>"+data.subject+'</b> - '+ data.created_on +'<br>';
               // "<span>"+data.user.name+'</span> ( '+ data.user.member_id +')';
               $("#ticket_name").html(modalHeading);
               var html = '<div class="col-sm-6 conversation"> </div>' +
                   // '<div class="col-sm-6 conversation"> </div>' +
                   '<div class="col-sm-6 conversation">' +
                   '    <div class="userMessage">' +
                   '       <p>'+data.message+'</p>'+
                   '   </div>'+
                   '       <span class="message_time">'+data.created_on+'</span>'+
                   '</div>';
               $(data.conversations).each(function( index, conversation ) {
                   if(conversation.admin_id) {
                       html +=
                           '<div class="col-sm-6 conversation">' +
                           '    <div class="adminMessage">' +
                           '       <p>'+conversation.message+'</p>'+
                           '   </div>'+
                           '       <span class="message_time">'+conversation.date_time+'</span>'+
                           '</div>'+
                           // '<div class="col-sm-6 conversation"> </div>' +
                           '<div class="col-sm-6 conversation"> </div>';
                   } else {
                       html += '<div class="col-sm-6 conversation"> </div>' +
                           // '<div class="col-sm-6 conversation"> </div>' +
                           '<div class="col-sm-6 conversation">' +
                           '    <div class="userMessage">' +
                           '       <p>'+conversation.message+'</p>'+
                           '   </div>'+
                           '       <span class="message_time">'+conversation.date_time+'</span>'+
                           '</div>';
                   }
               });
               $("#conv-main").html(html);
           }
       })
   }

    $("#submit_message").on('click', function (e) {
        e.preventDefault();
        var message = $("#message").val();
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                ticketId: ticketId,
                message: message
            },
            url: "{{ route('support-ticket.saveMessage') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if(data.status == "success") {
                    Swal.fire(
                        'Message Sent!',
                        'Your message sent successfully',
                        'success'
                    );
                    $("#conversation_modal").modal('hide');
                    $("#sendMessage")[0].reset();
                } else {
                    Swal.fire(
                        'Oops!',
                        'Error while saving the message',
                        'error'
                    );
                }
            }
        });
        // $("#sendMessage").reset();
    });
   /*$(document).on('click','.delete-center', function(e){
       e.preventDefault();
       var $this = $(this);
       $("#Lname").html("<p>Would you like to Delete?</p>");

       $('#delete_profile').modal('show');

       $("#save_change").click(function(e){
           console.log($this.attr('href'));
           $.ajax({
                   method: "POST",
                   url:$this.attr('href'),
                   contentType: false,
                   processData: false,
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   success: function (data) {
                       location.reload();
                   }

           })
       });*/
</script>
@endpush
