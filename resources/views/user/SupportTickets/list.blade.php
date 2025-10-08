@extends('layouts.user')
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
        min-height: 200px;
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
<div class="d-flex flex-column container-fluid pl-3 pl-lg-5">
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3" style="display: inline-block;">My Support Tickets</div>
{{--            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#profile_and_tour_options"><b>Help?</b> </h6>--}}
        </div>
        {{--<div class="col-md-12 mt-4 collapse" id="profile_and_tour_options">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="card" id="notes">
                        <div class="card-body">
                          <h3 class="NotesHeader"><b>Notes:</b> </h3>
                          <ol>
                              <li>Use this feature to review and make changes to your Profiles.</li>
                              <li>You can view and edit a Profile by selecting 'Action'. By selecting the Action function, you will be able to View, Edit or Delete the Profile.</li>
                              <li>To suspend a Profile listing go to <a href="/escort-dashboard/listings/upcoming">View Listings</a></li>
                          </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
    </div>
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
                            <th>Ticket ID</th>
                            <th>Department</th>
                            <th>Priority</th>
                            <th>Service Type</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date Created</th>
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
        <div class="modal-content" style="width: 900px;position: absolute; top:50px;">
            {{-- {{ route('escort.upload.gallery') }} --}}
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticket_name">Support Ticket</h5>
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
                        <textarea class="messageBox" name="message" id="message" rows="2" required></textarea>
                       
                        <button class="btn btn-info send-btn" id="submit_message">Send</button>
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
           "language": {
               "zeroRecords": "No record(s) found."
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
               { data: 'id', name: 'id', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'department', name: 'department', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'priority', name: 'priority', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'service_type', name: 'service_type', searchable: false, orderable:true ,defaultContent: 'NA'},
               { data: 'subject', name: 'start_date', searchable: true, orderable:true,defaultContent: 'NA' },
               { data: 'message', name: 'enabled', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'created_on', name: 'date_created', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'status_mod', name: 'status', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA' },
           ],
           order: [6, 'desc'],
       });


       $(document).on('click', ".view_ticket", function() {
           ticketId = $(this).closest('tr').find('td:first').html();
           $.ajax({
               method: "GET",
               url: "{{ route('support-ticket.conversations') }}" + '/' + ticketId,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                   $("#ticket_name").html(data.subject);
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
