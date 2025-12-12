@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
.conversation {
    display: inline-block;
    margin: 10px 0px;
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
        /* min-height: 200px; */
    }
    .messageBox {
        border-radius: 10px;
    }
     .list_badge_class{
        padding: 5px 10px 5px 10px;
    }
</style>
@endsection
@section('content')
<div class="d-flex flex-column container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">
        <div class="custom-heading-wrapper col-lg-12">
            <h1 class="h1">View & Reply</h1>
           <span class="helpNoteLink" data-toggle="collapse" data-target="#profile_and_tour_options"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4 collapse" id="profile_and_tour_options">
            <div class="card" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol>
                        <li>You will receive a Notification, located in the Support Ticket Alert (top menu bar), when you have an unread Support Ticket message.</li>
                        <li>Use the <a href="{{ route('agent-messages')}}" class="custom_links_design">Messaging</a> service for communication with other Users (if available).</li>
                        
                    </ol>
                </div>
            </div>
        </div>
    </div> 
    
    
        <div class="row">
            <div class="col-md-12">
                <div class="box-body table-responsive-xl">
                    <table class="table" id="supportTicketsTable">
                        <thead class="table-bg">
                        <tr>
                            <th>Ticket ID</th>
                            <th>Department</th>
                            <th>Priority</th>
                            <th>Service Type</th>
                            <th>Subject</th>
                            <th>Date Created</th>
                            <th>Document</th>
                            <th>Status</th>
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



<div class="modal fade upload-modal" id="conversation_modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable"
         role="document"> {{--NOTE:: use  modal-dialog-scrollable instead of modal-dialog to make body scrollable only--}}
        <div class="modal-content" style="width: 900px;position: absolute;top:50px;">
            {{-- {{ route('escort.upload.gallery') }} --}}
            <div class="modal-content border-0">
                <div class="modal-header">
                    <span class="custom-pop-wrapper"><img src="/assets/app/img/history.png" class="custompopicon" alt="cross"><h5 class="modal-title" id="ticket_name">Support Ticket</h5></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
                                                      class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body my-custom-modal-body">
                    <div class="row">
                        <div class="col-sm-12 conv-main" id="conv-main">

                        </div>
                    </div>
                </div>
                <div class="reply-wrapper p-3 ">
                    <form id="sendMessage">
                       <div class="reply-message-box">
                        <textarea class="messageBox" name="message" id="message" rows="4" required></textarea>
                       
                        <button class="btn-cancel-modal py-3" id="submit_message">Send</button>
                         <input type="hidden" name="ticketId"  id="ticketId" value="">
                       </div>
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
   $(document).ready( function () {
       var table = $("#supportTicketsTable").DataTable({
                language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Ticket ID"
            },
           processing: true,
           serverSide: true,
           lengthChange: true,

           searchable:false,
           //searching:false,
           bStateSave: false,

           ajax: {
               url: "{{ route('support-ticket.dataTable') }}",
               data: function (d) {
                   d.type = 'player';
               }
           },
           columns: [
            { data: 'ref_number', name: 'ref_number', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'department', name: 'department', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'priority', name: 'priority', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'service_type', name: 'service_type', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'subject', name: 'start_date', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'created_on', name: 'created_on', searchable: false, orderable:true,defaultContent: 'NA' },
            { data: 'file', name: 'file', orderable: true, defaultContent: 'No Documents' },
            { data: 'status_mod', name: 'status_mod', orderable: true, defaultContent: 'NA' },
            { data: 'action', name: 'action', orderable: false, searchable: false, defaultContent: 'NA', class:'text-center' },
            { data: 'id', name: 'id', visible: false,searchable: false }
           ],
           order: [6, 'desc'],
       });


       $(document).on('click', ".view_ticket", function() {
           var rowData = table.row($(this).closest('tr')).data();
           var ticketId = rowData.id;
            let resolved = "";
           $.ajax({
               method: "GET",
               url: "{{ route('support-ticket.conversations') }}" + '/' + ticketId,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                    if(data.status_id == 3 || data.status_id == 4) {
                    $("#sendMessage").parent().hide();
                    }
                    else
                    {
                    $("#sendMessage").parent().show();
                    }

                    if(data.status=='Resolved' || data.status=='Withdrawn')
                    {
                        if(data.status=='Resolved')
                        {
                            message = 'This Ticket is now resolved';
                        }
                        else
                        {
                        message = 'This Ticket has been withdrawn'; 
                        }

                        resolved = `<div class="col-sm-12 text-center complete_ticket mt-3" style="font-weight: 700; font-size: 20px;color: green;"> ${message}</div>`
                    }

                   $("#ticket_name").html(data.subject);
                   var html = '<div class="col-sm-6 conversation"> </div>' +
                               // '<div class="col-sm-6 conversation"> </div>' +
                               '<div class="col-sm-6 conversation">' +
                               '    <div class="userMessage">' +
                                '       <p>'+data.message+'</p>'+
                                '   </div>'+
                       '       <span class="message_time">'+date_time_format(data.created_on)+'</span>'+ 
                                '</div>';
                   $(data.conversations).each(function( index, conversation ) {
                       if(conversation.admin_id) {
                           html +=
                               '<div class="col-sm-6 conversation">' +
                               '    <div class="adminMessage">' +
                               '       <p>'+conversation.message+'</p>'+
                               '   </div>'+
                               '       <span class="message_time">'+date_time_format(conversation.date_time)+'</span>'+
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
                               '       <span class="message_time">'+date_time_format(conversation.date_time)+'</span>'+
                               '</div>';
                       }
                   });
                   $("#conv-main").html(html);
                   $("#ticketId").val(ticketId);
                    if(data.status=='Resolved' || data.status=='Withdrawn')
                    {
                    $('#conv-main').append(resolved);
                    }
               }
           })
       });


    setInterval(function () {
    table.ajax.reload(null, false); 
    }, 15000);

   });

    $("#submit_message").on('click', function (e) {
        e.preventDefault();
        var message = $("#message").val();
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                ticketId: $("#ticketId").val(),
                message: message
            },
            url: "{{ route('support-ticket.saveMessage') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if(data.status == "success") {
                    Swal.fire(
                        'Message Sent!',
                        'Your message has been successfully sent.',
                        'success'
                    );
                    $("#conversation_modal").modal('hide');
                    $("#sendMessage")[0].reset();
                } else {
                    Swal.fire(
                        'Oops!',
                        'Error while saving the message.',
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

          // 🟠 Cancel Ticket
    $(document).on('click', ".cancelTicket", function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to reverse this!",
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
       

       
</script>

@if (Session::has('success'))
                    <script>
                        Swal.fire({
                            title: '{{ Session::get('title') }}',
                            text: '{{ Session::get('success') }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif

                @foreach(['warning', 'info', 'error'] as $alert)
                    @if (Session::has($alert))
                        <script>
                            Swal.fire({
                                title: '{{ ucfirst($alert) }}',
                                text: '{{ Session::get($alert) }}',
                                icon: '{{ $alert }}',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif
                @endforeach
@endpush
